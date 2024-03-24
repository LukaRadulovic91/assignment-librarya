<?php

namespace App\Http\Controllers\Web;

use Yajra\DataTables\Exceptions\Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use App\Enums\PublicationStatus;
use App\Models\Article;
use App\Http\Requests\CreateArticleRequest;
use App\Http\Controllers\Controller;

/**
 * Class ArticleController
 *
 * @package App\Http\Controllers\Web
 */
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
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('isAuthor');

        return view('pages.articles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateArticleRequest $request
     *
     * @return RedirectResponse
     */
    public function store(CreateArticleRequest $request): RedirectResponse
    {
        try {
            Article::create(array_merge($request->validated(), ['publication_status_id' => PublicationStatus::DRAFT]));
        } catch (\Exception $exception) {
            Log::error($exception);
            $this->error($exception->getMessage());
        }

        return redirect()->route('articles.index');
    }

    /**
     * Display the specified resource.
     *
     * @param Article $article
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function show(Article $article)
    {
        return view('pages.articles.show')->with([
            'article' => $article
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Article $article
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function edit(Article $article)
    {
        return view('pages.articles.edit')->with([
            'article' => $article
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CreateArticleRequest $request
     * @param Article $article
     *
     * @return RedirectResponse
     */
    public function update(CreateArticleRequest $request, Article $article): RedirectResponse
    {
        try {
            $article->update([
                'publication_status_id' => PublicationStatus::DRAFT,
                'title' => $request->title,
                'text' => $request->text
            ]);
        } catch (\Exception $exception) {
            Log::error($exception);
            $this->error($exception->getMessage());
        }

        return redirect()->route('articles.index');
    }
}
