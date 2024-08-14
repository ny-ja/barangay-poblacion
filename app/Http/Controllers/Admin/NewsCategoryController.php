<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\NewsCategoryRequest;
use App\Models\NewsCategory;

class NewsCategoryController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $categories = NewsCategory::when($search, function ($query, $search) {
                        return $query->where('name', 'like', '%' . $search . '%');
                    })
                    ->latest()
                    ->paginate(5);

        return Inertia::render('Admin/NewsCategories/Index', [
            'categories' => $categories,
            'filters' => $request->only(['search'])
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
