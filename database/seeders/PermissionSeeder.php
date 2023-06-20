<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    public function run()
    {
        // Acceso al Dashboard
        Permission::create([
            'name' => 'access_dashboard',
            'description' => 'Acceder al dashboard'
        ]);
        // Módulo Permisos
        Permission::create([
            'name' => 'enable_rolePermission',
            'description' => 'Habilitar Mod. Roles y Permisos'
        ]);
        // Permisos para el Mod. Usuarios
        Permission::create([
            'name' => 'enable_user',
            'description' => 'Habilitar Mod. usuarios'
        ]);
        Permission::create([
            'name' => 'list_user',
            'description' => 'Listar usuarios'
        ]);
        Permission::create([
            'name' => 'create_user',
            'description' => 'Crear usuarios'
        ]);
        Permission::create([
            'name' => 'update_user',
            'description' => 'Modificar usuarios'
        ]);
        Permission::create([
            'name' => 'destroy_user',
            'description' => 'Eliminar usuarios'
        ]);
        // Permisos para el Mod. Roles
        Permission::create([
            'name' => 'enable_role',
            'description' => 'Habilitar Mod. Roles'
        ]);
        Permission::create([
            'name' => 'list_role',
            'description' => 'Listar Roles'
        ]);
        Permission::create([
            'name' => 'create_role',
            'description' => 'Crear roles'
        ]);
        Permission::create([
            'name' => 'update_role',
            'description' => 'Modificar roles'
        ]);
        Permission::create([
            'name' => 'destroy_role',
            'description' => 'Eliminar roles'
        ]);
        // Permisos para el Mod. Permisos
        Permission::create([
            'name' => 'enable_permission',
            'description' => 'Habilitar Mod. Permisos'
        ]);
        Permission::create([
            'name' => 'list_permission',
            'description' => 'Listar Permisos'
        ]);
        Permission::create([
            'name' => 'create_permission',
            'description' => 'Crear Permisos'
        ]);
        Permission::create([
            'name' => 'update_permission',
            'description' => 'Modificar Permisos'
        ]);
        Permission::create([
            'name' => 'destroy_permission',
            'description' => 'Eliminar Permisos'
        ]);
        // Permisos para el Menu principal
        Permission::create([
            'name' => 'enable_menuPrincipal',
            'description' => 'Habilitar Mod. Menú Principal'
        ]);
        Permission::create([
            'name' => 'calculator_menuPrincipal',
            'description' => 'Ver Opción Calculadora'
        ]);
        Permission::create([
            'name' => 'myAccounts_menuPrincipal',
            'description' => 'Ver Opción Mis Cuentas'
        ]);
        Permission::create([
            'name' => 'myOperations_menuPrincipal',
            'description' => 'Ver Opción Mis Operaciones'
        ]);
        // Permisos para el Menu Graficos
        Permission::create([
            'name' => 'enable_menuGraphs',
            'description' => 'Habilitar Mod. Menú Gráficos'
        ]);
        Permission::create([
            'name' => 'dolareros_menuGraphs',
            'description' => 'Ver Gráfico Dolareros'
        ]);
        Permission::create([
            'name' => 'kambista_menuGraphs',
            'description' => 'Ver Gráfico Kambista'
        ]);
        Permission::create([
            'name' => 'bloomberg_menuGraphs',
            'description' => 'Ver Gráfico Bloomberg'
        ]);
        Permission::create([
            'name' => 'google_menuGraphs',
            'description' => 'Ver Gráfico Google'
        ]);
        Permission::create([
            'name' => 'cocosylucas_menuGraphs',
            'description' => 'Ver Gráfico CocosyLucas'
        ]);
        Permission::create([
            'name' => 'tkambio_menuGraphs',
            'description' => 'Ver Gráfico TKambio'
        ]);
        Permission::create([
            'name' => 'secuEx_menuGraphs',
            'description' => 'Ver Gráfico SecuEx'
        ]);
        // Permisos para el Menu Admin
        Permission::create([
            'name' => 'enable_menuAdmin',
            'description' => 'Habilitar Mod. Administrador'
        ]);
        // Permisos para Cuentas Dolareros
        Permission::create([
            'name' => 'enable_accountDolareros',
            'description' => 'Habilitar Mod. Cuentas Dolareros'
        ]);
        Permission::create([
            'name' => 'list_accountDolareros',
            'description' => 'Listar Cuentas Dolareros'
        ]);
        Permission::create([
            'name' => 'create_accountDolareros',
            'description' => 'Crear Cuentas Dolareros'
        ]);
        Permission::create([
            'name' => 'update_accountDolareros',
            'description' => 'Editar Cuentas Dolareros'
        ]);
        Permission::create([
            'name' => 'destroy_accountDolareros',
            'description' => 'Eliminar Cuentas Dolareros'
        ]);
        // Permisos para Bancos
        Permission::create([
            'name' => 'enable_banks',
            'description' => 'Habilitar Mod. Bancos'
        ]);
        Permission::create([
            'name' => 'list_banks',
            'description' => 'Listar Bancos'
        ]);
        Permission::create([
            'name' => 'create_banks',
            'description' => 'Crear Bancos'
        ]);
        Permission::create([
            'name' => 'update_banks',
            'description' => 'Editar Bancos'
        ]);
        Permission::create([
            'name' => 'destroy_banks',
            'description' => 'Eliminar Bancos'
        ]);
        // Permisos para Origenes de fondos
        Permission::create([
            'name' => 'enable_sourceFunds',
            'description' => 'Habilitar Mod. Origen de Fondos'
        ]);
        Permission::create([
            'name' => 'list_sourceFunds',
            'description' => 'Listar Origen de Fondo'
        ]);
        Permission::create([
            'name' => 'create_sourceFunds',
            'description' => 'Crear Origen de Fondo'
        ]);
        Permission::create([
            'name' => 'update_sourceFunds',
            'description' => 'Editar Origen de Fondo'
        ]);
        Permission::create([
            'name' => 'destroy_sourceFunds',
            'description' => 'Eliminar Origen de Fondo'
        ]);
        // Permisos para Gestor de Operaciones
        Permission::create([
            'name' => 'enable_manageOperations',
            'description' => 'Habilitar Mod. Gestor de Operaciones'
        ]);
        Permission::create([
            'name' => 'list_manageOperations',
            'description' => 'Listar Gestor de Operaciones'
        ]);
        Permission::create([
            'name' => 'detailsOperation_manageOperations',
            'description' => 'Ver detalles de operación'
        ]);
        Permission::create([
            'name' => 'finishOperation_manageOperations',
            'description' => 'Finalizar operaciones'
        ]);
        Permission::create([
            'name' => 'refusedOperation_manageOperations',
            'description' => 'Rechazar operaciones'
        ]);
        Permission::create([
            'name' => 'receiptOperation_manageOperations',
            'description' => 'Ver comprobante de operaciones'
        ]);
        Permission::create([
            'name' => 'changeReceiptOperation_manageOperations',
            'description' => 'Cambiar comprobante de operaciones'
        ]);
        Permission::create([
            'name' => 'reasonRefusedOperation_manageOperations',
            'description' => 'Ver motivo de rechazo de operaciones'
        ]);
        // Permisos para Mis Cuentas Cliente
        Permission::create([
            'name' => 'list_myAccounts',
            'description' => 'Listar mis cuentas'
        ]);
        Permission::create([
            'name' => 'create_myAccounts',
            'description' => 'Crear mis cuentas'
        ]);
        Permission::create([
            'name' => 'update_myAccounts',
            'description' => 'Editar mis cuentas'
        ]);
        Permission::create([
            'name' => 'destroy_myAccounts',
            'description' => 'Eliminar mis cuentas'
        ]);
        // Permisos para Mis Cuentas Cliente
        Permission::create([
            'name' => 'list_myOperations',
            'description' => 'Listar mis operaciones'
        ]);
        Permission::create([
            'name' => 'create_myOperations',
            'description' => 'Crear mis operaciones'
        ]);
        Permission::create([
            'name' => 'update_myOperations',
            'description' => 'Editar mis operaciones'
        ]);
        Permission::create([
            'name' => 'destroy_myOperations',
            'description' => 'Eliminar mis operaciones'
        ]);
        Permission::create([
            'name' => 'help_myOperations',
            'description' => 'Ir ayuda en mis operaciones'
        ]);
        Permission::create([
            'name' => 'details_myOperations',
            'description' => 'Ver detalles en mis operaciones'
        ]);
        Permission::create([
            'name' => 'receipt_myOperations',
            'description' => 'Ver comprobante en mis operaciones'
        ]);
        Permission::create([
            'name' => 'refuse_myOperations',
            'description' => 'Ver motivo de rechazo en mis operaciones'
        ]);
        /*$roleA = Role::findByName('admin');
        $roleA->givePermissionTo([
            'access_dashboard',
            'enable_rolePermission',
            'enable_user',
            'list_user',
            'create_user',
            'update_user',
            'destroy_user',
            'enable_role',
            'list_role',
            'create_role',
            'update_role',
            'destroy_role',
            'enable_permission',
            'list_permission',
            'create_permission',
            'update_permission',
            'destroy_permission',
            'enable_menuPrincipal',
            'calculator_menuPrincipal',
            'myAccounts_menuPrincipal',
            'myOperations_menuPrincipal',
            'enable_menuGraphs',
            'dolareros_menuGraphs',
            'kambista_menuGraphs',
            'bloomberg_menuGraphs',
            'google_menuGraphs',
            'cocosylucas_menuGraphs',
            'tkambio_menuGraphs',
            'secuEx_menuGraphs',
            'enable_menuAdmin',
            'enable_accountDolareros',
            'list_accountDolareros',
            'create_accountDolareros',
            'update_accountDolareros',
            'destroy_accountDolareros',
            'enable_banks',
            'list_banks',
            'create_banks',
            'update_banks',
            'destroy_banks',
            'enable_sourceFunds',
            'list_sourceFunds',
            'create_sourceFunds',
            'update_sourceFunds',
            'destroy_sourceFunds',
            'enable_manageOperations',
            'list_manageOperations',
            'detailsOperation_manageOperations',
            'finishOperation_manageOperations',
            'refusedOperation_manageOperations',
            'receiptOperation_manageOperations',
            'changeReceiptOperation_manageOperations',
            'reasonRefusedOperation_manageOperations',
            'list_myAccounts',
            'create_myAccounts',
            'update_myAccounts',
            'destroy_myAccounts',
            'list_myOperations',
            'create_myOperations',
            'update_myOperations',
            'destroy_myOperations',
            'help_myOperations',
            'details_myOperations',
            'receipt_myOperations',
            'refuse_myOperations',
        ]);*/
    }
}
