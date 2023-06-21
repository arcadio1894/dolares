<?php

namespace App\Http\Controllers;

use App\Http\Requests\DeletePermissionRequest;
use App\Http\Requests\StorePermissionRequest;
use App\Http\Requests\UpdatePermissionRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $permissionsAll = $user->getPermissionsViaRoles()->pluck('name')->toArray();
        $permissions = Permission::select('id', 'name', 'description')->get();

        return view('permission.index', compact('permissions', 'permissionsAll'));
    }

    public function store(StorePermissionRequest $request)
    {
        $validated = $request->validated();

        $permission = Permission::create([
            'name' => $request->get('permission_name'),
            'description' => $request->get('permission_description'),
        ]);
        //dump($request->get('permissions_core') );
        if ( $request->has('permissions_core') )
        {
            //dump('Ingrese');
            $adminRole = Role::findByName('admin');
            //dump('adminRole');
            if ($adminRole && $permission) {
                //('Ingrese 2');
                $adminRole->givePermissionTo($permission->name);
            }
        }

        return response()->json(['message' => 'Permiso guardado con éxito.'], 200);

    }

    public function update(UpdatePermissionRequest $request)
    {
        $validated = $request->validated();

        $permission = Permission::find($request->get('permission_id'));

        $permission->name = $request->get('permission_name');
        $permission->description = $request->get('permission_description');

        $permission->save();

        return response()->json(['message' => 'Permiso modificado con éxito.'], 200);

    }

    public function destroy(DeletePermissionRequest $request)
    {
        $validated = $request->validated();

        $permission = Permission::find($request->get('permission_id'));

        $permission->delete();

        return response()->json(['message' => 'Permiso eliminado con éxito.'], 200);

    }

    public function getPermissions()
    {
        $permissions = Permission::select('id', 'name', 'description')->get();
    }
}
