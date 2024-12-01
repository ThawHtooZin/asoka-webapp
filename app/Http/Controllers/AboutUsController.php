<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutUsController extends Controller
{
    public function whoweare()
    {
        return view('aboutus.whoweare');
    }

    public function websiteteam()
    {
        return view('aboutus.websiteteam');
    }
    public function esteemedlecturer()
    {
        return view('aboutus.esteemedlecturer');
    }
}
