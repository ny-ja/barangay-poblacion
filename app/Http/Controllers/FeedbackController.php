<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;
use App\Http\Requests\StoreFeedbackRequest;

class FeedbackController extends Controller
{
    public function store(StoreFeedbackRequest $request)
    {
        Feedback::create([
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
        ]);

        return redirect()->back();
    }
}
