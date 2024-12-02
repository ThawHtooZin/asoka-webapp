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
    public function drsawhtutsandar()
    {
        return view('aboutus.drsawhtutsandar');
    }

    public function vencandavara()
    {
        return view('aboutus.vencandavara');
    }
    public function uzinlinoo()
    {
        return view('aboutus.uzinlinoo');
    }
    public function venacara()
    {
        return view('aboutus.venacara');
    }
    public function venvicitta()
    {
        return view('aboutus.venvicitta');
    }

    public function esteemedlecturervencandavara()
    {
        return view('aboutus.vencandavara');
    }
    public function esteemedlecturervenacara()
    {
        return view('aboutus.venacara');
    }
    public function esteemedlecturervenvicitta()
    {
        return view('aboutus.venvicitta');
    }
}
