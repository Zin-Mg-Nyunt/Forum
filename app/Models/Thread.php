<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    /** @use HasFactory<\Database\Factories\ThreadFactory> */
    use HasFactory;
    protected $with = ['user','category'];

    // thread belongsTo user
    public function user(){
        return $this->belongsTo(User::class);
    }

    // thread belongsTo category
    public function category(){
        return $this->belongsTo(Category::class);
    }

    // thread belongsToMany tags
    public function tags(){
        return $this->belongsToMany(Tag::class);
    }

    public function scopeFilter($query,$filter){
        $query->when($filter['category']??false,function ($query,$filter){
            $query->whereHas('category',function($query) use($filter){
            $query->where('slug',$filter);  
            });
        });
        $query->when($filter['tag']??false,function ($query,$filter){
            $query->whereHas('tags',function($query) use($filter){
            $query->where('slug',$filter);
            });
        });
        $query->when($filter['search']??false,function ($query,$filter){
            $query->whereLike('title','%'.$filter.'%')
                ->orWhereLike('body','%'.$filter.'%');
        });
    }
}
