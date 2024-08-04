<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;

class EducationController extends Controller
{
    public function index(){
        return Inertia::render('Education/Index');
    }
}
