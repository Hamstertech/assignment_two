<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Song extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['creator_id', 'name', 'duration', 'record_label', 'tempo', 'genre'];


    public function creator()
    {
        return $this->belongsTo(Creator::class);
    }
}
