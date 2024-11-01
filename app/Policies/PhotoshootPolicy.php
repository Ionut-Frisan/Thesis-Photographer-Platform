<?php

namespace App\Policies;

use App\Models\Photoshoot;
use App\Models\User;

class PhotoshootPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->role === 'admin';
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Photoshoot $photoshoot): bool
    {
        return $user->role === 'admin' || $user->id === $photoshoot->customer_id || $user->id === $photoshoot->photographer_id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Photoshoot $photoshoot): bool
    {
        return $user->role === 'admin' || $user->id === $photoshoot->customer_id || $user->id === $photoshoot->photographer_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Photoshoot $photoshoot): bool
    {
        return $user->role === 'admin';
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Photoshoot $photoshoot): bool
    {
        return $user->role === 'admin';
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Photoshoot $photoshoot): bool
    {
        return $user->role === 'admin';
    }
}
