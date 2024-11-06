<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DashboardCourseController extends Controller
{
    public function index()
    {
        $courses = Course::get();
        $categories = CourseCategory::get();
        return view('dashboard.course', compact('courses', 'categories'));
    }

    public function store(Request $request)
    {
        // Validate the inputs
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|exists:course_categories,id',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Image validation
            'language' => 'required|string',
            'duration' => 'required|string',
            'price' => 'required|numeric',
            'status' => 'required|in:public,closed,waiting',
        ]);

        // Handle the image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images/courses', 'public');
            $data['image'] = '/' . $imagePath; // Store the path in database format
        }

        // Assign additional fields
        $data['user_id'] = Auth::id(); // Store the ID of the currently authenticated user
        $data['course_category_id'] = $data['category_id']; // Adjust for your database column
        unset($data['category_id']); // Remove the old key if not needed

        // Create the course with the validated data
        Course::create($data);

        // Flash success message and redirect
        session()->flash('success', 'Course created successfully!');
        return redirect('/dashboard/courses');
    }



    public function update(Request $request, $id)
    {
        // Find the course by ID
        $course = Course::findOrFail($id);

        // Validate the inputs
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|exists:course_categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Image validation (nullable)
            'language' => 'required|string',
            'duration' => 'required|string',
            'price' => 'required|numeric',
            'status' => 'required|in:public,closed,waiting',
        ]);

        // Handle the image upload if a new image is provided
        if ($request->hasFile('image')) {
            // Delete the old image if necessary
            if ($course->image) {
                Storage::disk('public')->delete(str_replace('/', '', $course->image)); // Delete the old image
            }

            // Store the new image
            $imagePath = $request->file('image')->store('images/courses', 'public');
            $data['image'] = '/' . $imagePath; // Store the path in database format
        } else {
            // If no new image is uploaded, retain the old one
            $data['image'] = $course->image;
        }

        // Assign additional fields
        $data['user_id'] = Auth::id(); // Store the ID of the currently authenticated user
        $data['course_category_id'] = $data['category_id']; // Adjust for your database column
        unset($data['category_id']); // Remove the old key if not needed

        // Update the course with the validated data
        $course->update($data);

        // Flash success message and redirect
        session()->flash('success', 'Course updated successfully!');
        return redirect('/dashboard/courses');
    }



    public function destroy(Request $request)
    {
        $course = Course::find($request->id);
        if ($course) {
            $course->delete();
            return redirect()->back()->with('success', 'Course deleted successfully!');
        }
        return redirect()->back()->with('error', 'Course not found');
    }
}
