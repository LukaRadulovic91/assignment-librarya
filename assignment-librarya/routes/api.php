<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['auth:api', 'verified'])->group(function () {

    /** Reviewer routes */
    Route::group(['reviewer'], static function() {
        Route::get('test', static function () {
            return 'this is working';
        });
    });

    /** Articles routes */
    Route::group(['articles'], static function() {
        Route::get('reviewed-articles', [
            App\Http\Controllers\API\ArticleController::class,
            'getReviewedArticles'
        ]);

        Route::get('unreviewed-articles', [
            App\Http\Controllers\API\ArticleController::class,
            'getUnreviewedArticles'
        ]);

        Route::post('review-articles', [
            App\Http\Controllers\API\ArticleController::class,
            'reviewArticles'
        ]);
    });

    Route::post('logout', [\App\Http\Controllers\API\AuthController::class, 'logout']);

});

Route::post('login', [\App\Http\Controllers\API\AuthController::class, 'login'])->name('api.login');
