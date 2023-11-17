<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [FrontendController::class, 'home'])->name('home');
Route::get('/bloglist', [FrontendController::class, 'bloglist'])->name('bloglist');
Route::get('/searcharticle', [FrontendController::class, 'bloglist'])->name('searcharticle');

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::resource('blogs.comments', CommentController::class);

    Route::get('/readarticle/{slug}', [FrontendController::class, 'readArticle'])->name('readArticle');

    // Route for like or dislike article
    Route::post('like/{blog_id}/article', [LikeController::class, 'likeArticle'])->name('likeArticle');
    Route::post('dislike/{blog_id}/article', [LikeController::class, 'dislikeArticle'])->name('dislikeArticle');
    Route::delete('article/{blog_id}/cancellike/{like_id}', [LikeController::class, 'cancelLike'])->name('cancelLike');

    // Route for like or dislike comment
    Route::post('like/{blog_id}/comment/{comment_id}', [LikeController::class, 'likeComment'])->name('likeComment');
    Route::delete('comment/{blog_id}/cancellike/{comment_like_id}', [LikeController::class, 'cancelLikeComment'])->name('cancelLikeComment');
    Route::post('dislike/{blog_id}/comment/{comment_id}', [LikeController::class, 'dislikeComment'])->name('dislikeComment');

    Route::prefix('dashboard')->name('dashboard.')->group(function () {
        Route::resource('news', NewsController::class);
        Route::resource('blogs', BlogController::class);

        Route::middleware(['IsAdmin'])->group(function () {
            Route::get('/newarticle', [BlogController::class, 'newArticle'])->name('newArticle');
            Route::patch('/article/{accepted}', [BlogController::class, 'acceptedArticle'])->name('acceptedArticle');
        });
    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
