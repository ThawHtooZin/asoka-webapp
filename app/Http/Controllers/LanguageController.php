<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    public function en()
    {
        // Set the application locale to English
        App::setLocale('en');
        // Store the locale in session for future requests
        Session::put('locale', 'en');

        return redirect()->back(); // Redirect back to the previous page
    }

    public function mm()
    {
        // Set the application locale to Burmese
        App::setLocale('mm');
        // Store the locale in session for future requests
        Session::put('locale', 'mm');

        return redirect()->back(); // Redirect back to the previous page
    }
}
