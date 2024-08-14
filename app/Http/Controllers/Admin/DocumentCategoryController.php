<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use App\Models\DocumentCategory;
use App\Http\Controllers\Controller;
use App\Http\Requests\DocumentCategoryRequest;

class DocumentCategoryController extends Controller
{
    public function index()
    {
        $categories = DocumentCategory::latest()->paginate(5);

        return Inertia::render('Admin/DocumentCategories/Index', [
            'categories' => $categories,
        ]);
    }

    public function store(DocumentCategoryRequest $request)
    {
        $request->user()->documentCategory()->create($request->validated());

        return redirect()->back()->with('success', 'Document Category added successfully.');
    }

    public function update(DocumentCategoryRequest $request, DocumentCategory $category){

        $category->update($request->validated());

        return redirect()->back()->with('success', 'Document Category Updated Succesfully.');
    }

    public function destroy(DocumentCategory $category)
    {
        $category->delete();
        
        return redirect()->back()->with('success', 'Document Category deleted successfully.');
    }
}
