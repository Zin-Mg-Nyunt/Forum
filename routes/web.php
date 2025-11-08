<?php

use App\Models\Thread;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Laravel\Fortify\Features;

Route::get('/', function () {
    return inertia('Home', [
        'threads'=> Thread::filter(request('category'))->latest()->get()
    ]);
})->name('home');

Route::get('/new-thread',function(){
    return inertia('NewThread');
})->name('newThread');

Route::post('/createThread',function(){
    $thread = new Thread;
    $thread->title = request('title');
    $thread->body = request('body');
    $thread->category_id = request('category');
    $thread->user_id = auth()->id();
    $thread->save();
    return redirect('/');
});

require __DIR__.'/settings.php';
