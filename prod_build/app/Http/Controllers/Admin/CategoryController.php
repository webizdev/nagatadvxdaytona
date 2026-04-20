<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::with('parent')->get();
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        $categories = $this->getHierarchicalCategories();
        return view('admin.categories.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:categories,slug',
            'parent_id' => 'nullable|exists:categories,id',
        ]);

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['name']);
        }

        Category::create($validated);

        return redirect()->route('admin.categories.index')->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function edit(Category $category)
    {
        $categories = $this->getHierarchicalCategories($category->id);
        return view('admin.categories.edit', compact('category', 'categories'));
    }

    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:categories,slug,' . $category->id,
            'parent_id' => 'nullable|exists:categories,id',
        ]);

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['name']);
        }

        $category->update($validated);

        return redirect()->route('admin.categories.index')->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('admin.categories.index')->with('success', 'Kategori berhasil dihapus.');
    }

    /**
     * Helper to get hierarchical categories for select dropdown
     */
    private function getHierarchicalCategories($excludeId = null)
    {
        $categories = Category::where('id', '!=', $excludeId)
            ->with('children')
            ->whereNull('parent_id')
            ->get();

        $result = [];
        foreach ($categories as $category) {
            $result[$category->id] = $category->name;
            $this->formatChildren($category, $result, 1, $excludeId);
        }

        return $result;
    }

    private function formatChildren($parent, &$result, $level, $excludeId)
    {
        foreach ($parent->children as $child) {
            if ($child->id == $excludeId) continue;
            
            $result[$child->id] = str_repeat('— ', $level) . $child->name;
            $this->formatChildren($child, $result, $level + 1, $excludeId);
        }
    }
}
