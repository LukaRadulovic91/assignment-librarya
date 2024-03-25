<?php

namespace App\Observers;

use App\Enums\PublicationStatus;
use App\Services\ArticleService;
use App\Models\ArticleUser;

/**
 * Class ArticleObserver
 *
 * @package App\Observers
 */
class ArticleObserver
{
    /**
     * @var ArticleService
     */
    private ArticleService $articleService;

    /**
     * ArticleObserver constructor.
     *
     * @param ArticleService $articleService
     */
    public function __construct(ArticleService $articleService)
    {
        $this->articleService = $articleService;
    }

    /**
     * Handle the ArticleService "created" event.
     *
     * @param ArticleUser $articleUser
     */
    public function created(ArticleUser $articleUser)
    {
        !$this->articleService->checkRejectedApprovalStatus($articleUser) ?:
            $this->articleService->setPublicationStatus($articleUser, PublicationStatus::REJECTED);

        !$this->articleService->checkPublishingApprovalStatus($articleUser) ?:
            $this->articleService->setPublicationStatus($articleUser, PublicationStatus::PUBLISHED);
    }
}
