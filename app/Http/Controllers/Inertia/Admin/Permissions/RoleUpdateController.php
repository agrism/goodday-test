<?php

namespace App\Http\Controllers\Inertia\Admin\Permissions;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\RedirectResponse;

class RoleUpdateController extends Controller
{
    public function __invoke(Request $request, int $id): Response|RedirectResponse
    {
        if(!$role = Role::query()->where('id', $id)->first()){
            return Inertia::location(route('blog.index'));
        }

        $permissionIds = $request->input('permissionIds');

        if(!is_array($permissionIds)){
            return Inertia::location('/dashboard');
        }

        $permissionIds = Permission::query()->whereIn('id', $permissionIds)->get()->pluck('id')->toArray();

        $role->syncPermissions($permissionIds);

        return redirect()->route('admin.role.details', $id);
    }
}
