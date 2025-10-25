<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\PostController;
use App\Models\Category;
use App\Models\Post;
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

// passing dynamic data visit blade file and /contact
Route::view('/contact', 'contact', [
    'email' => 'alan@grambil.com',
    'phone' => '909238213912',
]);

// /privacy → static page with a privacy message using Route::view().
Route::view('/privacy', 'privacy');

// /team → view route with ['members' => ['Alan', 'Maria', 'Dev']] and loop names.
Route::view('/team', 'team', [
    'members' => ['Alan', 'Maria', 'Dev'],
]);

// thanks → static “Thank You!” page using Route::view().
Route::view('/thanks', 'thanks');

// Add a route for creating a new post: /posts/create
Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
// Add a route for submitting the form via POST /posts
Route::post('/posts/store', [PostController::class, 'store'])->name('posts.save');

// optional parameters - use ? after the parameter name and provide a default value
Route::get('/comments/{id?}', function ($id = null) {
    return $id ? "Viewing comment #{$id}" : 'Viewing all comments';
});

// parameter constraints (Regex) - sometimes you want only certain values
Route::get('/comment/{id}', function ($id) {
    return "Viewing the comment #{$id}";
})->where('id', '[0-9]+'); // (now only numeric allowed for id eg: 1,23 & not allowed eg: abc,when)

// multiple constaints using array
Route::get('posts/{postId}/comments/{commentId}', function ($postId, $commentId) {
    return "Post: {$postId}, Comment: {$commentId}";
})->where(['postId' => '[0-9]+', 'commentId' => '[0-9]+']);

// Route wildcards/fallbacks - Use * to capture everything
Route::get('/pages/{any}', function ($any) {
    return "You are viewing page: #{$any}";
})->where('any', '.*');

// fallback routes catches undefined routes
Route::fallback(function () {
    return 'Page not exists!';
});

// named routes - for url generation very useful
Route::get('/posts/{id}', function ($id) {
    return "Viewing post #{$id}";
})->name('posts.edit');

// Route grouping - Let you commanly apply settings to multiple routes at once, so you don't repeat
// Prefix adds /posts to all the routes inside now /posts/create, /posts/{id}, /posts all work without repeat
Route::prefix('posts')->group(function () {
    Route::get('/', function () {
        return 'All posts';
    });

    Route::get('/create', function () {
        return 'Create a post form';
    });

    Route::get('/id?', function ($id) {
        return "Viewing post #{$id}";
    })->where(['id' => '[0-9]+']);
});

// name prefixes - you can also prefix route names
Route::prefix('posts')->name('posts.')->group(function () {
    Route::get('/', function () {
        return 'All posts';
    })->name('index');

    Route::get('/create', function () {
        return 'Create a post form';
    })->name('create');

    Route::get('/id?', function ($id) {
        return "Viewing post #{$id}";
    })->where(['id' => '[0-9]+'])->name('show');
});

// Middleware Grouping - you can apply middleware to a group of routes
Route::middleware('auth')->prefix('posts')->name('posts.')->group(function () {
    Route::get('/', function () {
        return 'All posts';
    })->name('index');

    Route::get('/create', function () {
        return 'Create a post form';
    })->name('create');
});

// Controller Grouping
Route::controller(PostController::class)->prefix('posts')->group(function () {
    Route::get('/', 'index')->name('posts.index');
    Route::get('/create')->name('posts.create');
});

Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create')->middleware('auth');
Route::post('/posts', [PostController::class, 'store'])->name('posts.store')->middleware('auth');
Route::get('/posts/{id}', [PostController::class, 'show'])->name('posts.change');

// Single action controllers for handling only one function
Route::get('/about', AboutController::class);

Route::bind('post', function ($value) {
    return Post::where('title', $value)->firstOrFail();
}); // Explicit Binding - Now $post can use title instead of ID.

// Nested Model binding - For relationships ensures automatically Comment belongs to post if defined contraints in the model
Route::get('/posts/{post}/categories/{category}', function (Post $post, Category $category) {
    return "Post: {$post->title}, Category: {$category->id}";
});
