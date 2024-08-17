<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Document;
use App\Models\DocumentType;
use App\Models\CommitteeMember;

class DRRMController extends Controller
{
    public function index()
    {
        $documentTypes = DocumentType::all();
        $members = CommitteeMember::with('committee')->get();

        $documents = Document::with('documentCategory', 'documentType')
            ->where('document_category_id', 4)
            ->latest()
            ->paginate(6);

        return Inertia::render('DRRM/Index', [
            'documents' => $documents,
            'members' => $members,
            'documentTypes' => $documentTypes,
        ]);
    }
}
