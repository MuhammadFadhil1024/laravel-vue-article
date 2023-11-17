<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function likeArticle(int $blogId)
    {

        $slugArticle = Blog::where('id', $blogId)->first()->slug;

        Like::create([
            'user_id' => Auth::user()->id,
            'is_blog' => 1,
            'blog_id' => $blogId,
            'is_like' => 1,

        ]);

        return to_route('readArticle', $slugArticle);
    }

    public function dislikeArticle(int $blogId)
    {

        $slugArticle = Blog::where('id', $blogId)->first()->slug;
        // dd($slugArticle);
        Like::create([
            'user_id' => Auth::user()->id,
            'is_blog' => 1,
            'blog_id' => $blogId,
            'is_like' => 2,

        ]);

        return to_route('readArticle', $slugArticle);
    }

    public function cancelLike(int $blogId, int $likeId)
    {
        $articleSlug = Blog::where('id', $blogId)->first()->slug;
        Like::where('id', $likeId)->first()->delete();

        return to_route('readArticle', $articleSlug);
    }

    public function likeComment(int $blogId, int $commentId)
    {
        // dd($commentId);
        $articleSlug = Blog::where('id', $blogId)->first()->slug;

        Like::create([
            'user_id' => Auth::user()->id,
            'is_comment' => 1,
            'blog_id' => $blogId,
            'comment_id' => $commentId,
            'is_like' => 1,

        ]);

        return to_route('readArticle', $articleSlug);
    }

    public function dislikeComment(int $blogId, int $commentId)
    {
        $slugArticle = Blog::where('id', $blogId)->first()->slug;
        // dd($slugArticle);
        Like::create([
            'user_id' => Auth::user()->id,
            'is_comment' => 1,
            'comment_id' => $commentId,
            'blog_id' => $blogId,
            'is_like' => 2,

        ]);

        return to_route('readArticle', $slugArticle);
    }

    public function cancelLikeComment(int $blogId, int $commentLikeId)
    {
        $articleSlug = Blog::where('id', $blogId)->first()->slug;
        Like::where('id', $commentLikeId)->first()->delete();

        return to_route('readArticle', $articleSlug);
    }
}
