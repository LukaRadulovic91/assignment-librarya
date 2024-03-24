<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', static function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth:web'])->group(function () {

    Route::get('dashboard', static function () {
        return view('home');
    })->name('dashboard');

    /** Articles routes */
    Route::group(['articles'], static function() {
        Route::resource('articles', 'App\Http\Controllers\Web\ArticleController', ['except' => ['destroy']]);
        Route::get('fetch', [App\Http\Controllers\Web\ArticleController::class, 'fetch'])->name('articles.fetch');
        Route::post('{article}/submitted', [App\Http\Controllers\Web\ArticleController::class, 'submitted'])->name('articles.submitted');
    });

    /** Statistics routes */
    Route::group(['statistics'], static function() {
        Route::resource('statistics', 'App\Http\Controllers\Web\StatisticsController', ['only' => ['index']]);
    });

    Route::fallback(static function () {
        return back();
    });
});
