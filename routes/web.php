<?php

use App\Http\Controllers\ThreadController;
use App\Models\Thread;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Laravel\Fortify\Features;

Route::get('/', [ThreadController::class,'index'])->name('home');

Route::get('/threads/{thread}',[ThreadController::class,'show']);


Route::get('/new-thread',[ThreadController::class,'create'])->name('newThread');

Route::post('/createThread',[ThreadController::class,'store']);

require __DIR__.'/settings.php';
