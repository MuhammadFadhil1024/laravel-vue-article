<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\News;
use Carbon\Carbon;
use Inertia\Inertia;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogByIdUserAll = Blog::where('user_id', Auth::user()->id)->get();
        $collectDataBlogByIdUser = $blogByIdUserAll->collect();

        return Inertia::render('Dashboard/Blog/Index', [
            'blogs' => $collectDataBlogByIdUser
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Dashboard/Blog/Create', []);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required|max:100|string',
            'content' => 'required',
            'thumbnile' => 'required|image|mimes:jpeg,jpg,png,gif,svg|max:2048'
        ]);

        if ($request->hasFile('thumbnile')) {
            $thumbnilePath = 'thumbnile/';
            $imageProfile = date('YmdHis') . "." . $request->thumbnile->getClientOriginalExtension();
            $request->thumbnile->move($thumbnilePath, $imageProfile);
        }

        Blog::create([
            'title' => $request->title,
            'content' => $request->content,
            'slug' => Str::slug($request->title, '-'),
            'user_id' => Auth::user()->id,
            'image_url' => $imageProfile,
        ]);

        return to_route('dashboard.blogs.index');
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
    public function edit(Blog $blog)
    {
        // dd($blog);
        return Inertia::render('Dashboard/Blog/Edit', [
            'blog' => $blog
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Blog $blog)
    {
        // dd($blog);
        $request->validate([
            'title' => 'required|max:100|string',
            'content' => 'required',
        ]);

        if ($request->thumbnile === $blog->image_url) {
            $blog->title = $request->title;
            $blog->content = $request->content;
            $blog->slug = Str::slug($request->title, '-');

            $blog->save();
        } else {

            unlink(public_path('thumbnile/' . $blog->image_url));

            if ($request->hasFile('thumbnile')) {
                $thumbnilePath = 'thumbnile/';
                $imageProfile = date('YmdHis') . "." . $request->thumbnile->getClientOriginalExtension();
                $request->thumbnile->move($thumbnilePath, $imageProfile);
            }

            $blog->title = $request->title;
            $blog->content = $request->content;
            $blog->image_url = $imageProfile;
            $blog->slug = Str::slug($request->title, '-');

            $blog->save();
        }


        return to_route('dashboard.blogs.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        $blog->delete();

        unlink(public_path('thumbnile/' . $blog->image_url));

        return to_route('dashboard.blogs.index');
    }

    public function newArticle()
    {
        $articleIsReviewAll = Blog::where('status', 'review')->get();
        $collectDataArticleisReview = $articleIsReviewAll->collect();

        return Inertia::render('Dashboard/Blog/NewArticle', [
            'blogs' => $collectDataArticleisReview
        ]);
    }

    public function acceptedArticle(int $id)
    {
        $isArticleForAccepted = Blog::where('id', $id)->first();
        $isArticleForAccepted->status = 'accepted';
        $isArticleForAccepted->publish_date = Carbon::today();
        $isArticleForAccepted->save();

        return to_route('dashboard.newArticle');
    }
}
