<?php

use Illuminate\Support\Facades\Route;

/*
Route::get() — handles a GET request (the type browsers make by default).
'/' — the URL path (home page).
The function() — what to run when someone visits that URL.
*/
Route::get('/', function () {
    return 'Welcome to RouteMaster Blog';
});

//Laravel automatically detects the response type and sets the headers
//plain text response
Route::get('/hello', function () {
    return 'Hello, Laravel Routing!';
});

//auto-converted to json by laravel
Route::get('/array', function () {
    return ['framework' => 'Laravel', 'version' => app()->version()];
});

//explicitly returned json
Route::get('/json', function () {
    return response()->json([
        'status' => 'success',
        'message' => 'This is a json snippet'
    ]);
});

//Make a simple blade view and return it via route
Route::get('/home', function () {
    return view('welcome');
});

/*
Create a route /about that returns a short HTML string like
"This is RouteMaster Blog, built with Laravel 12."
*/
Route::get('/about', function () {
    return "This is RouteMaster Blog, built with Laravel 12.";
});

//Create a route /info that returns an array:
Route::get('/info', function () {
    return ["app" => "RouteMaster Blog", "developer" => "Your Name"];
});

Route::get('/page', function () {
    return view('page');
});
