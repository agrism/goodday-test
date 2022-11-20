<?php

namespace App\Http\Controllers\Inertia\Admin\Permissions;


use App\Http\Controllers\Controller;
use App\Http\Resources\RoleListResource;
use Inertia\Inertia;
use Inertia\Response;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleDetailsController extends Controller
{
    public function __invoke(int $id): Response
    {
        $role = Role::query()->with('permissions')->where('id', $id)->first();
        $rolePermissionIds = $role->permissions->pluck('id')->toArray();
        $optionalPermissions = Permission::query()->get()->map(function(Permission $permission) use($rolePermissionIds){
            $explodedName = explode(' ', $permission->name);
            return (object)[
                'id' => $permission->id,
                'full_name' => $permission->name,
                'group' => array_shift($explodedName),
                'name' => implode(' ', $explodedName),
                'enabled' => in_array($permission->id, $rolePermissionIds),
            ];
        })->sortBy('full_name');

        $role->optionalPermissions = $optionalPermissions->toArray();
        return Inertia::render('Admin/Roles', [
            'activeRole'=> $role,
            'roles' => RoleListResource::collection(Role::get()),
        ]);
    }
}
