<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Document;
use App\Models\DocumentType;
use App\Models\CommitteeMember;
use App\Models\CommitteeDocument;

class PeaceAndOrderController extends Controller
{
    public function index()
    {
        $documentTypes = DocumentType::all();
        $members = CommitteeMember::with('committee')->get();

        $committeeDocuments = CommitteeDocument::with('committee', 'documentType')
            ->where('committee_id', 5)
            ->latest()
            ->paginate(6);

        return Inertia::render('PeaceAndOrder/Index', [
            'committeeDocuments' => $committeeDocuments,
            'members' => $members,
            'documentTypes' => $documentTypes,
        ]);
    }
}
