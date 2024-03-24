<?php

namespace App\Http\Controllers\Web;

use Illuminate\Support\Facades\Redirect;
use Yajra\DataTables\Exceptions\Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use App\Enums\PublicationStatus;
use App\Models\Article;
use App\Http\Requests\CreateArticleRequest;
use App\Http\Controllers\Controller;
use App\Services\ArticleService;

/**
 * Class ArticleController
 *
 * @package App\Http\Controllers\Web
 */
class ArticleController extends Controller
{
    /**
     * @var ArticleService
     */
    private ArticleService $articleService;

    /**
     * ArticleController constructor.
     *
     * @param ArticleService $articleService
     */
    public function __construct(ArticleService $articleService)
    {
        $this->articleService = $articleService;
    }
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
            $article = Article::create(array_merge($request->validated(), ['publication_status_id' => PublicationStatus::DRAFT]));
            $this->articleService->setApprovalStatus($article);
        } catch (\Exception $exception) {
            Log::error($exception);
        }

        return Redirect::route('articles.index')->with(
            'systemMessage', ['created' => 'Your record has been successfully created!']
        );
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
            $this->articleService->setApprovalStatus($article);

        } catch (\Exception $exception) {
            Log::error($exception);
            $this->error($exception->getMessage());
        }

        return redirect()->route('articles.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Article $article
     *
     * @return JsonResponse
     */
    public function submitted(Article $article): JsonResponse
    {
        try {
            $article->update([ 'publication_status_id' => PublicationStatus::PENDING_REVIEW ]);
            $this->articleService->setApprovalStatus($article);

        } catch (\Exception $exception) {
            Log::error($exception);
            $this->error($exception->getMessage());
        }

        return response()->json([
            'type' => 'success',
            'notification' => __('Publication status has been successfully changed!')
        ]);
    }
}
