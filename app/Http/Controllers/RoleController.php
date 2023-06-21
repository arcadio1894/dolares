<?php

namespace App\Http\Controllers;

use App\Http\Requests\DeleteRoleRequest;
use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    const MODULES = [
        'dashboard'=>'DASHBOARD',
        'rolePermission'=>'MOD. ACCESOS',
        'user'=>'USUARIOS',
        'role'=>'ROLES',
        'permission'=>'PERMISOS',
        'menuPrincipal'=>'MENU PRINCIPAL',
        'menuGraphs' => 'MENU GRAFICOS',
        'menuAdmin' => 'MENU ADMIN',
        'accountDolareros' => 'CUENTAS DOLAREROS',
        'banks' => 'BANCOS',
        'sourceFunds' => 'ORIGEN DE FONDOS',
        'manageOperations' => 'GESTOR DE OPERACIONES',
        'myAccounts' => 'CUENTAS',
        'myOperations' => 'OPERACIONES'
    ];

    public function index()
    {
        $roles = Role::all();

        $user = Auth::user();
        $permissionsUser = $user->getPermissionsViaRoles()->pluck('name')->toArray();
        $cantShow = 5;

        $arrayRoles = [];
        foreach ( $roles as $role )
        {
            $cantTotal = $role->permissions()->count();
            $permissions = $role->permissions;
            $userCount = User::role($role->name)->count();
            array_push($arrayRoles, [
                'role' => $role,
                'permissions' => $permissions,
                'cantShow' => $cantShow,
                'cantTotal' => $cantTotal,
                'cantUsers' => $userCount
            ]);
        }

        return view('role.index', compact('roles', 'permissionsUser', 'arrayRoles'));
    }

    public function store(StoreRoleRequest $request)
    {
        $validated = $request->validated();

        //var_dump($request->get('permissions'));

        $role = Role::create([
            'name' => $request->get('role_name'),
            'description' => $request->get('role_description'),
        ]);

        // Sincronizar con los permisos
        $permissions = $request->get('permissions');

        $role->syncPermissions($permissions);

        return response()->json(['message' => 'Rol guardado con éxito.'], 200);

    }

    public function update(UpdateRoleRequest $request)
    {
        $validated = $request->validated();

        $name_role = $request->get('role_name');

        $role = Role::findById($request->get('role_id'));

        $role->name = $request->get('role_name');
        $role->description = $request->get('role_description');

        $role->save();

        // Sincronizar con los permisos
        $permissions = $request->get('permissions');
        $role->syncPermissions($permissions);

        return response()->json(['message' => 'Rol modificado con éxito.'], 200);

    }

    public function destroy(DeleteRoleRequest $request)
    {
        $validated = $request->validated();

        $role = Role::findById($request->get('role_id'));

        $role->delete();

        return response()->json(['message' => 'Role eliminado con éxito.'], 200);

    }

    public function getPermissions( $id )
    {
        $role = Role::findByName($id);
        //var_dump($role);
        // No usar permissions() sino solo permissions
        $permissionsAll = Permission::all();
        $permissionsSelected = [];
        $permissions = $role->permissions;
        foreach ( $permissions as $permission )
        {
            //var_dump($permission->name);
            array_push($permissionsSelected, $permission->name);
        }
        //var_dump($permissions);
        return array(
            'permissionsAll' => $permissionsAll,
            'permissionsSelected' => $permissionsSelected
        );
    }

    public function getRoles()
    {
        $roles = Role::select('id', 'name', 'description')->get();
        return datatables($roles)->toJson();
    }

    public function create()
    {
        $permissions = Permission::select('id', 'name', 'description')->get();

        $groupPermissions = [];
        $groups = [];
        foreach ( $permissions as $permission )
        {
            $pos = strpos($permission->name, '_');
            $group = substr($permission->name, $pos+1);
            array_push($groupPermissions, $group);
            //array_push($groupPermissions, ['key'=>$group, 'group'=>$this::MODULES[$group]]);
        }
        //dd($groupPermissions);
        $grupos = array_unique($groupPermissions);
        foreach ( $grupos as $group )
        {
            array_push($groups, ['group'=>$group, 'name'=>$this::MODULES[$group]]);
        }
        //dd($groups);
        return view('role.create', compact('permissions', 'groups'));
    }

    public function edit( $id )
    {
        $permissions = Permission::select('id', 'name', 'description')->get();

        $rol = Role::where('id', $id)->first();

        $groupPermissions = [];
        $groups = [];
        foreach ( $permissions as $permission )
        {
            $pos = strpos($permission->name, '_');
            $group = substr($permission->name, $pos+1);
            array_push($groupPermissions, $group);
            //array_push($groupPermissions, ['key'=>$group, 'group'=>$this::MODULES[$group]]);
        }
        $grupos = array_unique($groupPermissions);
        foreach ( $grupos as $group )
        {
            array_push($groups, ['group'=>$group, 'name'=>$this::MODULES[$group]]);
        }
        //dd(strrpos($permissions[6]->name, $groups[0]['group']));
        $role = Role::findByName($rol->name);

        $permissionsSelected = [];
        $permissions1 = $role->permissions;
        foreach ( $permissions1 as $permission )
        {
            //var_dump($permission->name);
            array_push($permissionsSelected, $permission->name);
        }

        //dd( in_array('holi_dashboard', $permissionsSelected) );
        return view('role.edit', compact('permissions', 'groups', 'permissionsSelected', 'role'));
    }
}
