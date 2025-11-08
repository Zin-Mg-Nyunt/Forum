<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    /** @use HasFactory<\Database\Factories\ThreadFactory> */
    use HasFactory;
    protected $with = ['user'];

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

}
