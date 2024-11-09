<?php

namespace App\Http\Controllers;

use App\Models\CoursePurchase;
use Illuminate\Http\Request;

class DashboardRequestController extends Controller
{
    public function index()
    {
        $requests = CoursePurchase::where('status', '=', 'requested')->get();
        return view('dashboard.request', compact('requests'));
    }

    public function confirm($id)
    {
        $course = CoursePurchase::findOrFail($id);

        $course->update([
            'status' => 'confirmed',
        ]);

        return redirect('/dashboard/courses/request')->with('success', 'Confirmed A Request!');
    }
}
