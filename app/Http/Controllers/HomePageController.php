<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\NewsandUpdate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class HomePageController extends Controller
{
    public function index()
    {
        $newsandupdates = NewsandUpdate::orderBy('created_at', 'desc')->take(3)->get();
        return view('index', compact('newsandupdates'));
    }
}
