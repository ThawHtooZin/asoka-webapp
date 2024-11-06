<?php

namespace App\Http\Controllers;

use App\Models\Chapter;
use App\Models\Course;
use App\Models\Video;
use Illuminate\Http\Request;

class DashboardVideoController extends Controller
{
    public function index()
    {
        $videos = Video::get();
        $courses = Course::get();
        $chapters = Chapter::get();
        return view('dashboard.video', compact('videos', 'courses', 'chapters'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'course_id' => 'required',
        ]);

        // Create the Chapter
        Chapter::create($data);

        session()->flash('success', 'Chapter created successfully!');
        return redirect('/dashboard/courses/chapter');
    }



    public function update(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'course_id' => 'required',
        ]);

        // Retrieve the article to be updated
        $chapter = Chapter::find($request->id);

        if ($chapter) {
            $dataToUpdate = $request->only(['title', 'description', 'course_id']);
            // Update the Chapter
            $chapter->update($dataToUpdate);

            session()->flash('success', 'Chapter updated successfully!');
            return redirect('/dashboard/courses/chapters');
        }

        session()->flash('error', 'Categories not found');
        return redirect('/dashboard/courses/categories');
    }

    public function destroy(Request $request)
    {
        $article = Chapter::find($request->id);
        if ($article) {
            $article->delete();
            return redirect()->back()->with('success', 'Chapter deleted successfully!');
        }
        return redirect()->back()->with('error', 'Chapter not found');
    }
}
