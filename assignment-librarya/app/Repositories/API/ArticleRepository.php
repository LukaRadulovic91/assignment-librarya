<?php

namespace App\Repositories\API;

use DB;
use Illuminate\Support\Collection;
use App\Enums\ApprovalStatus;
use App\Enums\PublicationStatus;

/**
 * Class ArticleRepository
 *
 * @package App\Repositories\API
 */
class ArticleRepository
{
    /**
     * @return Collection
     */
    public function getReviewedArticles(): Collection
    {
        return DB::table('articles as a')
            ->join('articles_users as au', function ($join) {
                $join->on('a.id', '=', 'au.article_id')
                    ->where('au.user_id', auth()->user()->id);
            })
            ->join('users as u', 'au.user_id', '=', 'u.id')
            ->select([
                'u.id as user_id',
                'u.name as user_name',
                'u.email as user_email',
                'au.article_id as article_id',
                'a.title as article_title',
                'a.text as article_text',
                'a.publication_status_id as publication_status_id',
                'au.approval_status_id as approval_status_id',
                'a.created_at as created_at',
                'a.updated_at as updated_at'
            ])
            ->get();
    }

    /**
     * @return Collection
     */
    public function getUnreviewedArticles(): Collection
    {
        return DB::table('articles as a')
            ->leftJoin('articles_users as au', function ($join) {
                $join->on('a.id', '=', 'au.article_id')
                    ->where('au.user_id', auth()->user()->id);
            })
            ->leftJoin('users as u', 'au.user_id', '=', 'u.id')
            ->where(static function($query) {
                $query->where('a.publication_status_id', PublicationStatus::PENDING_REVIEW)
                      ->where('au.approval_status_id', ApprovalStatus::DRAFT);
            })
            ->select([
                'u.id as user_id',
                'u.name as user_name',
                'u.email as user_email',
                'au.article_id as article_id',
                'a.title as article_title',
                'a.text as article_text',
                'a.publication_status_id as publication_status_id',
                'au.approval_status_id as approval_status_id',
                'a.created_at as created_at',
                'a.updated_at as updated_at'
            ])
            ->get();
    }
}
