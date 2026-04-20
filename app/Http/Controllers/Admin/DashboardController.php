<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\MotorcycleModel;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalCategories = Category::count();
        $totalProducts = Product::count();
        $totalMotorcycles = MotorcycleModel::count();

        return view('admin.dashboard', compact(
            'totalCategories',
            'totalProducts',
            'totalMotorcycles'
        ));
    }
}
