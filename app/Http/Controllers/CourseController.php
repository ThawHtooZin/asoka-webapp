<?php

namespace App\Http\Controllers;

use App\Models\Chapter;
use App\Models\Course;
use App\Models\CourseCategory;
use App\Models\CoursePurchase;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $video = Video::where('course_id', $id)->first();
        return view('courses.show', compact('course', 'chapters', 'video'));
    }

    public function buy($id)
    {
        $course = Course::findOrFail($id);
        return view('courses.buy', compact('course'));
    }

    public function purchase(Request $request, $id)
    {
        $data = $request->validate([
            'payment_image' => 'required',
        ]);

        if ($request->hasFile('payment_image')) {
            $imagePath = $request->file('image')->store('images/payments', 'public');
            $data['payment_image'] = '/' . $imagePath; // Store the path in database format
        }

        $user_id = Auth::user()->id;

        $data['user_id'] = $user_id;
        $data['course_id'] = $id;
        $data['status'] = 'requested';
        CoursePurchase::create($data);

        return redirect('/courses/' . $id . '/show')->with('success', 'Course Purchased Successfully!');
    }
}
