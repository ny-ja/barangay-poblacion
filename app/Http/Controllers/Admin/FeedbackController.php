<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use App\Models\Feedback;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FeedbackController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $feedback = Feedback::when($search, function ($query, $search) {
                return $query->where('name', 'like', '%' . $search . '%');
            })
            ->latest()
            ->paginate(10);

        return Inertia::render('Admin/Feedback/Index', [
            'feedback' => $feedback,
            'filters' => $request->only(['search'])
        ]);
    }

    public function destroy(Feedback $feedback)
    {
        $feedback->delete();

        return redirect()->back();
    }
}
