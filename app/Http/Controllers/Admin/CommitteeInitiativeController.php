<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use App\Models\Committee;
use Illuminate\Http\Request;
use App\Models\CommitteeInitiative;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreCommitteeInitiativeRequest;
use App\Http\Requests\UpdateCommitteeInitiativeRequest;

class CommitteeInitiativeController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $committees = Committee::all();

        $initiatives = CommitteeInitiative::with('committee')->when($search, function ($query, $search) {
                        return $query->where('title', 'like', '%' . $search . '%');
                    })
                    ->latest()
                    ->paginate(5);

        return Inertia::render('Admin/CommitteeInitiatives/Index', [
            'initiatives' => $initiatives,
            'committees' => $committees,
            'filters' => $request->only(['search'])
        ]);
    }

    public function store(StoreCommitteeInitiativeRequest $request)
    {
        $validatedData = $request->validated();

        $path = $request->file('initiative_photo') ? $request->file('initiative_photo')->store('initiative_photos', 'public') : null;
        $validatedData['initiative_photo_path'] = $path;
        
        $request->user()->committeeInitiative()->create($validatedData);

        return redirect()->back();
    }

    public function update(UpdateCommitteeInitiativeRequest $request, CommitteeInitiative $initiative)
    {
        $validatedData = $request->validated();

        if ($request->hasFile('initiative_photo')) {
            // Delete the old news photo if it exists
            if ($initiative->initiative_photo_path) {
                Storage::disk('public')->delete($initiative->initiative_photo_path);
            }
            $path = $request->file('initiative_photo')->store('initiative_photos', 'public');
            $validatedData['initiative_photo_path'] = $path;
        }

        $initiative->update($validatedData);

        return redirect()->back();
    }

    public function destroy(CommitteeInitiative $initiative)
    {
        if ($initiative->initiative_photo_path) {
            Storage::disk('public')->delete($initiative->initiative_photo_path);
        }
        $initiative->delete();

        return redirect()->back();
    }
}
