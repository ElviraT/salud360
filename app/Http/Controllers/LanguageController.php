<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    public function setLocale(Request $request)
    {

        $locale = $request->input('locale');
        session()->put('locale', $locale);
        app()->setLocale($locale);
        putenv('APP_LOCALE=' . $locale);
        Artisan::call("config:cache");
        // dd($locale, getenv('APP_LOCALE'));

        return response()->json(['success' => true]);
    }
}