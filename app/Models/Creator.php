<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Creator extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['first_name', 'last_name', 'date_of_birth', 'nationality'];


    public static function boot() {
        parent::boot();
        
        self::deleting(function ($model) {
            $model->books()->each(function ($book) {
                $book->delete();
            });
            $model->films()->each(function ($film) {
                $film->delete();
            });
            $model->songs()->each(function ($song) {
                $song->delete();
            });
        });
    }
    
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
