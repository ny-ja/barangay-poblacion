<?php

namespace App\Http\Controllers\Admin;

use App\Models\News;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreNewsRequest;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UpdateNewsRequest;
use App\Models\NewsCategory;

class NewsController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $newsCategories = NewsCategory::all();

        $news = News::with('newsCategory')
                    ->when($search, function ($query, $search) {
                        return $query->where('title', 'like', '%' . $search . '%');
                    })
                    ->latest()
                    ->paginate(5);

        return Inertia::render('Admin/News/Index', [
            'news' => $news,
            'newsCategories' => $newsCategories,
            'filters' => $request->only(['search'])
        ]);
    }

    public function store(StoreNewsRequest $request)
    {
        $validatedData = $request->validated();

        $path = $request->file('news_photo') ? $request->file('news_photo')->store('news_photos', 'public') : null;
        $validatedData['news_photo_path'] = $path;
        
        $request->user()->news()->create($validatedData);

        return redirect()->back()->with('success', 'News created successfully.');
    }

    public function update(UpdateNewsRequest $request, News $news)
    {
        $validatedData = $request->validated();

        if ($request->hasFile('news_photo')) {
            // Delete the old news photo if it exists
            if ($news->news_photo_path) {
                Storage::disk('public')->delete($news->news_photo_path);
            }
            $path = $request->file('news_photo')->store('news_photos', 'public');
            $validatedData['news_photo_path'] = $path;
        }

        $news->update($validatedData);

        return redirect()->back()->with('success', 'News updated successfully.');
    }

    public function destroy(News $news)
    {
        if ($news->news_photo_path) {
            Storage::disk('public')->delete($news->news_photo_path);
        }
        $news->delete();

        return redirect()->back()->with('success', 'News deleted successfully.');
    }
}
