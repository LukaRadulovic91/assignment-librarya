<?php

namespace App\Http\Controllers\API;

use App\Enums\ApprovalStatus;
use App\Http\Requests\UpdateArticleRequest;
use App\Http\Resources\Mobile\JobAdResource;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use App\Models\Article;
use App\Http\Controllers\Controller;
use App\Http\Resources\ArticleResource;
use App\Repositories\API\ArticleRepository;

class ArticleController extends Controller
{
    /** @var ArticleRepository $articleRepository */
    private $articleRepository;

    /**
     * ArticleController constructor.
     *
     * @param ArticleRepository $articleRepository
     */
    public function __construct(ArticleRepository $articleRepository)
    {
        $this->articleRepository = $articleRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function getReviewedArticles(): JsonResponse
    {
        return (ArticleResource::collection($this->articleRepository->getReviewedArticles()))
            ->response()
            ->setStatusCode(Response::HTTP_OK);
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function getUnreviewedArticles(): JsonResponse
    {
        return (ArticleResource::collection($this->articleRepository->getUnreviewedArticles()))
            ->response()
            ->setStatusCode(Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param UpdateArticleRequest $request
     *
     * @return JsonResponse
     */
    public function reviewArticles(UpdateArticleRequest $request): JsonResponse
    {
        foreach ($request->validated()['data'] as $article) {

            $existingRecord = Article::find($article['id']);

            if ($existingRecord) {
                $existingRecord->articlesUsers()->attach($existingRecord->id, [
                    'user_id' => auth()->user()->id,
                    'approval_status_id' => $article['value']
                ]);
            }

        }

        return response()->json([
            'message' => 'Articles has been successfully reviewed!',
            'status' => Response::HTTP_OK
        ]);
    }
}
