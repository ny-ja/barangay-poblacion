<?php

namespace App\Http\Controllers;

use App\Models\Subscriber;
use Illuminate\Http\Request;
use App\Http\Requests\StoreSubscriberRequest;

class SubscriberController extends Controller
{
    public function store(StoreSubscriberRequest $request)
    {
        Subscriber::create([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return redirect()->back();
    }
}
