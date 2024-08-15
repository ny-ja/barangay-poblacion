<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use App\Models\Document;
use App\Models\DocumentType;
use Illuminate\Http\Request;
use App\Models\DocumentCategory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreDocumentRequest;
use App\Http\Requests\UpdateDocumentRequest;

class DocumentController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $documentCategories = DocumentCategory::all();
        $documentTypes = DocumentType::all();

        $documents = Document::with('documentCategory', 'documentType')
                    ->when($search, function ($query, $search) {
                        return $query->where('name', 'like', '%' . $search . '%');
                    })
                    ->latest()
                    ->paginate(5);

        return Inertia::render('Admin/Documents/Index', [
            'documents' => $documents,
            'documentCategories' => $documentCategories,
            'documentTypes' => $documentTypes,
            'filters' => $request->only(['search'])
        ]);
    }

    public function store(StoreDocumentRequest $request)
    {
        $validatedData = $request->validated();

        $path = $request->file('file') ? $request->file('file')->store('files', 'public') : null;
        $validatedData['file_path'] = $path;
        
        $request->user()->document()->create($validatedData);

        return redirect()->back();
    }

    public function update(UpdateDocumentRequest $request, Document $document)
    {
        $validatedData = $request->validated();

        if ($request->hasFile('file')) {
            // Delete the old file if it exists
            if ($document->file_path) {
                Storage::disk('public')->delete($document->file_path);
            }
            $path = $request->file('file')->store('files', 'public');
            $validatedData['file_path'] = $path;
        }

        $document->update($validatedData);

        return redirect()->back();
    }

    public function destroy(Document $document)
    {
        if ($document->file_path) {
            Storage::disk('public')->delete($document->file_path);
        }
        $document->delete();

        return redirect()->back();
    }
}
