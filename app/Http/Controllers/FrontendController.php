<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\News;
use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function home()
    {
        $latest_news = News::orderBy('created_at', 'desc')->limit(4)->get();

        $collection = $latest_news->collect();

        $latest_news_map = $collection->map(function ($latest_news, $key) {
            return [
                'title' => $latest_news->title,
                'category_name' => $latest_news->category->category_name,
                'thumbnile' => $latest_news->image_url,
                'created_at' => $latest_news->created_at
            ];
        });

        // dd(Category::all());

        return Inertia::render('Home', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'latest_news' => $latest_news_map,
            'isHotNews' => News::where('is_hot_news', 1)->first(),
            'categories' => Category::all()
        ]);
    }

    public function readnews(string $slug)
    {
        $newsId = News::where('slug', $slug)->first()->id;

        return Inertia::render('Readnews', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'readNews' => News::findOrFail($newsId)
        ]);
    }
}
