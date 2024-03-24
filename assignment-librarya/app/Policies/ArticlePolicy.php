<?php

namespace App\Policies;

use App\Models\Article;
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
        return true;
    }

    /**
     * @param User $user
     * @param Article $article
     *
     * @return bool
     */
    public function getReviewedArticles(User $user, Article $article): bool
    {
//        return $user->candidate->id === $candidate->id;
        return true;
    }

    /**
     * @param User $user
     * @param Article $article
     *
     * @return bool
     */
    public function getUnreviewedArticles(User $user, Article $article)
    {
//        return $user->candidate->id === $candidate->id;
        return true;
    }

    /**
     * @param User $user
     * @param Article $article
     *
     * @return bool
     */
    public function reviewArticles(User $user, Article $article): bool
    {
        return true;
//        return $user->role_id === Roles::CANDIDATE ? ($user->candidate->id === $candidate->id) : true;
    }
}
