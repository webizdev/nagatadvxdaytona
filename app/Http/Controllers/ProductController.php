<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\MotorcycleModel;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display the product catalog.
     */
    public function index(Request $request)
    {
        // 1. Fetch Categories for the Sidebar (3 levels)
        $categories = Category::whereNull('parent_id')
            ->with(['children.children'])
            ->get();

        // 2. Grouped motorcycle brands for widget
        $motorcyclesByBrand = MotorcycleModel::whereNotIn('brand', ['Universal'])
            ->orderBy('brand')->orderBy('model_name')
            ->get()->groupBy('brand');

        // 3. Build the Product Query
        $productQuery = Product::with('category');

        // 3a. Search by Name, SKU, Technical Specs, or Motorcycle Part Number
        $search = trim($request->input('q'));
        if ($search) {
            $productQuery->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', '%' . $search . '%')
                  ->orWhere('sku',  'LIKE', '%' . $search . '%')
                  ->orWhere('technical_specs', 'LIKE', '%' . $search . '%')
                  ->orWhereHas('motorcycles', function ($q2) use ($search) {
                      $q2->where('product_motorcycle.part_number', 'LIKE', '%' . $search . '%');
                  });
            });
        }

        // 3b. Filter by Category
        $activeCategory = null;
        if ($request->has('category')) {
            $activeCategory = Category::where('slug', $request->category)->first();

            if ($activeCategory) {
                $categoryIds = $this->getAllCategoryIds($activeCategory);
                $productQuery->whereIn('category_id', $categoryIds);
            }
        }

        // 3c. Filter by Motorcycle brand & model
        $activeMoto = null;
        if ($request->filled('brand') || $request->filled('model')) {
            // Build matching motorcycle records
            $motoMatches = MotorcycleModel::query();
            if ($request->filled('brand')) {
                $motoMatches->where('brand', $request->brand);
            }
            if ($request->filled('model')) {
                $motoMatches->where('model_name', $request->model);
            }
            $matchedMotos = $motoMatches->get();
            $activeMoto   = $matchedMotos->first(); // for the banner

            if ($activeMoto) {
                $motoIds = $matchedMotos->pluck('id');
                $productQuery->whereHas('motorcycles', function ($q) use ($motoIds) {
                    $q->whereIn('motorcycle_models.id', $motoIds);
                });
            }
        }

        // 4. Paginate results (preserve all query strings)
        $products = $productQuery->latest()->paginate(12)->withQueryString();

        return view('products.index', compact(
            'categories', 'products', 'activeCategory',
            'search', 'motorcyclesByBrand', 'activeMoto'
        ));
    }

    /**
     * Display the product detail page.
     */
    public function show($slug)
    {
        $product = Product::with(['category', 'specifications', 'motorcycles'])
            ->where('slug', $slug)
            ->firstOrFail();

        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->limit(3)
            ->get();

        return view('products.show', compact('product', 'relatedProducts'));
    }

    /**
     * Helper to get IDs of a category and all its descendants.
     */
    private function getAllCategoryIds($category)
    {
        $ids = [$category->id];

        foreach ($category->children as $child) {
            $ids = array_merge($ids, $this->getAllCategoryIds($child));
        }

        return $ids;
    }
}
