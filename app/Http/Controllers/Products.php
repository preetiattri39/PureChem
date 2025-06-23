<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Products extends Controller
{
     public function index()
    {
        return view('pages.products');
    }

    public function single()
    {
        return view('pages.singleProduct');
    }
}
