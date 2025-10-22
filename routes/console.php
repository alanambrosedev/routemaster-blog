<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;


/*
This file doesn't handle http requests. Instead, it defines custom artisan commands (CLI)
Used for running logic via terminal
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

//To run this in terminal use php artisan inspire


Artisan::command('hello', function (){
    $this->info('Hello from RouteMaster Blog!');
});
