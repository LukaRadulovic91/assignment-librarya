<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Models\Article;

/**
 * Class ArticleService
 *
 * @package App\Repositories\API
 */
class ArticleService
{
    /**
     * @param Request $request
     *
     * @return void
     */
    public function reviewArticles(Request $request): void
    {
        foreach ($request->validated()['data'] as $article) {
            $existingRecord = Article::find($article['id']);
            if ($existingRecord) {
                $existingRecord->articlesUsers()->detach();
                $existingRecord->articlesUsers()->attach($existingRecord->id, [
                    'user_id' => auth()->user()->id,
                    'approval_status_id' => $article['value']
                ]);
            }
        }
    }
}
