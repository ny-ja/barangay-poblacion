<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;

class PeaceAndOrderController extends Controller
{
    public function index(){
        return Inertia::render('PeaceAndOrder/Index');
    }
}
