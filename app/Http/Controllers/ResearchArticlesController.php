<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ResearchArticlesController extends Controller
{
    public function index()
    {
        $researcharticles = Article::get();
        return view('researcharticle.index', compact('researcharticles'));
    }

    public function show($id)
    {
        $researcharticle = Article::findOrFail($id, 'id');
        return view('researcharticle.show', compact('researcharticle'));
    }
}
