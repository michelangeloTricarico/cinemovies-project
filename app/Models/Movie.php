<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    public function director(){
        return $this->belongsTo(Director::class);
    }
    public function reviews(){
        return $this->hasMany(Review::class);
    }
}
