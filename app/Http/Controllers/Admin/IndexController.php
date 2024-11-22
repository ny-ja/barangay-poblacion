<?php

namespace App\Http\Controllers\Admin;

use App\Models\News;
use Inertia\Inertia;
use App\Http\Controllers\Controller;
use App\Models\CommitteeInitiative;
use App\Models\Feedback;
use App\Models\Subscriber;

class IndexController extends Controller
{
    public function index(){
        $news = News::all();
        $initiatives = CommitteeInitiative::all();
        $subscribers = Subscriber::all();
        $feedback = Feedback::all();

        return Inertia::render('Admin/Index', [
            'news' => $news,
            'initiatives' => $initiatives,
            'subscribers' => $subscribers,
            'feedback' => $feedback,
        ]);
    }
}
