<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        return "Listing all posts";
    }

    public function show(Post $post) //model binding
    {
        return "Viewing post #{$post->title}"; //laravel automatically fetches the Post with the given Id
    }

    public function create()
    {
        return "Create post form";
    }

    public function store(Request $request)
    {
        return "Storing post...";
    }
}
