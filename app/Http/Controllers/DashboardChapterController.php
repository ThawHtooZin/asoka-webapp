<?php

namespace App\Http\Controllers;

use App\Models\Chapter;
use App\Models\Course;
use Illuminate\Http\Request;

class DashboardChapterController extends Controller
{
    public function index()
    {
        $chapters = Chapter::get();
        $courses = Course::get();
        return view('dashboard.chapter', compact('chapters', 'courses'));
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
        return redirect('/dashboard/courses/chapters');
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

        session()->flash('error', 'Chapter not found');
        return redirect('/dashboard/courses/chapters');
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
