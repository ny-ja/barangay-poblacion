<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class AgricultureController extends Controller
{
    public function index(){
        return Inertia::render('Agriculture/Index');
    }
}
