<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;


class Products extends Controller
{
    public function index(Request $request, $categoryId = null)
    {
        try {
            $search = $request->query('search');
            if ($search !== null) {

                $products = Product::where(function ($q) use ($search) {
                    $q->where('name', 'LIKE', "%{$search}%")
                        ->orWhere('cas_number', 'LIKE', "%{$search}%");
                })->whereHas('category', function ($q) {
                    $q->where('status', 1);
                })->latest()->take(10)->get();
            } elseif ($categoryId !== null) {

                $categoryExist = Category::where('id', $categoryId)->where('status', 1)->exists();
                if (!is_numeric($categoryId) || !$categoryExist) {
                    return abort(404, 'Invalid category ID.');
                }
                $products = Product::where('category_id', $categoryId)->latest()->take(10)->get();
            } else {

                $products = Product::whereHas('category', function ($q) {
                    $q->where('status', 1);
                })->latest()->take(10)->get();
            }

            $hasMore = $products->count() > 9;
            if ($hasMore) $products = $products->take(9);
            $allCategories = Category::where('status', 1)->get();

            return view('pages.products', compact('products', 'allCategories', 'hasMore'));
        } catch (\Throwable $e) {
            Log::error('Error fetching products: ' . $e->getMessage(), [
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);

            echo $e->getMessage();
            // return response()->view('errors.404', [], 500);
        }
    }

    public function loadMore(Request $request)
    {
        $page = (int) $request->query('page', 1);
        $perPage = 9;
        $sort = $request->query('sort');
        $categoryId = $request->query('category_id');
        $search = $request->query('search');

        $query = Product::query();

        if ($categoryId) {
            $query->where('category_id', $categoryId);
        }

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%$search%")->orWhere('cas_number', 'like', "%$search%");
            });
        }

        switch ($sort) {
            case 'name_asc':
                $query->orderBy('name', 'asc');
                break;
            case 'name_desc':
                $query->orderBy('name', 'desc');
                break;
            case 'date_asc':
                $query->orderBy('created_at', 'asc');
                break;
            case 'date_desc':
                $query->orderBy('created_at', 'desc');
                break;
            case 'availability':
                $query->orderBy('stock', 'desc');
                break;
            default:
                $query->latest();
        }

        $totalCount = $query->count();
        $hasMore = ($page * $perPage) < $totalCount;

        $products = $query->skip(($page - 1) * $perPage)->take($perPage)->get();

        return response()->json([
            'html' => view('partials.product-cards', compact('products'))->render(),
            'hasMore' => $hasMore
        ]);
    }



    public function single($id)
    {
        $product = Product::findOrFail($id);
        return view('pages.singleProduct', compact('product'));
    }
}
