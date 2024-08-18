<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use App\Models\Subscriber;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SubsciberController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $subscribers = Subscriber::when($search, function ($query, $search) {
                return $query->where('name', 'like', '%' . $search . '%');
            })
            ->latest()
            ->paginate(10);

        return Inertia::render('Admin/Subscribers/Index', [
            'subscribers' => $subscribers,
            'filters' => $request->only(['search'])
        ]);
    }

    public function destroy(Subscriber $subscriber)
    {
        $subscriber->delete();

        return redirect()->back();
    }
}
