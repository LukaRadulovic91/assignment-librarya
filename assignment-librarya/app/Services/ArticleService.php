<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Enums\Roles;
use App\Enums\ApprovalStatus;
use App\Models\User;
use App\Models\ArticleUser;
use App\Models\Article;

/**
 * Class ArticleService
 *
 * @package App\Repositories\API
 */
class ArticleService
{
    /**
     * @param Request $request
     *
     * @return void
     */
    public function reviewArticles(Request $request): void
    {
        foreach ($request->validated()['data'] as $article) {
            $existingRecord = Article::find($article['id']);
            if ($existingRecord) {
                ArticleUser::create([
                    'user_id' => auth()->user()->id,
                    'approval_status_id' => $article['value'],
                    'article_id' => $existingRecord->id
                ]);
            }
        }
    }

    /**
     * @param ArticleUser $articleUser
     *
     * @return bool
     */
    public function checkRejectedApprovalStatus(ArticleUser $articleUser): bool
    {
        return ArticleUser::where(static function ($query) use ($articleUser) {
            $query->where('article_id', $articleUser->article_id)
                ->where('approval_status_id', ApprovalStatus::REJECTED);
        })->exists();
    }

    /**
     * @param ArticleUser $articleUser
     *
     * @return bool
     */
    public function checkPublishingApprovalStatus(ArticleUser $articleUser): bool
    {
        return ArticleUser::where(static function ($query) use ($articleUser) {
            $query->where(function ($innerQuery) use ($articleUser) {
                $innerQuery->where('article_id', $articleUser->article_id)
                    ->where('approval_status_id', ApprovalStatus::APPROVED);
            });
        })->count() >= User::where('role_id', Roles::REVIEWER)->get()->count();
    }

    /**
     * @param ArticleUser $articleUser
     * @param int $publicationStatus
     *
     * @return void
     */
    public function setPublicationStatus(ArticleUser $articleUser, int $publicationStatus): void
    {
        Article::where('id', $articleUser->article_id)->update([
            'publication_status_id' => $publicationStatus
        ]);
    }

    /**
     * @param Article $article
     *
     * @return void
     */
    public function setApprovalStatus(Article $article): void
    {
        $article->articlesUsers()->attach($article->id, [
            'user_id' => auth()->user()->id,
            'approval_status_id' => ApprovalStatus::DRAFT
        ]);
    }
}
