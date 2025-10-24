<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class PostController extends Controller
{
    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request): RedirectResponse
    {
        // For now, just validate and dump data
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'body'  => 'required|string',
        ]);

        // Later: save to DB
        // Post::create($validated);

        return redirect()->route('posts.create')->with('success', 'Post submitted!');
    }
}
