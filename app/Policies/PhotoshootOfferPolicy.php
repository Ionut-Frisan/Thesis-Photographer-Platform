<?php

namespace App\Policies;

use App\Models\PhotoshootOffer;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PhotoshootOfferPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the photoshoot offer.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\PhotoshootOffer  $photoshootOffer
     * @return bool
     */
    public function view(User $user, PhotoshootOffer $photoshootOffer): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create a photoshoot offer.
     *
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function create(User $user): bool
    {
        return $user->role === 'admin' || $user->role === 'photographer';
    }

    /**
     * Determine whether the user can update the photoshoot offer.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\PhotoshootOffer  $photoshootOffer
     * @return bool
     */
    public function update(User $user, PhotoshootOffer $photoshootOffer): bool
    {
        return $user->role === 'admin' || $user->id === $photoshootOffer->photographer_id;
    }

    /**
     * Determine whether the user can delete the photoshoot offer.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\PhotoshootOffer  $photoshootOffer
     * @return bool
     */
    public function delete(User $user, PhotoshootOffer $photoshootOffer): bool
    {
        return $user->role === 'admin' || $user->id === $photoshootOffer->photographer_id;
    }

    /**
     * Determine whether the user can restore the photoshoot offer.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\PhotoshootOffer  $photoshootOffer
     * @return bool
     */
    public function restore(User $user, PhotoshootOffer $photoshootOffer): bool
    {
        return $user->role === 'admin' || $user->id === $photoshootOffer->photographer_id;
    }

    /**
     * Determine whether the user can permanently delete the photoshoot offer.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\PhotoshootOffer  $photoshootOffer
     * @return bool
     */
    public function forceDelete(User $user, PhotoshootOffer $photoshootOffer): bool
    {
        return $user->role === 'admin';
    }
}
