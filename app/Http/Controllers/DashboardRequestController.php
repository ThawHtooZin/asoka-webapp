<?php

namespace App\Http\Controllers;

use App\Models\BookPurchase;
use App\Models\CoursePurchase;
use Illuminate\Http\Request;

class DashboardRequestController extends Controller
{
    public function courseindex()
    {
        $requests = CoursePurchase::get();
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

    public function courseachive($id)
    {
        $course = CoursePurchase::findOrFail($id);

        $course->update([
            'status' => 'achived',
        ]);

        return redirect('/dashboard/courses/request')->with('success', 'Achived A Request!');
    }

    public function bookindex()
    {
        $requests = BookPurchase::get();
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

    public function bookachive($id)
    {
        $course = BookPurchase::findOrFail($id);

        $course->update([
            'status' => 'achived',
        ]);

        return redirect('/dashboard/books/request')->with('success', 'Achived A Request!');
    }
}
