<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;

class HomeController extends Controller
{
    /**
     * Storefront home page: a few real products and the category shelves.
     */
    public function index()
    {
        return view('welcome', [
            'products' => Product::with('category')->where('status', 'active')->latest('id')->take(8)->get(),
            'categories' => Category::withCount('active_products')->orderBy('name')->get(),
            'productCount' => Product::where('status', 'active')->count(),
            'categoryCount' => Category::count(),
        ]);
    }
}
