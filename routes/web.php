<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

// All the website pages, admin panel, dashboards belong here.
/*
Route::get() — handles a GET request (the type browsers make by default).
'/' — the URL path (home page).
The function() — what to run when someone visits that URL.
*/

Route::get('/', function () {
    return 'Welcome to RouteMaster Blog';
});

// Laravel automatically detects the response type and sets the headers
// plain text response
Route::get('/hello', function () {
    return 'Hello, Laravel Routing!';
});

// auto-converted to json by laravel
Route::get('/array', function () {
    return ['framework' => 'Laravel', 'version' => app()->version()];
});

// explicitly returned json
Route::get('/json', function () {
    return response()->json([
        'status' => 'success',
        'message' => 'This is a json snippet',
    ]);
});

// Make a simple blade view and return it via route
Route::get('/home', function () {
    return view('welcome');
});

/*
Create a route /about that returns a short HTML string like
"This is RouteMaster Blog, built with Laravel 12."
*/
Route::get('/about', function () {
    return 'This is RouteMaster Blog, built with Laravel 12.';
});

// Create a route /info that returns an array:
Route::get('/info', function () {
    return ['app' => 'RouteMaster Blog', 'developer' => 'Your Name'];
});

Route::get('/page', function () {
    return view('page');
});

Route::redirect('/home', '/page');
// Now when you visit /home laravel instantly redirects to /dashboard

// You can redirect and pass dynamic parameters
Route::get('/posts/{id}', function ($id) {
    return "Showing post with #{$id}";
});

Route::redirect('/show/{id}', '/posts/{id}');
// Now visiting /show/5 will redirect to posts/5 Laravel replaces {id} automatically in the destination url.

// redirect() helper can help you manually redirect from anywhere not just Route::redirect

Route::get('/start', function () {
    return redirect('/finish');
});

Route::get('/finish', function () {
    return 'You have been redirected';
});

// This helper returns a redirect response - same effect but more flexible inside controller and logic

// Create a route /start-here that redirects to /page (temporary).
Route::redirect('/start-here', '/page', 302);

// Create a route /go-home that redirects permanently to / (status 301).
// Permanent status is 301 and 302 is temporary
Route::get('/go-home', function () {
    return redirect('/', 301);
});

// Create a route /article/{slug} and another /read/{slug} that redirects to it dynamically.
Route::get('/article/{slug}', function ($slug) {
    return "Reading article: {$slug}";
});

Route::get('/read/{slug}', function ($slug) {
    return redirect("/article/{$slug}");
});

Route::view('/about-us', 'about');

//passing dynamic data visit blade file and /contact
Route::view('/contact', 'contact', [
    'email' => 'alan@grambil.com',
    'phone' => '909238213912'
]);

///privacy → static page with a privacy message using Route::view().
Route::view('/privacy', 'privacy');

///team → view route with ['members' => ['Alan', 'Maria', 'Dev']] and loop names.
Route::view('/team', 'team', [
    'members' => ['Alan', 'Maria', 'Dev']
]);

//thanks → static “Thank You!” page using Route::view().
Route::view('/thanks', 'thanks');


//Add a route for creating a new post: /posts/create
Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
//Add a route for submitting the form via POST /posts
Route::post('/posts/store', [PostController::class, 'store'])->name('posts.store');
