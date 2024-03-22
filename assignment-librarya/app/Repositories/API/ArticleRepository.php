<?php

namespace App\Repositories\API;

use DB;
use Carbon\Carbon;
use App\Enums\Roles;
use App\Models\User;

/**
 * Class ArticleRepository
 *
 * @package App\Repositories\API
 */
class ArticleRepository
{
    /**
     * @return mixed
     */
    public function getArticles(): mixed
    {
//        return DB::table('job_ads as ja')
//            ->leftJoin('clients as c', 'c.id', '=', 'ja.client_id')
//            ->leftJoin('users as u', 'u.id', '=', 'c.user_id')
//            ->where(function ($query) use ($user) {
//                $query->where('u.id', $user->id)
//                      ->where('ja.client_id', $user->client->id);
//            })
//            ->where('ja.job_ad_status_id', '!=', JobAdStatus::PENDING_REVIEW)
//            ->whereNull('ja.deleted_at')
//            ->whereNull('u.deleted_at')
//            ->select([
//                'ja.id',
//                'ja.client_id',
//                'ja.job_ad_type',
//                'ja.title',
//                'ja.job_description',
//                'ja.pay_rate',
//                'ja.payment_time',
//                'ja.years_experience',
//                'ja.permament_start_date',
//                'ja.client_feedback',
//                'ja.is_active',
//                'ja.lunch_break',
//                'ja.lunch_break_duration',
//                'c.company_name as company_name',
//                'c.office_address as office_address',
//                'u.first_name',
//                'u.last_name'
//            ])
//            ->get();
//    }
}
