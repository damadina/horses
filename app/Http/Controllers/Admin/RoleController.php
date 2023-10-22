<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Validation\Rule;


class RoleController extends Controller
{

    public function index()
    {
        $roles = Role::all();


        return view('admin.roles.index',compact('roles'));
    }




    public function create()
    {
        $permissions = Permission::all();
        return view('admin.roles.create',compact('permissions'));
    }


    public function store(Request $request)
    {

        $request->validate([
            'name' =>['required','min:4','max:50',Rule::unique('roles')],
            'permissions' =>'required',

        ]);

        $role = Role::create([
            'name' => $request->name
        ]);


        $role->permissions()->attach($request->permissions);
        return redirect()->route('admin.roles.index')->with('info','El rol se creo correctamente');
    }


    public function show(Role $role)
    {
        return view('admin.roles.show',compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        $permissions = Permission::all();
        return view('admin.roles.edit',compact('role','permissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' =>['required','min:4','max:50',Rule::unique('roles')->ignore($role->id, 'id')],
            'permissions' =>'required',

        ]);

        $role->update([
            'name' => $request->name
        ]);

        $role->permissions()->sync($request->permissions);
        return redirect()->route('admin.roles.edit',$role);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->route('admin.roles.index')->with('info',"El rol se elimino");
    }
}
