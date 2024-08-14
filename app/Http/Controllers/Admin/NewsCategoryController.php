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
        $categories = NewsCategory::latest()->paginate(5);

        return Inertia::render('Admin/NewsCategories/Index', [
            'categories' => $categories,
        ]);
    }

    public function store(NewsCategoryRequest $request)
    {
        $request->user()->newsCategory()->create($request->validated());

        return redirect()->back()->with('success', 'News Category added successfully.');
    }

    public function update(NewsCategoryRequest $request, NewsCategory $category){

        $category->update($request->validated());

        return redirect()->back()->with('success', 'News Category Updated Succesfully.');
    }

    public function destroy(NewsCategory $category)
    {
        $category->delete();
        
        return redirect()->back()->with('success', 'News Category deleted successfully.');
    }
}
