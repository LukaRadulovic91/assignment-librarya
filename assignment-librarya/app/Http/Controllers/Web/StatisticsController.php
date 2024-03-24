<?php

namespace App\Http\Controllers\Web;

use App\Repositories\API\ArticleRepository;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\Article;
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

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Article $article)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        //
    }
}
