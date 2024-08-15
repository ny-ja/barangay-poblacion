<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Document;
use App\Models\DocumentType;

class AgricultureController extends Controller
{
    public function index()
    {
        $documentTypes = DocumentType::all();

        $documents = Document::with('documentCategory', 'documentType')
            ->where('document_category_id', 3)
            ->latest()
            ->paginate(6);

        return Inertia::render('Agriculture/Index', [
            'documents' => $documents,
            'documentTypes' => $documentTypes,
        ]);
    }
}
