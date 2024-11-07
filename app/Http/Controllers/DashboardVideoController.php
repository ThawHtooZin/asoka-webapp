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
        $chapters = Chapter::get();
        $courses = Course::get();
        return view('dashboard.video', compact('videos', 'chapters', 'courses'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
            'course_id' => 'required',
            'chapter_id' => 'required',
            'video' => 'required',
            'description' => 'required',
        ]);

        $dataToUpdate = $request->only(['title', 'description', 'course_id', 'chapter_id']);
        $dataToUpdate['video_url'] = $data['video'];

        Video::create($dataToUpdate);

        session()->flash('success', 'Video created successfully!');
        return redirect('/dashboard/courses/videos');
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
            'course_id' => 'required',
            'chapter_id' => 'required',
            'video' => 'required',
            'description' => 'required',
        ]);


        // Retrieve the article to be updated
        $video = Video::find($request->id);

        if ($video) {
            $dataToUpdate = $request->only(['title', 'description', 'course_id', 'chapter_id']);
            $dataToUpdate['video_url'] = $data['video'];
            // Update the Chapter
            $video->update($dataToUpdate);

            session()->flash('success', 'Video updated successfully!');
            return redirect('/dashboard/courses/videos');
        }

        session()->flash('error', 'Videos not found');
        return redirect('/dashboard/courses/videos');
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
