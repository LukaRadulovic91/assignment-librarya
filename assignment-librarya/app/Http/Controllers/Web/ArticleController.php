<?php

namespace App\Http\Controllers\Web;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\Article;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Exceptions\Exception;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('pages.articles.index');
    }

    /**
     * @return JsonResponse
     *
     * @throws Exception
     */
    public function fetch()
    {
        return datatables(Article::get())->toJson();

//        $demo = $this->clientDatatableRepository->getQuery();
//        return datatables()->of($demo)
//            ->filter(function ($query) use ($request) {
//                $this->clientDatatableRepository->filterByCustomQuery($query, $request->all());
//                $this->clientDatatableRepository->filterByQuery($query, $request->all());
//            })
//            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('isAuthor');

        return view('pages.articles.create');
//        ->with([
//            'users' => $this->getUsers()->toArray(),
//        ]);
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
