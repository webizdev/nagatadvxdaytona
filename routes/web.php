<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/tentang-kami', [HomeController::class, 'about'])->name('about');
Route::get('/hubungi-kami', [HomeController::class, 'contact'])->name('contact');

// Product Catalog
Route::get('/produk', [ProductController::class, 'index'])->name('products.index');
Route::get('/produk/{slug}', [ProductController::class, 'show'])->name('products.show');

// Dealers / Where to buy
Route::get('/lokasi-dealer', [\App\Http\Controllers\DealerController::class, 'index'])->name('dealers.index');

// Admin Route Group
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', function () {
        return redirect()->route('admin.dashboard');
    });
    Route::get('/dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');

    Route::resource('categories', \App\Http\Controllers\Admin\CategoryController::class);
    Route::resource('products', \App\Http\Controllers\Admin\ProductController::class);

    // Website Settings Routes
    Route::prefix('settings')->name('settings.')->group(function () {
        Route::get('/', [\App\Http\Controllers\Admin\SettingController::class, 'index'])->name('index');
        Route::post('/identity', [\App\Http\Controllers\Admin\SettingController::class, 'updateIdentity'])->name('update-identity');
        Route::delete('/logo', [\App\Http\Controllers\Admin\SettingController::class, 'deleteLogo'])->name('delete-logo');
        
        // Branches
        Route::post('/branches', [\App\Http\Controllers\Admin\SettingController::class, 'storeBranch'])->name('store-branch');
        Route::put('/branches/{branch}', [\App\Http\Controllers\Admin\SettingController::class, 'updateBranch'])->name('update-branch');
        Route::delete('/branches/{branch}', [\App\Http\Controllers\Admin\SettingController::class, 'destroyBranch'])->name('destroy-branch');

        // Social Media
        Route::post('/social', [\App\Http\Controllers\Admin\SettingController::class, 'storeSocial'])->name('store-social');
        Route::put('/social/{social}', [\App\Http\Controllers\Admin\SettingController::class, 'updateSocial'])->name('update-social');
        Route::delete('/social/{social}', [\App\Http\Controllers\Admin\SettingController::class, 'destroySocial'])->name('destroy-social');
    });

    // Universal Content Manager
    Route::get('/content', [\App\Http\Controllers\Admin\WebContentController::class, 'index'])->name('content.index');
    Route::post('/content', [\App\Http\Controllers\Admin\WebContentController::class, 'update'])->name('content.update');

    // System Utilities
    Route::get('/system/storage-link', function () {
        try {
            \Illuminate\Support\Facades\Artisan::call('storage:link');
            return "Storage link created successfully!";
        } catch (\Exception $e) {
            return "Error: " . $e->getMessage();
        }
    })->name('system.storage-link');
});

// Profile Routes (from Breeze)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
