<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        return "Listing all posts";
    }

    public function show($id)
    {
        return "Showing post #{$id}";
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
