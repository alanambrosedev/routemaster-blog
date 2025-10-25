<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
This file is for api endpoints. Used for json responses (no views), token based or sanctum authentication, mobile
or frontend SPA apps
Has a default middleware api. Api are stateless (no cookies / session)
*/
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/posts', function () {
    return ['title' => 'API example post'];
});

Route::get('/info', function () {
    return ['app' => config('app.name'), 'version' => app()->version()];
});
