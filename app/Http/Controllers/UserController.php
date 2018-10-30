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
        $this->validate($request, [
            'name'=>'required|max:120',
            'email'=>'required|email|unique:users',
            'password'=>'required|min:6|confirmed'
        ]);

        $data = $request->only('email', 'name', 'password');
        $data['password'] = bcrypt($data['password']);

        $user = User::create($data);
        if ($user) {
            $roles = $request['roles'];

            if (isset($roles)) {
                foreach ($roles as $role) {
                    $role_r = Role::where('id', '=', $role)->firstOrFail();

                    // Atribuindo papel ao usuário
                    $user->assignRole($role_r);
                }
            }

            return redirect()
                    ->route('users.index')
                    ->with(
                        'success',
                        'User successfully added.'
                    );
        }

        return redirect()
                ->back()
                ->with('error', 'Falha ao criar Usuário');
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
        $this->validate($request, [
            'name'=>'required|max:120',
            'email'=>'required|email|unique:users,email,'.$id,
            'password'=>'nullable|min:6|confirmed'
        ]);

        $data = $request->only(['name', 'email', 'password']);

        // para não alterar a senha se estiver vazia
        if (is_null($data['password'])) {
            unset($data['password']);
        } else {
            $data['password'] = bcrypt($data['password']);
        }

        $user = User::findOrFail($id);

        $update = $user->update($data);
        if ($update) {
            // Recuperar todos os papéis
            $roles = $request['roles'];

            if (isset($roles)) {
                // Se uma ou mais funções forem selecionadas, associe o usuário as funções
                $user->roles()->sync($roles);
            } else {
                // Se nenhuma função for selecionada, remova a função existente associada a um usuário
                $user->roles()->detach();
            }

            return redirect()
                    ->route('users.index')
                    ->with('success', 'User successfully edited.');
        }

        return redirect()
                ->back()
                ->with('error', 'Falha ao atualizar o User');
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
