<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Permisos para Cupones
        Permission::create([
            'name' => 'enable_schedule',
            'description' => 'Habilitar Mod. Horarios'
        ]);
        Permission::create([
            'name' => 'list_schedule',
            'description' => 'Listar Cupones'
        ]);
        Permission::create([
            'name' => 'create_schedule',
            'description' => 'Crear Cupones'
        ]);
        Permission::create([
            'name' => 'update_schedule',
            'description' => 'Editar Cupones'
        ]);
        Permission::create([
            'name' => 'destroy_schedule',
            'description' => 'Eliminar Cupones'
        ]);

        $roleA = Role::findByName('admin');
        $roleA->givePermissionTo([
            'enable_schedule',
            'list_schedule',
            'create_schedule',
            'update_schedule',
            'destroy_schedule'
        ]);
    }
}
