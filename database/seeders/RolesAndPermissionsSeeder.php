<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        Permission::create(['name' => 'ver dashboard']);
        //roles
        Permission::create(['name' => 'listar roles']);
        Permission::create(['name' => 'crear roles']);
        Permission::create(['name' => 'editar roles']);
        Permission::create(['name' => 'eliminar roles']);
        //partes
        Permission::create(['name' => 'listar partes']);
        Permission::create(['name' => 'cear partes']);
        Permission::create(['name' => 'leer partes']);
        Permission::create(['name' => 'eliminar partes']);
        Permission::create(['name' => 'actualizar partes']);
        // usuarios
        Permission::create(['name' => 'listar usuarios']);
        Permission::create(['name' => 'editar usuarios']);

        $role = Role::create([
            'name' => 'Admin'
        ]);
        $role->givePermissionTo(Permission::all());

        $role = Role::create([
            'name' => 'GestorRRHH'
        ]);
        $role->givePermissionTo('listar partes');

    }
}
