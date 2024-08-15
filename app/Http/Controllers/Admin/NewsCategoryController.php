<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use App\Http\Controllers\Controller;
use App\Http\Requests\NewsCategoryRequest;
use App\Models\NewsCategory;

class NewsCategoryController extends Controller
{
    public function index()
    {
        $categories = NewsCategory::orderBy('id', 'asc')->latest()->paginate(10);

        return Inertia::render('Admin/NewsCategories/Index', [
            'categories' => $categories,
        ]);
    }

    public function store(NewsCategoryRequest $request)
    {
        $request->user()->newsCategory()->create($request->validated());

        return redirect()->back();
    }

    public function update(NewsCategoryRequest $request, NewsCategory $category){

        $category->update($request->validated());

        return redirect()->back();
    }

    public function destroy(NewsCategory $category)
    {
        $category->delete();
        
        return redirect()->back();
    }
}
