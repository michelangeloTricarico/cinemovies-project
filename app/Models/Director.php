<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Director extends Model
{
    protected $fillable = ['first_name', 'last_name', 'birth_date', 'biography'];

    public function movies(){
        return $this->hasMany(Movie::class);
    }
}
