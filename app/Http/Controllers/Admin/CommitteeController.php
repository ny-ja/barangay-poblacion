<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use App\Models\Committee;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreCommitteeRequest;
use App\Http\Requests\UpdateCommitteeRequest;

class CommitteeController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $committees = Committee::when($search, function ($query, $search) {
                        return $query->where('name', 'like', '%' . $search . '%');
                    })
                    ->latest()
                    ->paginate(5);

        return Inertia::render('Admin/Committees/Index', [
            'committees' => $committees,
            'filters' => $request->only(['search'])
        ]);
    }

    public function store(StoreCommitteeRequest $request)
    {
        $validatedData = $request->validated();

        $path = $request->file('committee_profile_photo') ? $request->file('committee_profile_photo')->store('committee_profile_photos', 'public') : null;
        $validatedData['committee_profile_photo_path'] = $path;
        
        $request->user()->committee()->create($validatedData);

        return redirect()->back();
    }

    public function update(UpdateCommitteeRequest $request, Committee $committee)
    {
        $validatedData = $request->validated();

        if ($request->hasFile('committee_profile_photo')) {
            // Delete the old news photo if it exists
            if ($committee->committee_profile_photo_path) {
                Storage::disk('public')->delete($committee->committee_profile_photo_path);
            }
            $path = $request->file('committee_profile_photo')->store('committee_profile_photos', 'public');
            $validatedData['committee_profile_photo_path'] = $path;
        }

        $committee->update($validatedData);

        return redirect()->back();
    }

    public function destroy(Committee $committee)
    {
        if ($committee->committee_profile_photo_path) {
            Storage::disk('public')->delete($committee->committee_profile_photo_path);
        }
        $committee->delete();

        return redirect()->back();
    }
}
