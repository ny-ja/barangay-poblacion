<?php

namespace App\Http\Controllers;

use App\Models\CommitteeMember;
use Inertia\Inertia;
use App\Models\Document;
use App\Models\DocumentType;

class AgricultureController extends Controller
{
    public function index()
    {
        $documentTypes = DocumentType::all();
        $members = CommitteeMember::with('committee')->get();

        $documents = Document::with('documentCategory', 'documentType')
            ->where('document_category_id', 3)
            ->latest()
            ->paginate(6);

        return Inertia::render('Agriculture/Index', [
            'documents' => $documents,
            'members' => $members,
            'documentTypes' => $documentTypes,
        ]);
    }
}
