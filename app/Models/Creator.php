<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Creator extends Model
{
    use HasFactory, SoftDeletes;


    
    public function books()
    {
        return $this->hasMany(Book::class);
    }

    public function films()
    {
        return $this->hasMany(Film::class);
    }

    public function songs()
    {
        return $this->hasMany(Song::class);
    }
}
