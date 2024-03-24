<?php

namespace App\Http\Controllers\Web;

use App\Repositories\API\ArticleRepository;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\View\View;
use Yajra\DataTables\Exceptions\Exception;

class StatisticsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $this->authorize('isReviewer');

        return view('pages.statistics.index');
    }

    /**
     * @param ArticleRepository $articleRepository
     *
     * @return JsonResponse
     *
     * @throws Exception
     */
    public function fetch(ArticleRepository $articleRepository)
    {
        return datatables($articleRepository->getReviewedArticles())->toJson();
    }
}
