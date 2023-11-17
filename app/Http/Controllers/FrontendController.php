<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\News;
use Inertia\Inertia;
use App\Models\Comment;
use App\Models\Category;
use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class FrontendController extends Controller
{
    public function home()
    {
        $dataNewArticle = Blog::with('author')->orderBy('created_at', 'desc')->where('status', 'accepted')->limit(4)->get();
        $collectdataNewArticle = $dataNewArticle->collect();

        $isHotArticle = Blog::withCount('likes')->orderByDesc('likes_count')->first();

        return Inertia::render('Home', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'newArticle' => $collectdataNewArticle,
            'isHotArticle' => $isHotArticle,
        ]);
    }

    public function readArticle(string $slug)
    {
        $blog_id = Blog::where('slug', $slug)->first()->id;

        $comments = Comment::with('user', 'likes')->where('blog_id', $blog_id)->get();

        $collectComments = $comments->collect();

        $collectDataMapComments = $collectComments->map(function ($comments, $key) {

            $status = [];

            foreach ($comments->likes as $key => $like) {
                if ($like->is_like == 1 && $like->user_id == Auth::user()->id) {
                    $status['status'] =  1;
                    $status['like_id'] = $like->id;
                } elseif ($like->is_like == 2 && $like->user_id == Auth::user()->id) {
                    $status['status'] =  2;
                    $status['like_id'] = $like->id;
                }
            }
            // dd($status);
            return [

                'id' => $comments->id,
                'user_id' => $comments->user_id,
                'blog_id' => $comments->blog_id,
                'content_comment' => $comments->content_comment,
                'created_at' => $comments->created_at,
                'updated_at' => $comments->updated_at,
                'status_like' => $status,
                'user' => $comments->user
            ];
        });
        // dd($collectDataMapComments);
        $checkHasBeenLike = Like::where('user_id', Auth::user()->id)->where('is_blog', 1)->where('is_like', 1)->orWhere('is_like', 2)->first();
        // dd($checkHasBeenLike);
        if ($checkHasBeenLike) {
            if ($checkHasBeenLike->is_like == 1) {
                // Condition 1: User has liked the article
                $hasBeenLikeArticle = [
                    'status' => $checkHasBeenLike->is_like,
                    'like_id' => $checkHasBeenLike->id
                ];
            } else {
                // Condition 2: User has disliked the article
                $hasBeenLikeArticle = [
                    'status' => $checkHasBeenLike->is_like,
                    'like_id' => $checkHasBeenLike->id
                ];
            }
        } else {
            // Condition 3: User has neither liked nor disliked the article
            $hasBeenLikeArticle = [
                'status' => 3,
            ];
        }

        // dd($hasBeenLikeArticle);

        if (Auth::check()) {
            $myComments = Comment::with('user')->where('user_id', Auth::user()->id)->where('blog_id', $blog_id)->get();
        } else {
            $myComments = null;
        }

        return Inertia::render('ReadArticle', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'readArticle' => Blog::with('author')->findOrFail($blog_id),
            'comments' => $collectDataMapComments,
            'myComments' => $myComments,
            'authUser' => Auth::user(),
            'hasBeenLikeArticle' => $hasBeenLikeArticle
        ]);
    }

    public function bloglist(Request $request)
    {
        return Inertia::render('Bloglist', [
            'listArticle' => Blog::query()
                ->when($request->input('search'), function ($query, $search) {
                    $query->where('title', 'like', '%' . $search . '%')
                        ->orWhere('content', 'like', '%' . $search . '%');
                })->paginate(12)->withQueryString(),
            'filters' => $request->only(['search']),
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
        ]);
    }
}
