<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $activeProducts = Product::query()
            ->whereHas('category', fn ($query) => $query->where('status', 1));

        $featuredProducts = (clone $activeProducts)
            ->latest()
            ->take(6)
            ->get();

        $topCategories = Category::query()
            ->where('status', 1)
            ->withCount('products')
            ->orderByDesc('products_count')
            ->take(4)
            ->get();

        $catalogStats = [
            'products' => (clone $activeProducts)->count(),
            'categories' => Category::where('status', 1)->count(),
            'cas_records' => (clone $activeProducts)->whereNotNull('cas_number')->count(),
        ];

        return view('pages.home', compact('featuredProducts', 'topCategories', 'catalogStats'));
    }
}
