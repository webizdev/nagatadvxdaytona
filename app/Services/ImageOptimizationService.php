<?php

namespace App\Services;

use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Encoders\WebpEncoder;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class ImageOptimizationService
{
    protected $manager;

    public function __construct()
    {
        $this->manager = new ImageManager(new Driver());
    }

    /**
     * Stores an uploaded file in a temporary location for future background processing.
     */
    public function storeTemp(UploadedFile $file): string
    {
        return $file->store('temp', 'public');
    }

    /**
     * Optimizes a file from a given path on disk.
     * 
     * @param string $path Local path relative to 'public' disk.
     * @param string $targetDirectory Directory to save the final webp.
     */
    public function optimizeFromLocalPath(string $path, string $targetDirectory, int $maxWidth = 1920, int $quality = 80): ?string
    {
        try {
            if (!Storage::disk('public')->exists($path)) {
                Log::error("ImageOptimization: File not found at $path");
                return null;
            }

            $absolutePath = Storage::disk('public')->path($path);
            
            // Read image
            $image = $this->manager->read($absolutePath);

            // Resize down if needed
            if ($image->width() > $maxWidth) {
                $image->scale(width: $maxWidth);
            }

            // Generate target filename
            $filename = Str::random(40) . '.webp';
            $targetPath = trim($targetDirectory, '/') . '/' . $filename;
            $finalAbsolutePath = Storage::disk('public')->path($targetPath);

            // Ensure target dir exists
            Storage::disk('public')->makeDirectory($targetDirectory);

            // Encode and Save
            $encoded = $image->encode(new WebpEncoder(quality: $quality));
            $encoded->save($finalAbsolutePath);

            return $targetPath;
        } catch (\Exception $e) {
            Log::error("ImageOptimization Error: " . $e->getMessage());
            return null;
        }
    }

    /**
     * Legacy/Synchronous method (keeping for compatibility or simple uses).
     */
    public function uploadAndOptimize(UploadedFile $file, string $directory, int $maxWidth = 1920, int $quality = 80): string
    {
        $filename = Str::random(40) . '.webp';
        $storePath = trim($directory, '/') . '/' . $filename;
        $absolutePath = storage_path('app/public/' . $storePath);

        Storage::disk('public')->makeDirectory($directory);

        $image = $this->manager->read($file->getRealPath());

        if ($image->width() > $maxWidth) {
            $image->scale(width: $maxWidth);
        }

        $encodedImage = $image->encode(new WebpEncoder(quality: $quality));
        $encodedImage->save($absolutePath);

        return $storePath;
    }
}
