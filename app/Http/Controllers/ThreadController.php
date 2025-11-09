<?php

namespace App\Http\Controllers;

use App\Models\Thread;
use Illuminate\Http\Request;

class ThreadController extends Controller
{
    public function index() {
        return inertia('Home', [
            'threads'=> Thread::filter(request(['category','tag','search']))->latest()->get()
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
        request()->validate([
            'title'=>'required',
            'body'=>'required',
            'category_id'=>'required|numeric',
        ],[
            'category_id.required'=>"The category field is required"
        ]);

        $thread = new Thread;
        $thread->title = request('title');
        $thread->body = request('body');
        $thread->category_id = request('category_id');
        $thread->user_id = auth()->id();
        $thread->save();
        return redirect('/');
    }
    public function destroy(Thread $thread){
        $thread->delete();
        return redirect('/');
    }
}
