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
        // Start building the course query
        $query = Course::query();

        // Filter by search term if provided
        if ($request->filled('search')) {
            $searchTerm = $request->input('search');
            $query->where('name', 'LIKE', '%' . $searchTerm . '%');
        }

        // Filter by category if provided
        if ($request->filled('category')) {
            $categoryId = $request->input('category');
            $query->where('course_category_id', $categoryId);
        }

        // Execute the query to get the courses
        $courses = $query->orderByDesc('created_at')->get();

        // Fetch only the categories that are used in the courses table
        $categories = CourseCategory::whereIn('id', Course::pluck('course_category_id'))->get();

        // Return the view with courses and categories
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
            'payment_image' => 'required|image|mimes:jpg,jpeg,png|max:2048', // Validation rules
        ], [
            'payment_image.max' => 'The payment image must not exceed 2MB.', // Custom error message
            'payment_image.required' => 'Please upload a payment image.',    // Other custom messages (optional)
            'payment_image.image' => 'The file must be an image.',
            'payment_image.mimes' => 'The payment image must be in JPG, JPEG, or PNG format.',
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
