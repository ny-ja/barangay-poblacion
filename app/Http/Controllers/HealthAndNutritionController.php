<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;

class HealthAndNutritionController extends Controller
{
    public function index(){
        return Inertia::render('HealthAndNutrition/Index');
    }
}
