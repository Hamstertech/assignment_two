<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Film extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['creator_id', 'title', 'production_studio', 'cost_to_produce', 'language', 'genre'];


    public function creator()
    {
        return $this->belongsTo(Creator::class);
    }
}
