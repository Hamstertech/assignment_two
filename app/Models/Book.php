<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['creator_id', 'title', 'isbn', 'publishing_house', 'language', 'genre'];

    
    public function creator()
    {
        return $this->belongsTo(Creator::class);
    }
}
