<?php

namespace App\Http\Controllers;

use App\Models\Forum;
use App\Models\ForumView;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ForumController extends Controller
{
    public function index(Request $request)
    {
        if (!empty($request->about)) {
            $forums = Forum::where('title', 'like', '%' . $request->about . '%')
                ->orWhere('content', 'like', '%' . $request->about . '%')
                ->withCount('views') // Count related ForumView entries
                ->get();
        } else {
            $forums = Forum::withCount('views')->orderByDesc('created_at')->get(); // Include view counts
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

        // Check if the user is authenticated
        if (Auth::check()) {
            $viewerId = Auth::user()->id;

            // Check if this user already has a view record for this forum
            $InsideviewerId = ForumView::where('user_id', $viewerId)->where('forum_id', $id)->first();

            if (!$InsideviewerId) {
                // If not, create a new view record
                ForumView::create([
                    'user_id' => $viewerId,
                    'forum_id' => $id,
                ]);
            }
        }

        return view('forum.show', compact('forum'));
    }


    public function edit()
    {
        return view('forum.edit');
    }

    public function update(Request $request, Forum $forum)
    {
        // Validate the incoming request
        $request->validate([
            'title' => 'required|string|max:255', // Example field
            'content' => 'required|string',  // Example field
        ]);

        // Update the forum details
        $forum->update([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
        ]);

        // Redirect or return a success message
        return redirect()->route('forum.show', $forum->id)->with('success', 'Forum updated successfully.');
    }

    public function destroy($forumId)
    {
        // Find the forum by its ID
        $forum = Forum::find($forumId);

        // Check if the forum exists
        if ($forum) {
            // Delete the forum
            $forum->delete();

            // Redirect with a success message
            return redirect()->route('forum.index')->with('success', 'Forum deleted successfully.');
        }

        // If the forum doesn't exist, return an error message
        return redirect()->route('forum.index')->with('error', 'Forum not found.');
    }
}
