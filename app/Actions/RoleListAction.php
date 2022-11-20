<?php

namespace App\Actions;

use App\Contracts\RoleListActionInterface;
use Illuminate\Database\Eloquent\Collection;
use Spatie\Permission\Models\Role;

class RoleListAction implements RoleListActionInterface
{
    public function __invoke(): Collection
    {
        return Role::all();
    }
}
