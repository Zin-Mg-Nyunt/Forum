<?php

use App\Models\Thread;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Laravel\Fortify\Features;

Route::get('/', function () {
    return inertia('Home', [
        'threads'=> Thread::latest()->get()
    ]);
})->name('home');

Route::get('/new-thread',function(){
    return inertia('NewThread');
})->name('newThread');

require __DIR__.'/settings.php';
