<?php

namespace App\Http\Controllers;

use App\Models\Chapter;
use App\Models\Course;
use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function chaptershow($id, $chapter_id)
    {
        $course = Course::findOrFail($id)->first();
        $video = Video::where('chapter_id', $chapter_id)->first();
        $chapters = Chapter::get();
        if (!$video) {
            abort(404);
        }
        return view('courses.video.index', compact('video', 'chapters', 'course'));
    }

    public function videoshow($id, $chapter_id, $video_id)
    {
        $course = Course::findOrFail($id)->first();
        $video = Video::where('id', $video_id)->first();
        $chapters = Chapter::get();
        if (!$video) {
            abort(404);
        }
        return view('courses.video.index', compact('video', 'chapters', 'course'));
    }
}
