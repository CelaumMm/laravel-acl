<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:manage permissions']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissions = Permission::all();
        return view('admin.permissions.index', compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::get();

        return view('admin.permissions.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'=>"required|max:40|unique:permissions,name,id",
        ]);

        $permission = Permission::create($request->except('roles'));

        $roles = $request->input('roles') ? $request->input('roles') : [];
        $permission->syncRoles($roles);

        return redirect()->route('admin.permissions.index')
            ->with(
                'success',
                'Permission'. $permission->name.' added!'
            );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return redirect('permissions');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $permission = Permission::findOrFail($id);
        $roles = Role::all();

        return view('admin.permissions.edit', compact('permission', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name'=>"required|max:40|unique:permissions,name,{$id},id",
        ]);

        $permission = Permission::findOrFail($id);
        $permission->update($request->except('roles'));

        $roles = $request->input('roles') ? $request->input('roles') : [];
        $permission->syncRoles($roles);

        return redirect()->route('admin.permissions.index')
            ->with(
                'success',
                'Permission'. $permission->name.' updated!'
            );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $permission = Permission::findOrFail($id);

        // Tornar impossível excluir esta permissão
        if ($permission->name == "manage users") {
            return redirect()->route('admin.permissions.index')
            ->with(
                'warning',
                'Cannot delete this Permission!'
            );
        }
        // Tornar impossível excluir esta permissão
        if ($permission->name == "manage roles") {
            return redirect()->route('admin.permissions.index')
            ->with(
                'warning',
                'Cannot delete this Permission!'
            );
        }
        // Tornar impossível excluir esta permissão
        if ($permission->name == "manage permissions") {
            return redirect()->route('admin.permissions.index')
            ->with(
                'warning',
                'Cannot delete this Permission!'
            );
        }

        $permission->delete();

        return redirect()->route('admin.permissions.index')
            ->with(
                'success',
                'Permission deleted!'
            );
    }

    /**
     * Delete all selected Permission at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if ($request->input('ids')) {
            $permissions = Permission::whereIn('id', $request->input('ids'))->get();

            foreach ($permissions as $permission) {
                // Tornar impossível excluir esta permissão
                if ($permission->name == "manage users") {
                    continue;
                }
                // Tornar impossível excluir esta permissão
                if ($permission->name == "manage roles") {
                    continue;
                }
                // Tornar impossível excluir esta permissão
                if ($permission->name == "manage permissions") {
                    continue;
                }

                $permission->delete();
            }
        }
    }
}
