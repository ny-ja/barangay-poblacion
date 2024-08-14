<?php

namespace App\Http\Controllers\Admin;

use App\Models\News;
use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function index(){
        $users = User::all();
        $totalUsers = $users->count()-1;
        $news = News::all();
        $totalNews = $news->count();
    
        return Inertia::render('Admin/Index', [
            'users' => $users,
            'totalUsers' => $totalUsers,
            'news' => $news,
            'totalNews' => $totalNews
        ]);
    }
}
