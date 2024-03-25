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
    public function getArticles(): Collection
    {
        return DB::table('articles as a')
            ->select([
                'a.id as article_id',
                'a.title as article_title',
                'a.text as article_text',
                'a.created_at as created_at',
                'a.updated_at as updated_at'
            ])
            ->selectRaw("(CASE
                WHEN a.publication_status_id = '" . PublicationStatus::DRAFT . "' THEN '" . PublicationStatus::getDescription(PublicationStatus::DRAFT). "'
                WHEN a.publication_status_id = '" . PublicationStatus::PENDING_REVIEW . "' THEN '" . PublicationStatus::getDescription(PublicationStatus::PENDING_REVIEW). "'
                WHEN a.publication_status_id = '" . PublicationStatus::PUBLISHED . "' THEN '" . PublicationStatus::getDescription(PublicationStatus::PUBLISHED). "'
                WHEN a.publication_status_id = '" . PublicationStatus::REJECTED . "' THEN '" . PublicationStatus::getDescription(PublicationStatus::REJECTED). "'
                ELSE '-' END)
            AS publication_status")
            ->get();
    }

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
                'a.id as article_id',
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
            ->selectRaw("(CASE
                WHEN a.publication_status_id = '" . PublicationStatus::DRAFT . "' THEN '" . PublicationStatus::getDescription(PublicationStatus::DRAFT). "'
                WHEN a.publication_status_id = '" . PublicationStatus::PENDING_REVIEW . "' THEN '" . PublicationStatus::getDescription(PublicationStatus::PENDING_REVIEW). "'
                WHEN a.publication_status_id = '" . PublicationStatus::PUBLISHED . "' THEN '" . PublicationStatus::getDescription(PublicationStatus::PUBLISHED). "'
                WHEN a.publication_status_id = '" . PublicationStatus::REJECTED . "' THEN '" . PublicationStatus::getDescription(PublicationStatus::REJECTED). "'
                ELSE '-' END)
            AS publication_status")
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
                    ->where(function ($query)  {
                        $query->where('au.user_id', auth()->user()->id)
                            ->orWhere('au.approval_status_id', PublicationStatus::DRAFT);
                    });
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
