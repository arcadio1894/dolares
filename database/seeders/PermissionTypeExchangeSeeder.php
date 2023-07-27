<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionTypeExchangeSeeder extends Seeder
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
            'name' => 'enable_typeExchange',
            'description' => 'Habilitar Mod. Tipo de Cambios'
        ]);
        Permission::create([
            'name' => 'change_typeExchange',
            'description' => 'Cambiar Tipo de Cambios'
        ]);
        Permission::create([
            'name' => 'save_typeExchange',
            'description' => 'Guardar Tipo de Cambios'
        ]);

        $roleA = Role::findByName('admin');
        $roleA->givePermissionTo([
            'enable_typeExchange',
            'change_typeExchange',
            'save_typeExchange',
        ]);
    }
}
