<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Document;
use App\Models\DocumentType;

class ResourceController extends Controller
{
    public function index()
    {
        $documentTypes = DocumentType::all();

        $documents = Document::with('documentCategory', 'documentType')
            ->where('document_category_id', 2)
            ->latest()
            ->paginate(6);

        return Inertia::render('Resources/Index', [
            'documents' => $documents,
            'documentTypes' => $documentTypes,
        ]);
    }
}
