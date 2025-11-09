<?php

namespace App\Http\Controllers;

use App\Models\Thread;
use Illuminate\Http\Request;

class ThreadController extends Controller
{
    public function index() {
        return inertia('Home', [
            'threads'=> Thread::filter(request('category'))->latest()->get()
        ]);
    }
    public function show(Thread $thread){
        return inertia('threads/Detail',[
            'thread'=>$thread
        ]);
    }
    public function create(){
        return inertia('NewThread');
    }
    public function store(){
        $thread = new Thread;
        request()->validate([
            'title'=>'required',
            'body'=>'required',
            'category_id'=>'required|numeric',
        ],[
            'category_id.required'=>"The category field is required"
        ]);
        $thread->title = request('title');
        $thread->body = request('body');
        $thread->category_id = request('category_id');
        $thread->user_id = auth()->id();
        $thread->save();
        return redirect('/');
    }
}
