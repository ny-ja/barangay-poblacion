<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Document;
use App\Models\DocumentType;
use App\Models\CommitteeMember;
use App\Models\CommitteeDocument;
use App\Models\CommitteeInitiative;

class HealthAndNutritionController extends Controller
{
    public function index()
    {
        $documentTypes = DocumentType::all();
        $members = CommitteeMember::with('committee')->get();

        $committeeDocuments = CommitteeDocument::with('committee', 'documentType')
            ->where('committee_id', 4)
            ->latest()
            ->paginate(6);

        $initiatives = CommitteeInitiative::with('committee')
        ->where('committee_id', 4)
        ->latest()
        ->paginate(6);

        return Inertia::render('HealthAndNutrition/Index', [
            'committeeDocuments' => $committeeDocuments,
            'initiatives' => $initiatives,
            'members' => $members,
            'documentTypes' => $documentTypes,
        ]);
    }
}
