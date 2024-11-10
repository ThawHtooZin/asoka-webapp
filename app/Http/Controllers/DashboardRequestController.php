<?php

namespace App\Http\Controllers;

use App\Models\BookPurchase;
use App\Models\CoursePurchase;
use Illuminate\Http\Request;

class DashboardRequestController extends Controller
{
    public function courseindex()
    {
        $requests = CoursePurchase::where('status', '=', 'requested')->get();
        return view('dashboard.courserequest', compact('requests'));
    }

    public function courseconfirm($id)
    {
        $course = CoursePurchase::findOrFail($id);

        $course->update([
            'status' => 'confirmed',
        ]);

        return redirect('/dashboard/courses/request')->with('success', 'Confirmed A Request!');
    }

    public function bookindex()
    {
        $requests = BookPurchase::where('status', '=', 'requested')->get();
        return view('dashboard.bookrequest', compact('requests'));
    }

    public function bookconfirm($id)
    {
        $course = BookPurchase::findOrFail($id);

        $course->update([
            'status' => 'confirmed',
        ]);

        return redirect('/dashboard/books/request')->with('success', 'Confirmed A Request!');
    }
}
