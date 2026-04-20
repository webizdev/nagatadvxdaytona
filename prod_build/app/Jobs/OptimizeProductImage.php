<?php

namespace App\Jobs;

use App\Models\Product;
use App\Services\ImageOptimizationService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class OptimizeProductImage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $productId;
    protected $tempPath;
    protected $target;

    /**
     * Create a new job instance.
     * 
     * @param int $productId
     * @param string $tempPath
     * @param string $target 'main' or 'gallery'
     */
    public function __construct(int $productId, string $tempPath, string $target = 'main')
    {
        $this->productId = $productId;
        $this->tempPath = $tempPath;
        $this->target = $target;
    }

    /**
     * Execute the job.
     */
    public function handle(ImageOptimizationService $service): void
    {
        $product = Product::find($this->productId);
        
        if (!$product) {
            Log::warning("OptimizeProductImage: Product {$this->productId} not found.");
            Storage::disk('public')->delete($this->tempPath);
            return;
        }

        Log::info("Optimizing image ({$this->target}) for product: {$product->name}");

        // Perform optimization 
        // We save to 'products' directory 
        $optimizedPath = $service->optimizeFromLocalPath($this->tempPath, 'products');

        if ($optimizedPath) {
            if ($this->target === 'main') {
                $oldPath = $product->image_path;
                $product->image_path = $optimizedPath;
                $product->save();

                // Cleanup temp file
                Storage::disk('public')->delete($this->tempPath);
                
                Log::info("Product {$product->id} image optimized to $optimizedPath");
            } else {
                // GALLERY: Use transaction to prevent race conditions during concurrent jobs
                DB::transaction(function() use ($product, $optimizedPath) {
                    $p = Product::where('id', $product->id)->lockForUpdate()->first();
                    $gallery = $p->gallery ?? [];
                    
                    // Add to gallery if not already there 
                    if (!in_array($optimizedPath, $gallery)) {
                        $gallery[] = $optimizedPath;
                        $p->gallery = $gallery;
                        $p->save();
                    }
                });

                // Cleanup temp file
                Storage::disk('public')->delete($this->tempPath);
                Log::info("Product {$product->id} gallery image optimized to $optimizedPath");
            }
        } else {
            Log::error("Failed to optimize {$this->target} image for product {$product->id}");
            // Still cleanup temp if fails to prevent clutter
            Storage::disk('public')->delete($this->tempPath);
        }
    }
}
