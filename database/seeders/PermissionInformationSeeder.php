<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionInformationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Permisos para Noticias
        Permission::create([
            'name' => 'enable_informations',
            'description' => 'Habilitar Mod. Noticias'
        ]);
        Permission::create([
            'name' => 'list_informations',
            'description' => 'Listar Noticias'
        ]);
        Permission::create([
            'name' => 'create_informations',
            'description' => 'Crear Noticias'
        ]);
        Permission::create([
            'name' => 'update_informations',
            'description' => 'Editar Noticias'
        ]);
        Permission::create([
            'name' => 'destroy_informations',
            'description' => 'Eliminar Noticias'
        ]);

        $roleA = Role::findByName('admin');
        $roleA->givePermissionTo([
            'enable_informations',
            'list_informations',
            'create_informations',
            'update_informations',
            'destroy_informations',
        ]);
    }
}
