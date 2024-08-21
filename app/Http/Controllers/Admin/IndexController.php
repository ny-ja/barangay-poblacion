<?php

namespace App\Http\Controllers\Admin;

use App\Models\News;
use App\Models\User;
use Inertia\Inertia;
use App\Models\Document;
use App\Http\Controllers\Controller;
use App\Models\BarangayOfficial;
use App\Models\Committee;
use App\Models\CommitteeDocument;
use App\Models\CommitteeInitiative;
use App\Models\CommitteeMember;
use App\Models\Feedback;
use App\Models\Subscriber;

class IndexController extends Controller
{
    public function index(){
        $users = User::all();
        $news = News::all();
        $documents = Document::all();
        $officials = BarangayOfficial::all();
        $committees = Committee::all();
        $members = CommitteeMember::all();
        $committeeDocuments = CommitteeDocument::all();
        $initiatives = CommitteeInitiative::all();
        $subscribers = Subscriber::all();
        $feedback = Feedback::all();
    
        return Inertia::render('Admin/Index', [
            'users' => $users,
            'news' => $news,
            'documents' => $documents,
            'officials' => $officials,
            'committees' => $committees,
            'members' => $members,
            'committeeDocuments' => $committeeDocuments,
            'initiatives' => $initiatives,
            'subscribers' => $subscribers,
            'feedback' => $feedback,
        ]);
    }
}
