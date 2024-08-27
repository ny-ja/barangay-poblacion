<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use App\Models\Committee;
use App\Models\DocumentType;
use Illuminate\Http\Request;
use App\Models\CommitteeDocument;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreCommitteeDocumentRequest;
use App\Http\Requests\UpdateCommitteeDocumentRequest;

class CommitteeDocumentController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $committees = Committee::all();
        $documentTypes = DocumentType::all();

        $committeeDocuments = CommitteeDocument::with('committee', 'documentType')
                    ->when($search, function ($query, $search) {
                        return $query->where('name', 'like', '%' . $search . '%');
                    })
                    ->latest()
                    ->paginate(5);

        return Inertia::render('Admin/CommitteeDocuments/Index', [
            'committeeDocuments' => $committeeDocuments,
            'committees' => $committees,
            'documentTypes' => $documentTypes,
            'filters' => $request->only(['search'])
        ]);
    }

    public function store(StoreCommitteeDocumentRequest $request)
    {
        $validatedData = $request->validated();

        $path = $request->file('committee_file') ? $request->file('committee_file')->store('committee_files', 'public') : null;
        $validatedData['file_path'] = $path;

        $bg_path = $request->file('background_image') ? $request->file('background_image')->store('background_images', 'public') : null;
        $validatedData['background_image_path'] = $bg_path;
        
        $request->user()->committeeDocument()->create($validatedData);

        return redirect()->back();
    }

    public function update(UpdateCommitteeDocumentRequest $request, CommitteeDocument $committeeDocument)
    {
        $validatedData = $request->validated();

        if ($request->hasFile('committee_file')) {
            // Delete the old file if it exists
            if ($committeeDocument->file_path) {
                Storage::disk('public')->delete($committeeDocument->file_path);
            }
            $path = $request->file('committee_file')->store('committee_files', 'public');
            $validatedData['file_path'] = $path;
        }

        if ($request->hasFile('background_image')) {
            // Delete the old file if it exists
            if ($committeeDocument->background_image_path) {
                Storage::disk('public')->delete($committeeDocument->background_image_path);
            }
            $bg_path = $request->file('background_image')->store('background_images', 'public');
            $validatedData['background_image_path'] = $bg_path;
        }

        $committeeDocument->update($validatedData);

        return redirect()->back();
    }

    public function destroy(CommitteeDocument $committeeDocument)
    {
        if ($committeeDocument->file_path) {
            Storage::disk('public')->delete($committeeDocument->file_path);
        }

        if ($committeeDocument->background_image_path) {
            Storage::disk('public')->delete($committeeDocument->background_image_path);
        }

        $committeeDocument->delete();

        return redirect()->back();
    }
}
