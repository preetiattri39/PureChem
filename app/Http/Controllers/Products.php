<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class Products extends Controller
{
     public function index()
    {
        $products = Product::limit(9)->get();
        $allCategories = Category::all();
        return view('pages.products',compact('products','allCategories'));
    }

    public function single()
    {
        return view('pages.singleProduct');
    }
}
