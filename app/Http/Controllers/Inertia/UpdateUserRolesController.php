<?php

namespace App\Http\Controllers\Inertia;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Features;
use Laravel\Jetstream\Http\Controllers\Inertia\UserProfileController as InertiaUserProfileController;
use Laravel\Jetstream\Jetstream;
use Spatie\Permission\Models\Role;

class UpdateUserRolesController
{
    public function __invoke(Request $request): void
    {
        $roleIds = $request->input('checked_ids');

        $enabledIds = [];
        foreach ($roleIds as $role){
            if(data_get($role, 'enabled') === true){
                $enabledIds[] = data_get($role, 'id');
            }
        }

        $roleNamesToEnable = Role::query()->whereIn('id', $enabledIds)->get()->pluck('name')->toArray();

        Auth::user()->syncRoles($roleNamesToEnable);
    }
}
