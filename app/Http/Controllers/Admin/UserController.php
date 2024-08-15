<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UpdateUserRequest;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $users = User::whereNot('email', 'admin@admin.admin')
            ->when($search, function ($query, $search) {
                return $query->where('name', 'like', '%' . $search . '%');
            })
            ->latest()
            ->paginate(5);

        return Inertia::render('Admin/Users/Index', [
            'users' => $users,
            'filters' => $request->only(['search'])
        ]);
    }

    public function store(StoreUserRequest $request)
    {
        $path = $request->file('profile_photo') ? $request->file('profile_photo')->store('profile_photos', 'public') : null;

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'profile_photo_path' => $path,
        ]);

        return redirect()->back();
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $validatedData = $request->validated();

        if ($request->hasFile('profile_photo')) {
            // Delete the old profile photo if it exists
            if ($user->profile_photo_path) {
                Storage::disk('public')->delete($user->profile_photo_path);
            }
            $path = $request->file('profile_photo')->store('profile_photos', 'public');
            $validatedData['profile_photo_path'] = $path;
        }

        // Only include the password in the update if it's provided and not empty
        if (!empty($request->password)) {
            $validatedData['password'] = bcrypt($request->password);
        } else {
            // Remove the password field from the validated data to avoid updating it with a null value
            unset($validatedData['password']);
        }

        $user->update($validatedData);

        return redirect()->back();
    }

    public function destroy(User $user)
    {
        if ($user->profile_photo_path) {
            Storage::disk('public')->delete($user->profile_photo_path);
        }
        $user->delete();

        return redirect()->back();
    }
}
