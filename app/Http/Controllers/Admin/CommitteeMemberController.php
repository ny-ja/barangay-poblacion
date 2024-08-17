<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use App\Models\Committee;
use Illuminate\Http\Request;
use App\Models\CommitteeMember;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreCommitteeMemberRequest;
use App\Http\Requests\UpdateCommitteeMemberRequest;

class CommitteeMemberController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $committees = Committee::all();

        $members = CommitteeMember::with('committee')->when($search, function ($query, $search) {
                        return $query->where('full_name', 'like', '%' . $search . '%');
                    })
                    ->latest()
                    ->paginate(5);

        return Inertia::render('Admin/CommitteeMembers/Index', [
            'members' => $members,
            'committees' => $committees,
            'filters' => $request->only(['search'])
        ]);
    }

    public function store(StoreCommitteeMemberRequest $request)
    {
        $validatedData = $request->validated();

        $path = $request->file('member_photo') ? $request->file('member_photo')->store('member_photos', 'public') : null;
        $validatedData['member_photo_path'] = $path;
        
        $request->user()->committeeMember()->create($validatedData);

        return redirect()->back();
    }

    public function update(UpdateCommitteeMemberRequest $request, CommitteeMember $member)
    {
        $validatedData = $request->validated();

        if ($request->hasFile('member_photo')) {
            // Delete the old news photo if it exists
            if ($member->member_photo_path) {
                Storage::disk('public')->delete($member->member_photo_path);
            }
            $path = $request->file('member_photo')->store('member_photos', 'public');
            $validatedData['member_photo_path'] = $path;
        }

        $member->update($validatedData);

        return redirect()->back();
    }

    public function destroy(CommitteeMember $member)
    {
        if ($member->member_photo_path) {
            Storage::disk('public')->delete($member->member_photo_path);
        }
        $member->delete();

        return redirect()->back();
    }
}
