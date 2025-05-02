<?php

namespace App\Repositories;

use App\Contracts\PermissionRepositoryInterface;
use App\Models\User;
use Spatie\Permission\Models\Permission;

class PermissionRepository implements PermissionRepositoryInterface 
{
    public function getAllPermission() 
    {
        return Permission::all();
    }

    public function getPermissionById(User $user) 
    {
        return $user;
    }

    public function deletePermission(User $user) 
    {
        $user->delete();
    }

    public function createPermission(array $attributes) 
    {
        return User::create($attributes);
    }

    public function updatePermission(User $user, array $attributes) 
    {
        return $user->update($attributes);
    }
}