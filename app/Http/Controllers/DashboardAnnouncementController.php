<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DashboardAnnouncementController extends Controller
{
    public function index()
    {
        $announcements = Announcement::get();
        return view('dashboard.announcement', compact('announcements'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
            'by' => 'required',
            'content' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:25000',
        ]);

        // Handle the image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images/announcement', 'public');
            $data['image'] = '/' . $imagePath; // Store the path in database format
        }

        // Create the Announcement
        Announcement::create($data);

        session()->flash('success', 'Announcement created successfully!');
        return redirect('/dashboard/announcements');
    }



    public function update(Request $request, $id)
    {
        // Validate the incoming request data
        $data = $request->validate([
            'title' => 'required',
            'by' => 'required',
            'content' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:25000',
        ]);

        // Find the announcement to be updated
        $announcement = Announcement::find($id);

        if ($announcement) {
            // Handle the image upload if a new file is provided
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('images/announcement', 'public');
                $data['image'] = '/' . $imagePath;

                // Optionally delete the old image if you don't want to keep it
                if ($announcement->image) {
                    Storage::disk('public')->delete($announcement->image);
                }
            } else {
                // Keep the existing image if no new image is uploaded
                $data['image'] = $announcement->image;
            }

            // Update the announcement with the new data
            $announcement->update($data);

            // Flash success message and redirect
            session()->flash('success', 'Announcement updated successfully!');
            return redirect('/dashboard/announcements');
        }

        // Flash error message if announcement not found
        session()->flash('error', 'Announcement not found');
        return redirect('/dashboard/announcements');
    }


    public function destroy(Request $request)
    {
        $announcement = Announcement::find($request->id);
        if ($announcement) {
            $announcement->delete();
            return redirect()->back()->with('success', 'Announcement deleted successfully!');
        }
        return redirect()->back()->with('error', 'Announcement not found');
    }
}
