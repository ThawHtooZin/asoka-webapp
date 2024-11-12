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

            $query->where('name', 'LIKE', '%' . $search . '%');
        }
        $courses = $query->get();

        // Get category IDs from the filtered courses
        $categoryIds = $courses->pluck('course_category_id')->unique();

        // Get only categories that are related to the filtered courses
        $categories = CourseCategory::whereIn('id', $categoryIds)->get();

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
            'payment_image' => 'required|image|mimes:jpg,jpeg,png|max:2048', // Add validation for image format and size
        ]);

        if ($request->hasFile('payment_image')) {
            // Store the file in the 'images/payments' directory in the public disk
            $imagePath = $request->file('payment_image')->store('images/payments', 'public');
            $data['payment_image'] = '/' . $imagePath; // Store the path in database format
        }

        $user_id = Auth::user()->id;

        $data['user_id'] = $user_id;
        $data['course_id'] = $id;
        $data['status'] = 'requested';
        CoursePurchase::create($data);

        return redirect('/courses/' . $id . '/show')->with('success', 'Course Requested Successfully!');
    }
}
