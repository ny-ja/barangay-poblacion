<?php

namespace App\Http\Controllers;

use App\Models\News;
use Inertia\Inertia;
use App\Models\NewsCategory;

class NewsController extends Controller
{
    public function index()
    {
        $newsCategories = NewsCategory::all();

        $news = News::with('newsCategory')->latest()->paginate(6);

        return Inertia::render('News/Index', [
            'news' => $news,
            'newsCategories' => $newsCategories,
        ]);
    }
}
