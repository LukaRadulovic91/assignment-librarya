<?php

namespace App\Http\Resources;

use App\Enums\ApprovalStatus;
use App\Enums\PublicationStatus;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ArticleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'user_id' => $this->user_id,
            'user_name' => $this->user_name,
            'user_email' => $this->user_email,
            'article_id' => $this->article_id,
            'article_title' => $this->article_title,
            'article_text' => $this->article_text,
            'publication_status' => PublicationStatus::getDescription($this->publication_status_id),
            'approval_status_id' => ApprovalStatus::getDescription($this->approval_status_id),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
