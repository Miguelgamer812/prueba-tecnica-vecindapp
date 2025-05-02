<?php

namespace App\Contracts;

use App\Models\User;

interface PermissionRepositoryInterface
{
    public function getAllPermission();
    public function getPermissionById(User $user);
    public function deletePermission(User $user);
    public function createPermission(array $attributes);
    public function updatePermission(User $user, array $attributes);
}
