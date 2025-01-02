<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BlogController extends Controller
{
    // membuat method index
    function index()
    {
        return view('blog', ['data' => 'Apa Ini']);
    }
}
