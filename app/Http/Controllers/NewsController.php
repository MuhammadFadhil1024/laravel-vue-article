<?php

namespace App\Http\Controllers;

use App\Models\News;
use Inertia\Inertia;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\NewsRequest;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Dashboard/News/Index', [
            'news' => News::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Dashboard/News/Create', [
            'categories' => Category::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(NewsRequest $request)
    {

        $availableHotNews = News::where('is_hot_news', 1)->first();

        if ($availableHotNews) {
            $availableHotNews->is_hot_news = 0;
            $availableHotNews->save();
        }

        if ($request->hasFile('thumbnile')) {
            $thumbnilePath = 'thumbnile/';
            $imageProfile = date('YmdHis') . "." . $request->thumbnile->getClientOriginalExtension();
            $request->thumbnile->move($thumbnilePath, $imageProfile);
        }

        News::create([
            'title' => $request->title,
            'content' => $request->content,
            'slug' => Str::slug($request->title, '-'),
            'user_id' => Auth::user()->id,
            'is_hot_news' => $request->hotNews,
            'image_url' => $imageProfile,
            'categories_id' => $request->category
        ]);

        return to_route('dashboard.news.index');
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
    public function edit(News $news)
    {
        return Inertia::render('Dashboard/News/Edit', [
            'news' => $news->load('category'),
            'categories' => Category::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, News $news)
    {

        // dd($request->thumbnile == $news->image_url);

        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'category' => 'required',
            // 'thumbnile' => 'sometimes|required|image|mimes:jpeg,jpg,png,gif,svg|max:2048'
        ]);

        $availableHotNews = News::where('is_hot_news', 1)->first();

        if ($availableHotNews) {
            $availableHotNews->is_hot_news = 0;
            $availableHotNews->save();
        }

        if ($request->thumbnile === $news->image_url) {
            $news->title = $request->title;
            $news->content = $request->content;
            $news->is_hot_news = $request->hotNews;
            $news->slug = Str::slug($request->title, '-');

            $news->save();
        } else {

            unlink(public_path('thumbnile/' . $news->image_url));

            if ($request->hasFile('thumbnile')) {
                $thumbnilePath = 'thumbnile/';
                $imageProfile = date('YmdHis') . "." . $request->thumbnile->getClientOriginalExtension();
                $request->thumbnile->move($thumbnilePath, $imageProfile);
            }

            $news->title = $request->title;
            $news->content = $request->content;
            $news->image_url = $imageProfile;
            $news->is_hot_news = $request->hotNews;
            $news->slug = Str::slug($request->title, '-');

            $news->save();
        }


        return to_route('dashboard.news.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(News $news)
    {
        $news->delete();

        return to_route('dashboard.news.index');
    }
}
