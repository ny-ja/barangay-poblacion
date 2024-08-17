<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Document;
use App\Models\DocumentType;
use App\Models\CommitteeMember;
use App\Models\CommitteeDocument;

class DRRMController extends Controller
{
    public function index()
    {
        $documentTypes = DocumentType::all();
        $members = CommitteeMember::with('committee')->get();

        $committeeDocuments = CommitteeDocument::with('committee', 'documentType')
            ->where('committee_id', 2)
            ->latest()
            ->paginate(6);

        return Inertia::render('DRRM/Index', [
            'committeeDocuments' => $committeeDocuments,
            'members' => $members,
            'documentTypes' => $documentTypes,
        ]);
    }
}
