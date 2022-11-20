<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Collection;

interface RoleListActionInterface
{
    public function __invoke(): Collection;
}
