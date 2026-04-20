<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\MotorcycleModel;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display the application landing page.
     */
    public function index()
    {
        // Get 8 latest products
        $latestProducts = Product::latest()->take(8)->get();

        // Get grouped motorcycle brands & models for the "Find My Part" widget
        $motorcyclesByBrand = MotorcycleModel::whereNotIn('brand', ['Universal'])
            ->orderBy('brand')
            ->orderBy('model_name')
            ->get()
            ->groupBy('brand');

        return view('welcome', compact('latestProducts', 'motorcyclesByBrand'));
    }

    /**
     * Display the About Us page.
     */
    public function about()
    {
        return view('pages.about');
    }

    /**
     * Display the Contact page.
     */
    public function contact()
    {
        return view('pages.contact');
    }
}
