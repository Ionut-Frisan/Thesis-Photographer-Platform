<?php

namespace App\Policies;

use App\Models\File;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class FilePolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, File $file): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, File $file): bool
    {
        return true;
    }

    public function delete(User $user, File $file): bool
    {
        return true;
    }

    public function restore(User $user, File $file): bool
    {
        return true;
    }

    public function forceDelete(User $user, File $file): bool
    {
        return true;
    }
}
