<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Produkty;

class ProduktPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function update(User $user)
    {
        return $user->hasRole('admin');
    }

    public function delete(User $user)
    {
        return $user->hasRole('admin');
    }

    public function create(User $user)
    {
        return $user->hasRole('admin');
    }

    public function edit(User $user)
    {
        return $user->hasRole('admin');
    }
}
