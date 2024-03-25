<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use App\Models\Article;
use App\Http\Controllers\Controller;
use App\Http\Resources\ArticleResource;
use App\Repositories\API\ArticleRepository;

/**
 * Class StatisticsController
 *
 * @package App\Http\Controllers\API
 */
class StatisticsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return (ArticleResource::collection($this->articleRepository->getArticles()))
            ->response()
            ->setStatusCode(Response::HTTP_OK);
    }
}
