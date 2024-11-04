<?php

namespace App\Http\Controllers;

use App\Models\Chapter;
use App\Models\Course;
use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function chaptershow($course_id, $chapter_id)
    {
        $course = Course::findOrFail($course_id);
        $chapters = $this->getChapters($course_id);

        // Get the first video in the chapter to show by default
        $chapter = Chapter::with('videos')->findOrFail($chapter_id);
        $video = $chapter->videos->first();  // Default to the first video

        if (!$video) {
            abort(404, 'No videos available for this chapter.');
        }

        return view('courses.video.index', compact('video', 'chapters', 'course'));
    }


    public function videoshow($id, $chapter_id, $video_id)
    {
        $course = Course::findOrFail($id);
        $chapters = $this->getChapters($id);
        $video = $this->getVideo($id, $chapter_id, $video_id);

        if (!$video) {
            abort(404);
        }

        // Finding the next video
        $currentChapter = $chapters->where('id', $chapter_id)->first();
        $currentVideoIndex = $currentChapter->videos->pluck('id')->search($video_id);

        // Determine the next video within the chapter
        if ($currentVideoIndex !== false && $currentVideoIndex + 1 < $currentChapter->videos->count()) {
            $nextVideo = $currentChapter->videos[$currentVideoIndex + 1];
            $nextVideoUrl = route('videoshow', ['course' => $id, 'chapter' => $chapter_id, 'video' => $nextVideo->id]);
        } else {
            // If no more videos in the chapter, move to the next chapter
            $nextChapter = $chapters->where('id', '>', $chapter_id)->first();

            if ($nextChapter && $nextChapter->videos->isNotEmpty()) {
                $nextVideo = $nextChapter->videos->first();
                $nextVideoUrl = route('videoshow', ['course' => $id, 'chapter' => $nextChapter->id, 'video' => $nextVideo->id]);
            } else {
                $nextVideoUrl = null; // No more videos available
            }
        }

        // Finding the previous video
        if ($currentVideoIndex > 0) {
            $previousVideo = $currentChapter->videos[$currentVideoIndex - 1];
            $previousVideoUrl = route('videoshow', ['course' => $id, 'chapter' => $chapter_id, 'video' => $previousVideo->id]);
        } else {
            // If at the first video in the chapter, go to the previous chapter
            $previousChapter = $chapters->where('id', '<', $chapter_id)->last();

            if ($previousChapter && $previousChapter->videos->isNotEmpty()) {
                $previousVideo = $previousChapter->videos->last();
                $previousVideoUrl = route('videoshow', ['course' => $id, 'chapter' => $previousChapter->id, 'video' => $previousVideo->id]);
            } else {
                $previousVideoUrl = null; // No previous videos available
            }
        }

        return view('courses.video.index', compact('video', 'chapters', 'course', 'nextVideoUrl', 'previousVideoUrl'));
    }

    // Helper method to get chapters for a course
    private function getChapters($course_id)
    {
        return Chapter::where('course_id', $course_id)->get();
    }

    // Helper method to get a video by chapter within a course
    private function getVideoByChapter($course_id, $chapter_id)
    {
        return Video::where('chapter_id', $chapter_id)
            ->whereHas('chapter', fn($query) => $query->where('course_id', $course_id))
            ->first();
    }

    // Helper method to get a specific video in a chapter within a course
    private function getVideo($course_id, $chapter_id, $video_id)
    {
        return Video::where('id', $video_id)
            ->where('chapter_id', $chapter_id)
            ->whereHas('chapter', fn($query) => $query->where('course_id', $course_id))
            ->first();
    }
}