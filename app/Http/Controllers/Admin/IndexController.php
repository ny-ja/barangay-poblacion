<?php

namespace App\Http\Controllers\Admin;

use App\Models\News;
use App\Models\User;
use Inertia\Inertia;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function index(){
        $users = User::all();
        $news = News::all();
    
        return Inertia::render('Admin/Index', [
            'users' => $users,
            'news' => $news,
        ]);
    }
}
