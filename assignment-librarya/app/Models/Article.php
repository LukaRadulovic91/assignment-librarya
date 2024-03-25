<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Class Article
 *
 * @package App\Models
 */
class Article extends Model
{
    use HasFactory;

    public $guarded = ['id'];

    /**
     * @return BelongsToMany
     */
    public function articlesUsers(): BelongsToMany
    {
        return $this->belongsToMany(
            ArticleUser::class,
            'articles_users',
            'article_id',
            'user_id'
        )->withTimestamps();
    }
}
