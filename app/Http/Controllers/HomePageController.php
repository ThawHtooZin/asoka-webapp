<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class HomePageController extends Controller
{
    public function index()
    {
        $courses = Course::orderBy('created_at', 'desc')->take(6)->get();
        $totalCourses = $courses->count();
        return view('index', compact('courses', 'totalCourses'));
    }
}
