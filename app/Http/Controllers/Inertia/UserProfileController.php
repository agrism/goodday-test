<?php

namespace App\Http\Controllers\Inertia;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Features;
use Laravel\Jetstream\Http\Controllers\Inertia\UserProfileController as InertiaUserProfileController;
use Laravel\Jetstream\Jetstream;
use Spatie\Permission\Models\Role;
use Inertia\Response;

class UserProfileController extends InertiaUserProfileController
{
    public function show(Request $request): Response|RedirectResponse
    {
        $this->validateTwoFactorAuthenticationState($request);

        $userRoles = Auth::user()->roles->pluck('id', 'id')->all();
        $roles = Role::query()->get()
            ->map(function(Role $role) use(&$rolesData, $userRoles){
                return (object)[
                    'id' => $role->id,
                    'name' => ucfirst($role->name),
                    'enabled' => in_array($role->id, $userRoles)
                ];
            })
            ->all();


        return Jetstream::inertia()->render($request, 'Profile/Show', [
            'confirmsTwoFactorAuthentication' => Features::optionEnabled(Features::twoFactorAuthentication(), 'confirm'),
            'sessions' => $this->sessions($request)->all(),
            'roles' => $roles
        ]);
    }
}
