<?php

namespace App\Http\Controllers;

use App\Http\Resources\WelcomeResource;
use App\Models\Creator;
use App\Models\Song;

class WelcomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $names = $this->books->pluck('title')->toArray() + $this->films->pluck('title')->toArray() + $this->songs->pluck('name')->toArray();
        return WelcomeResource::collection(Creator::with(['songs', 'films', 'books'])->get());
    }

}
