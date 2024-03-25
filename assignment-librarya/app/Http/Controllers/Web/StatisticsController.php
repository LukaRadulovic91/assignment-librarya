<?php

namespace App\Http\Controllers\Web;

use Illuminate\View\View;
use App\Repositories\API\ArticleRepository;
use App\Http\Controllers\Controller;

/**
 * Class StatisticsController
 *
 * @package App\Http\Controllers\Web
 */
class StatisticsController extends Controller
{
    /**
     * @var ArticleRepository
     */
    private ArticleRepository $articleRepository;

    /**
     * StatisticsController constructor.
     *
     * @param ArticleRepository $articleRepository
     */
    public function __construct(ArticleRepository $articleRepository)
    {
        $this->articleRepository = $articleRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $this->authorize('isReviewer');

        return view('pages.statistics.index', [
            'reviewedArticles' => $this->articleRepository->getReviewedArticles()->count(),
            'unreviewedArticles' => $this->articleRepository->getUnreviewedArticles()->count()
        ]);
    }
}
