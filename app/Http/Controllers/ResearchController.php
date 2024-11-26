<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ResearchController extends Controller
{
    public function index()
    {
        return view('research.index');
    }
}
