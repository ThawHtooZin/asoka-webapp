<?php

namespace App\Http\Controllers;

use App\Models\Forum;
use Illuminate\Http\Request;

class ForumController extends Controller
{
    public function index()
    {
        $forums = Forum::get();
        return view('forum.index', compact('forums'));
    }

    public function create()
    {
        return view('forum.create');
    }

    public function store() {}

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
