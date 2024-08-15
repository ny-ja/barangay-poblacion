<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\BarangayOfficial;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreOfficialRequest;
use App\Http\Requests\UpdateOfficialRequest;

class BarangayOfficialController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $officials = BarangayOfficial::when($search, function ($query, $search) {
                        return $query->where('full_name', 'like', '%' . $search . '%');
                    })
                    ->latest()
                    ->paginate(5);

        return Inertia::render('Admin/BarangayOfficials/Index', [
            'officials' => $officials,
            'filters' => $request->only(['search'])
        ]);
    }

    public function store(StoreOfficialRequest $request)
    {
        $validatedData = $request->validated();

        $path = $request->file('official_photo') ? $request->file('official_photo')->store('official_photos', 'public') : null;
        $validatedData['photo_path'] = $path;
        
        $request->user()->barangayOfficial()->create($validatedData);

        return redirect()->back();
    }

    public function update(UpdateOfficialRequest $request, BarangayOfficial $official)
    {
        $validatedData = $request->validated();

        if ($request->hasFile('official_photo')) {
            // Delete the old news photo if it exists
            if ($official->photo_path) {
                Storage::disk('public')->delete($official->photo_path);
            }
            $path = $request->file('official_photo')->store('official_photos', 'public');
            $validatedData['photo_path'] = $path;
        }

        $official->update($validatedData);

        return redirect()->back();
    }

    public function destroy(BarangayOfficial $official)
    {
        if ($official->photo_path) {
            Storage::disk('public')->delete($official->photo_path);
        }
        $official->delete();

        return redirect()->back();
    }
}
