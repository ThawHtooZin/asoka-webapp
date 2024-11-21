<?php

namespace App\Http\Controllers;

use App\Models\Forum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ForumController extends Controller
{
    public function index(Request $request)
    {
        if (!empty($request->about)) {
            $forums = Forum::where('title', 'like', '%' . $request->about . '%')
                ->orWhere('content', 'like', '%' . $request->about . '%')
                ->get();
        } else {
            $forums = Forum::get();
        }

        return view('forum.index', compact('forums'));
    }

    public function create()
    {
        return view('forum.create');
    }

    public function store(Request $request)
    {
        // Validate the input data
        $validatedData = $request->validate([
            'title' => 'required|string|min:5|max:200',
            'content' => 'required|string|min:10',
        ]);

        $validatedData['user_id'] = Auth::user()->id;

        // Save the data to the database
        Forum::create($validatedData);

        // Redirect to the forum index with a success message
        return redirect()->route('forum.index')->with('success', 'Forum created successfully!');
    }

    public function show($id)
    {
        $forum = Forum::with(['comments.replies.user', 'comments.user'])->findOrFail($id);
        return view('forum.show', compact('forum'));
    }

    public function edit()
    {
        return view('forum.edit');
    }

    public function update() {}

    public function destory() {}
}
