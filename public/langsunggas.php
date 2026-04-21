<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;

/**
 * LANGSUNG GASSS! - Nagata Daytona Live Hosting Utility
 * Script ini digunakan untuk menjalankan migrasi dan setup awal di hosting tanpa SSH.
 */

// 1. Load Laravel
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

echo "<h1>🚀 Nagata Daytona Deployment Utility</h1>";
echo "<pre>";

try {
    // 2. Jalankan Migrasi
    echo "Menjalankan migrasi...\n";
    Artisan::call('migrate', ['--force' => true]);
    echo Artisan::output();
    echo "✅ Migrasi selesai.\n\n";

    // 3. Jalankan Seeder
    echo "Mengisi data awal (Seeding)...\n";
    Artisan::call('db:seed', ['--class' => 'WebContentSeeder', '--force' => true]);
    Artisan::call('db:seed', ['--class' => 'CategorySeeder', '--force' => true]);
    echo "✅ Seeding selesai.\n\n";

    // 4. Optimasi
    echo "Membersihkan cache...\n";
    Artisan::call('view:clear');
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    echo "✅ Cache dibersihkan.\n\n";

    // 5. Buat Storage Link
    echo "Membuat link storage...\n";
    if (file_exists(public_path('storage'))) {
        echo "⚠️ Folder storage sudah ada.\n";
    } else {
        Artisan::call('storage:link');
        echo "✅ Link storage berhasil dibuat.\n\n";
    }

    echo "<h1>✨ SEMUA BERHASIL! ✨</h1>";
    echo "Silakan coba akses website Anda lagi.";

} catch (\Exception $e) {
    echo "<h1>❌ ERROR TERJADI!</h1>";
    echo "Pesan Error: " . $e->getMessage() . "\n";
    echo "Trace:\n" . $e->getTraceAsString();
}

echo "</pre>";
