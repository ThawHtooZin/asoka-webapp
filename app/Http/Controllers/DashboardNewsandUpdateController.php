<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\NewsandUpdate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DashboardNewsandUpdateController extends Controller
{
    public function index()
    {
        $newsandupdates = NewsandUpdate::get();
        return view('dashboard.newsandupdate', compact('newsandupdates'));
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
            $imagePath = $request->file('image')->store('images/newsandupdate', 'public');
            $data['image'] = '/' . $imagePath; // Store the path in database format
        }

        // Create the News and Update
        NewsandUpdate::create($data);

        session()->flash('success', 'News and Update created successfully!');
        return redirect('/dashboard/newsandupdates');
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

        // Find the newsandupdate to be updated
        $newsandupdate = NewsandUpdate::find($id);

        if ($newsandupdate) {
            // Handle the image upload if a new file is provided
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('images/newsandupdate', 'public');
                $data['image'] = '/' . $imagePath;

                // Optionally delete the old image if you don't want to keep it
                if ($newsandupdate->image) {
                    Storage::disk('public')->delete($newsandupdate->image);
                }
            } else {
                // Keep the existing image if no new image is uploaded
                $data['image'] = $newsandupdate->image;
            }

            // Update the newsandupdate with the new data
            $newsandupdate->update($data);

            // Flash success message and redirect
            session()->flash('success', 'News and Update updated successfully!');
            return redirect('/dashboard/newsandupdates');
        }

        // Flash error message if news and update not found
        session()->flash('error', 'News and Update not found');
        return redirect('/dashboard/newsandupdates');
    }


    public function destroy(Request $request)
    {
        $newsandupdate = NewsandUpdate::find($request->id);
        if ($newsandupdate) {
            $newsandupdate->delete();
            return redirect()->back()->with('success', 'News and Update deleted successfully!');
        }
        return redirect()->back()->with('error', 'News and Update not found');
    }
}
