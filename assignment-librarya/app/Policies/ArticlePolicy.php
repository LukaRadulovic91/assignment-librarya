<?php

namespace App\Policies;

use App\Enums\Roles;
use App\Models\User;

class ArticlePolicy
{
    /**
     * Determine whether the user can view any models.
     *
     * @param User $user
     *
     * @return bool
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param User $user
     *
     * @return bool
     */
    public function view(User $user): bool
    {
//        return $user->role_id === Roles::CANDIDATE ? ($user->candidate->id === $candidate->id) : true;
        return true;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param User $user
     *
     * @return bool
     */
    public function create(User $user): bool
    {
        return $user->role_id === Roles::AUTHOR;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param User $user
     *
     * @return bool
     */
    public function edit(User $user): bool
    {
//        return $user->role_id === Roles::CANDIDATE ? ($user->candidate->id === $candidate->id) : true;
        return true;
    }


    /**
     * Determine whether the user can update the model.
     * @param User $user
     *
     * @return bool
     */
    public function update(User $user): bool
    {
//        return $user->candidate->id === $candidate->id;
        return true;
    }

    /**
     * Determine whether the user can delete the model.
     * @param User $user
     *
     * @return bool
     */
    public function delete(User $user): bool
    {
        //
    }

}
