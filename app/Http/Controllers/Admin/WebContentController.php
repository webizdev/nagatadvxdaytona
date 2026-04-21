<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WebContent;
use App\Services\ImageOptimizationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WebContentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contents = WebContent::all()->groupBy('page');
        return view('admin.content.index', compact('contents'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $data = $request->except(['_token', '_method']);
        $imageService = app(ImageOptimizationService::class);

        foreach ($data as $slug => $value) {
            $content = WebContent::where('slug', $slug)->first();
            if (!$content) continue;

            if ($content->type === 'image') {
                if ($request->hasFile($slug)) {
                    // Delete old image if exists and not a URL
                    if ($content->value && !str_starts_with($content->value, 'http')) {
                        Storage::disk('public')->delete($content->value);
                    }

                    // Upload and optimize
                    $path = $imageService->uploadAndOptimize(
                        $request->file($slug), 
                        'web_contents'
                    );
                    $content->update(['value' => $path]);
                }
            } else {
                $content->update(['value' => $value]);
            }
        }

        return redirect()->back()->with('success', 'Konten berhasil diperbarui!');
    }
}
