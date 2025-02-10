<?php

namespace App\Http\Controllers;

use App\Mail\ContactEmail;
use App\Models\Plan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{

    public function index()
    {
        $plans = Plan::orderBy('name', 'asc')->get();
        return view('welcome', compact('plans'));
    }

    public function contactanos(Request $request)
    {

        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required',

        ]);

        Mail::to('info@gematechnology.tech')->send(new ContactEmail($data));
        return redirect()->back();
    }
}