<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:manage users']);
    }

    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::get();
        return view('admin.users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name'=>'required|max:120',
            'email'=>"required|email|unique:users,email,id",
            'password'=>'required|min:6|confirmed'
        ]);

        $user = User::create($request->except('roles'));

        if ($user) {
            $roles = $request->input('roles');
            if (isset($roles)) {
                $user->assignRole($roles);
            }

            return redirect()
                    ->route('admin.users.index')
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
        $user = User::findOrFail($id);
        $roles = Role::get();

        return view('admin.users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name'=>'required|max:120',
            'email'=>"required|email|unique:users,email,{$id},id",
            'password'=>'nullable|min:6|confirmed'
        ]);

        // para não alterar a senha se estiver vazia
        if (is_null($request['password'])) {
            unset($request['password']);
        }

        $user = User::findOrFail($id);
        $update = $user->update($request->except('roles'));

        if ($update) {
            $roles = $request->input('roles') ? $request->input('roles') : [];
            $user->syncRoles($roles);

            return redirect()
                    ->route('admin.users.index')
                    ->with('success', 'User successfully edited.');
        }

        return redirect()
                ->back()
                ->with('error', 'Falha ao atualizar o User');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $delete = $user->delete();
        if ($delete) {
            return redirect()->route('admin.users.index')
                ->with(
                    'success',
                    'User successfully deleted.'
                );
        }

        return redirect()
            ->back()
            ->with('error', 'Falha ao deletar o Usuário');
    }

    /**
     * Delete all selected User at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if ($request->input('ids')) {
            $users = User::whereIn('id', $request->input('ids'))->get();

            foreach ($users as $user) {
                $user->delete();
            }
        }
    }
}
