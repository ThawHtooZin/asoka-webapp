<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Course;
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
        $categories = Category::all(); // Assuming categories are displayed as well

        return view('courses.index', compact('courses', 'categories'));
    }

    public function show($id)
    {
        $course = Course::findOrFail($id); // Retrieve course by ID
        return view('courses.show', compact('course'));
    }
}
