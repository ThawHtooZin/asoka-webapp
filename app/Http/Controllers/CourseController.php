<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Chapter;
use App\Models\Course;
use App\Models\CourseCategory;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index(Request $request)
    {
        $query = Course::query();

        if ($request->has('search')) {
            $search = $request->input('search');

            // Filter courses by name or description based on search term
            $query->where('name', 'LIKE', '%' . $search . '%');
        }

        $courses = $query->get();
        $categories = CourseCategory::all(); // Assuming categories are displayed as well

        return view('courses.index', compact('courses', 'categories'));
    }

    public function show($id)
    {
        $course = Course::find($id);
        $chapters = Chapter::where('course_id', $id)->get();
        return view('courses.show', compact('course', 'chapters'));
    }
}
