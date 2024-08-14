<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use App\Models\DocumentType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\DocumentTypeRequest;

class DocumentTypeController extends Controller
{
    public function index()
    {
        $types = DocumentType::latest()->paginate(5);

        return Inertia::render('Admin/DocumentTypes/Index', [
            'types' => $types,
        ]);
    }

    public function store(DocumentTypeRequest $request)
    {
        $request->user()->documentType()->create($request->validated());

        return redirect()->back()->with('success', 'Document Type added successfully.');
    }

    public function update(DocumentTypeRequest $request, DocumentType $type){

        $type->update($request->validated());

        return redirect()->back()->with('success', 'Document Type Updated Succesfully.');
    }

    public function destroy(DocumentType $type)
    {
        $type->delete();
        
        return redirect()->back()->with('success', 'Document Type deleted successfully.');
    }
}