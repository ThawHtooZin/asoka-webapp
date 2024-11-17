<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    public function index()
    {
        $announcements = Announcement::orderByDesc('created_at')->get();
        return view('announcement.index', compact('announcements'));
    }

    public function show(Request $request)
    {
        $announcement = Announcement::findOrFail($request->id);

        return view('announcement.show', compact('announcement'));
    }
}
