<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'productCount' => Product::count(),
            'activeProductCount' => Product::where('status', 'active')->count(),
            'categoryCount' => Category::count(),
            'userCount' => User::count(),
            'latestProducts' => Product::with('category')->latest('id')->take(5)->get(),
            'topCategories' => Category::withCount('products')
                ->orderByDesc('products_count')
                ->take(5)
                ->get(),
        ]);
    }
}
