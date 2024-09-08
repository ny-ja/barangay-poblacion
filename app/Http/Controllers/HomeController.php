<?php

namespace App\Http\Controllers;

use App\Models\News;
use Inertia\Inertia;
use App\Models\NewsCategory;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $newsCategories = NewsCategory::all();

        $news = News::with('newsCategory')->latest()->paginate(3);

        return Inertia::render('Home', [
            'news' => $news,
            'newsCategories' => $newsCategories,
        ]);
    }
}
