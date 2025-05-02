<?php

namespace App\Repositories;

use App\Contracts\UserRepositoryInterface;
use App\Models\User;

class UserRepository implements UserRepositoryInterface 
{
    public function getAllUsers() 
    {
        return User::all();
    }

    public function getUserById(User $user) 
    {
        return $user;
    }

    public function deleteUser(User $user) 
    {
        $user->delete();
    }

    public function createUser(array $attributes) 
    {
        return User::create($attributes);
    }

    public function updateUser(User $user, array $attributes) 
    {
        return $user->update($attributes);
    }
}