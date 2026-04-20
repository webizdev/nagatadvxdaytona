<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\MotorcycleModel;
use App\Services\ImageOptimizationService;
use App\Jobs\OptimizeProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->latest()->get();
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        $motorcycles = MotorcycleModel::orderBy('brand')->get();
        return view('admin.products.create', compact('categories', 'motorcycles'));
    }

    public function store(Request $request, ImageOptimizationService $imageService)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'sku' => 'required|string|max:50|unique:products,sku',
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:products,slug',
            'description' => 'nullable|string',
            'features' => 'nullable|string',
            'technical_specs' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:10240',
            'gallery_images' => 'nullable|array',
            'gallery_images.*' => 'image|mimes:jpeg,png,jpg,webp|max:10240',
            'compatibility' => 'nullable|array',
            'compatibility.*.motorcycle_id' => 'required|exists:motorcycle_models,id',
        ]);

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['name']);
        }

        $mainTempPath = null;
        if ($request->hasFile('image')) {
            $mainTempPath = $imageService->storeTemp($request->file('image'));
            $validated['image_path'] = $mainTempPath;
        }

        // Initialize empty gallery 
        $validated['gallery'] = [];

        $product = Product::create($validated);

        if ($mainTempPath) {
            OptimizeProductImage::dispatch($product->id, $mainTempPath, 'main');
        }

        // Handle Gallery Images
        if ($request->hasFile('gallery_images')) {
            foreach ($request->file('gallery_images') as $file) {
                $tempGalleryPath = $imageService->storeTemp($file);
                OptimizeProductImage::dispatch($product->id, $tempGalleryPath, 'gallery');
            }
        }

        // Handle Compatibility with pivot data
        if ($request->has('compatibility')) {
            $syncData = [];
            foreach ($request->compatibility as $item) {
                $syncData[$item['motorcycle_id']] = [
                    'diameter' => $item['diameter'] ?? null,
                    'color' => $item['color'] ?? null,
                    'part_number' => $item['part_number'] ?? null,
                ];
            }
            $product->motorcycles()->sync($syncData);
        }

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit(Product $product)
    {
        $product->load(['motorcycles']);
        $categories = Category::all();
        $motorcycles = MotorcycleModel::orderBy('brand')->get();
        return view('admin.products.edit', compact('product', 'categories', 'motorcycles'));
    }

    public function update(Request $request, Product $product, ImageOptimizationService $imageService)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'sku' => 'required|string|max:50|unique:products,sku,' . $product->id,
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:products,slug,' . $product->id,
            'description' => 'nullable|string',
            'features' => 'nullable|string',
            'technical_specs' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:10240',
            'gallery_images' => 'nullable|array',
            'gallery_images.*' => 'image|mimes:jpeg,png,jpg,webp|max:10240',
            'remove_gallery' => 'nullable|array',
            'remove_gallery.*' => 'string',
            'compatibility' => 'nullable|array',
            'compatibility.*.motorcycle_id' => 'required|exists:motorcycle_models,id',
        ]);

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['name']);
        }

        // Handle Main Image
        if ($request->hasFile('image')) {
            // New images are handled via job, we just store temp path here
            $mainTempPath = $imageService->storeTemp($request->file('image'));
            $validated['image_path'] = $mainTempPath;
            
            // Dispatch optimization in background
            OptimizeProductImage::dispatch($product->id, $mainTempPath, 'main');
        }

        // Handle Gallery Removals
        $currentGallery = $product->gallery ?? [];
        if ($request->has('remove_gallery')) {
            foreach ($request->remove_gallery as $imageToRemove) {
                if (($key = array_search($imageToRemove, $currentGallery)) !== false) {
                    unset($currentGallery[$key]);
                    Storage::disk('public')->delete($imageToRemove);
                }
            }
            $product->gallery = array_values($currentGallery);
            $product->save();
        }

        // Handle New Gallery Images
        if ($request->hasFile('gallery_images')) {
            foreach ($request->file('gallery_images') as $file) {
                $tempGalleryPath = $imageService->storeTemp($file);
                OptimizeProductImage::dispatch($product->id, $tempGalleryPath, 'gallery');
            }
        }

        $product->update($validated);

        // Handle Compatibility with pivot data
        if ($request->has('compatibility')) {
            $syncData = [];
            foreach ($request->compatibility as $item) {
                $syncData[$item['motorcycle_id']] = [
                    'diameter' => $item['diameter'] ?? null,
                    'color' => $item['color'] ?? null,
                    'part_number' => $item['part_number'] ?? null,
                ];
            }
            $product->motorcycles()->sync($syncData);
        } else {
            $product->motorcycles()->sync([]);
        }

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(Product $product)
    {
        if ($product->image_path) {
            Storage::disk('public')->delete($product->image_path);
        }

        if ($product->gallery) {
            foreach ($product->gallery as $img) {
                Storage::disk('public')->delete($img);
            }
        }

        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil dihapus.');
    }
}
