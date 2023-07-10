<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionCouponSeeder extends Seeder
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
            'name' => 'enable_coupons',
            'description' => 'Habilitar Mod. Cupones'
        ]);
        Permission::create([
            'name' => 'list_coupons',
            'description' => 'Listar Cupones'
        ]);
        Permission::create([
            'name' => 'create_coupons',
            'description' => 'Crear Cupones'
        ]);
        Permission::create([
            'name' => 'update_coupons',
            'description' => 'Editar Cupones'
        ]);
        Permission::create([
            'name' => 'destroy_coupons',
            'description' => 'Eliminar Cupones'
        ]);
        Permission::create([
            'name' => 'assign_coupons',
            'description' => 'Asignar cupón a usuarios'
        ]);
        $roleA = Role::findByName('admin');
        $roleA->givePermissionTo([
            'enable_coupons',
            'list_coupons',
            'create_coupons',
            'update_coupons',
            'destroy_coupons',
            'assign_coupons',
        ]);
    }
}
