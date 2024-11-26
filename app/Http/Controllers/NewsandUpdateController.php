<?php

namespace App\Http\Controllers;

use App\Models\NewsandUpdate;
use Illuminate\Http\Request;

class NewsandUpdateController extends Controller
{
    public function index()
    {
        $newsandupdates = NewsandUpdate::orderByDesc('created_at')->get();
        return view('newsandupdates.index', compact('newsandupdates'));
    }

    public function show(Request $request)
    {
        $newsandupdate = NewsandUpdate::findOrFail($request->id);

        return view('newsandupdates.show', compact('newsandupdate'));
    }
}
