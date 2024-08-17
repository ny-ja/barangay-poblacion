<?php

namespace App\Http\Controllers;

use App\Models\BarangayOfficial;
use Inertia\Inertia;

class AboutUsController extends Controller
{
    public function index()
    {
        $officials = BarangayOfficial::all();

        return Inertia::render('About/Index', [
            'officials' => $officials,
        ]);
    }
}
