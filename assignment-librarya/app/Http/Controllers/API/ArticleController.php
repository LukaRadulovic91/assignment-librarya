<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\UpdateArticleRequest;
use App\Http\Resources\ArticleResource;
use App\Services\ArticleService;
use App\Repositories\API\ArticleRepository;
use App\Http\Controllers\Controller;

class ArticleController extends Controller
{
    /** @var ArticleService $articleService */
    private $articleService;

    /** @var ArticleRepository $articleRepository */
    private $articleRepository;

    /**
     * ArticleController constructor.
     *
     * @param ArticleRepository $articleRepository
     * @param ArticleService $articleService
     */
    public function __construct(
        ArticleRepository $articleRepository,
        ArticleService $articleService
    )
    {
        $this->articleService = $articleService;
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
     * Adding review/s for articles resource.
     *
     * @param UpdateArticleRequest $request
     *
     * @return JsonResponse
     */
    public function reviewArticles(UpdateArticleRequest $request): JsonResponse
    {
        try {
            $this->articleService->reviewArticles($request);
        } catch (\Exception $exception) {
            Log::error($exception);
        }

        return response()->json([
            'message' => 'Articles has been successfully reviewed!',
            'status' => Response::HTTP_CREATED
        ]);
    }
}
