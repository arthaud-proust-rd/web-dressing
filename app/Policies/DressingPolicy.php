<?php

namespace App\Policies;

use App\Models\Dressing;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class DressingPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param User $user
     * @param Dressing $dressing
     * @return Response|bool
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Dressing  $dressing
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Dressing $dressing)
    {
        return $user->id === $dressing->user_id;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Dressing  $dressing
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Dressing $dressing)
    {
        return $user->id === $dressing->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Dressing  $dressing
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Dressing $dressing)
    {
        return $user->id === $dressing->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Dressing  $dressing
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Dressing $dressing)
    {
        return $user->id === $dressing->user_id;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Dressing  $dressing
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Dressing $dressing)
    {
        return $user->id === $dressing->user_id;
    }
}
