<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(int $blog_id)
    {
        $comments = Comment::with('user')->where('blog_id', $blog_id)->where('user_id', '!=', Auth::user()->id)->get();

        $myComments = Comment::with('user')->where('user_id', Auth::user()->id)->where('blog_id', $blog_id)->get();

        return [
            'comments' => $comments,
            'myComments' => $myComments
        ];
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Blog $blog)
    {
        // dd($blog);
        $request->validate([
            'comment' => 'required|string'
        ]);

        // $slug = Blog::where('id', $request->blog_id)->first()->slug;

        Comment::create([
            'content_comment' => $request->comment,
            'blog_id' => $blog->id,
            'user_id' => Auth::user()->id
        ]);

        return to_route('readArticle', $blog->slug);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Blog $blog, Comment $comment)
    {
        // dd($request);
        $request->validate([
            'myComment' => 'required|string'
        ]);

        $comment->content_comment = $request->myComment;

        $comment->save();

        return to_route('readArticle', $blog->slug);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog, Comment $comment)
    {
        $comment->delete();

        return to_route('readArticle', $blog->slug);
    }

    public function mycomments(int $blog_id)
    {
        return Blog::where(['user_id', '=', Auth::user()->id], ['blog_id', '=', $blog_id])->get();
    }
}
