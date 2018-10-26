<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

//Importing laravel-permission models
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'permission:manage users']);
    }

    public function index()
    {
        //Get all users and pass it to the view
        $users = User::all();
        return view('users.index')->with('users', $users);
    }

    public function create()
    {
        //Get all roles and pass it to the view
        $roles = Role::get();
        return view('users.create', ['roles'=>$roles]);
    }

    public function store(Request $request)
    {
        //Validate name, email and password fields
        $this->validate($request, [
            'name'=>'required|max:120',
            'email'=>'required|email|unique:users',
            'password'=>'required|min:6|confirmed'
        ]);

        $user = User::create($request->only('email', 'name', 'password')); //Retrieving only the email and password data

        $roles = $request['roles']; //Retrieving the roles field
        //Checking if a role was selected
        if (isset($roles)) {
            foreach ($roles as $role) {
                $role_r = Role::where('id', '=', $role)->firstOrFail();
                $user->assignRole($role_r); //Assigning role to user
            }
        }
        //Redirect to the users.index view and display message
        return redirect()->route('users.index')
            ->with(
                'success',
             'User successfully added.'
            );
    }

    public function show($id)
    {
        return redirect('users');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id); //Get user with specified id
        $roles = Role::get(); //Get all roles

        return view('users.edit', compact('user', 'roles')); //pass user and roles data to view
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $this->validate($request, [
            'name'=>'required|max:120',
            'email'=>'required|email|unique:users,email,'.$id,
            'password'=>'nullable|min:6|confirmed'
        ]);

        // Recupere os campos nome, email e senha
        $data = $request->only(['name', 'email', 'password']);

        // para não alterar a senha se estiver vazia
        if (is_null($data['password'])) {
            unset($data['password']);
        }

        $user->fill($data)->save();

        // Recuperar todos os papéis
        $roles = $request['roles'];

        if (isset($roles)) {
            $user->roles()->sync($roles);  //If one or more role is selected associate user to roles
        } else {
            $user->roles()->detach(); //If no role is selected remove exisiting role associated to a user
        }
        return redirect()->route('users.index')
            ->with(
                'success',
             'User successfully edited.'
            );
    }

    public function destroy($id)
    {
        //Find a user with a given id and delete
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index')
            ->with(
                'success',
             'User successfully deleted.'
            );
    }
}
