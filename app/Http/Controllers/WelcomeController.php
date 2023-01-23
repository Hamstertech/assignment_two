<?php

namespace App\Http\Controllers;

use App\Http\Resources\WelcomeResource;
use App\Models\Creator;

class WelcomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return WelcomeResource::collection(Creator::with(['songs', 'films', 'books'])->get());
    }

}
