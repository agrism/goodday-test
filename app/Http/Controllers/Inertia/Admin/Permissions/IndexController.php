<?php

namespace App\Http\Controllers\Inertia\Admin\Permissions;

use App\Contracts\RoleListActionInterface;
use App\Http\Controllers\Controller;
use App\Http\Resources\RoleListResource;
use Inertia\Inertia;
use Inertia\Response;

class IndexController extends Controller
{
    public function __invoke(RoleListActionInterface $listRoles): Response
    {
        return Inertia::render('Admin/Roles', [
            'roles' => RoleListResource::collection($listRoles()),
        ]);
    }
}
