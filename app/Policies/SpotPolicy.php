<?php

namespace App\Policies;

use App\Models\Spot;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SpotPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Spot $spot): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return $user->isAdmin() || $user->role === 'photographer';
    }

    public function update(User $user, Spot $spot): bool
    {
        $owns = $user->id === $spot->owner_id;
        return $user->isAdmin() || $owns;
    }

    public function delete(User $user, Spot $spot): bool
    {
        $owns = $user->id === $spot->owner_id;
        return $user->isAdmin() || $owns;
    }

    public function restore(User $user, Spot $spot): bool
    {
        $owns = $user->id === $spot->owner_id;
        return $user->isAdmin() || $owns;
    }

    public function forceDelete(User $user, Spot $spot): bool
    {
        $owns = $user->id === $spot->owner_id;
        return $user->isAdmin() || $owns;
    }
}
