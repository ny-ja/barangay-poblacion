<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Document;
use App\Models\DocumentType;

class PeaceAndOrderController extends Controller
{
    public function index()
    {
        $documentTypes = DocumentType::all();

        $documents = Document::with('documentCategory', 'documentType')
            ->where('document_category_id', 7)
            ->latest()
            ->paginate(6);

        return Inertia::render('PeaceAndOrder/Index', [
            'documents' => $documents,
            'documentTypes' => $documentTypes,
        ]);
    }
}
