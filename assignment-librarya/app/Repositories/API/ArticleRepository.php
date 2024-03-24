<?php

namespace App\Repositories\API;

use App\Models\Article;
use App\Models\JobAd;
use App\Models\Shift;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Enums\PublicationStatus;

/**
 * Class ArticleRepository
 *
 * @package App\Repositories\API
 */
class ArticleRepository
{
    /**
     * @return Collection
     */
    public function getReviewedArticles(): Collection
    {
        return DB::table('articles as a')
            ->join('articles_users as au', 'a.id', '=', 'au.user_id')
            ->where(function ($query) {
                $query->where('a.publication_status_id', PublicationStatus::REJECTED)
                      ->orWhere('a.publication_status_id', PublicationStatus::PUBLISHED);
            })
            ->where('au.user_id', auth()->user()->id)
            ->select([
                'a.*'
            ])
            ->get();
    }

    /**
     * @return Collection
     */
    public function getUnreviewedArticles(): Collection
    {
        return DB::table('articles as a')
            ->where('a.publication_status_id', PublicationStatus::PENDING_REVIEW)
            ->select([
                'a.*'
            ])
            ->get();
    }

    /**
     * @param Request $request
     * @param Article $article
     *
     * @return void
     */
    public function reviewArticles(Request $request, Article $article): void
    {
        foreach ($request->shifts as $shiftData) {
            $this->updateShift($shiftData, $article);
        }
    }

    /**
     * @param $shiftData
     * @param $jobAd
     *
     * @return void
     */
    private function updateShift($shiftData, $jobAd): void
    {
//        Shift::where('id', '=', $shiftData['id'])->update(
//            [
//                'start_date' => $shiftData['start_date'],
//                'end_date' => $shiftData['end_date'],
//                'start_time' => date('H:i:s', strtotime($shiftData['start_time'])),
//                'end_time' => date('H:i:s', strtotime($shiftData['end_time'])),
//            ]
//        );
    }

    /**
     * @param array $shiftData
     * @param JobAd $jobAd
     *
     * @return void
     */
    private function createShift(array $shiftData, JobAd $jobAd): void
    {
//        Shift::create([
//            'start_date' => $shiftData['start_date'],
//            'end_date' => $shiftData['end_date'],
//            'start_time' => date('H:i:s', strtotime($shiftData['start_time'])),
//            'end_time' => date('H:i:s', strtotime($shiftData['end_time'])),
//            'job_ad_id' => $jobAd->id
//        ]);
    }
}
