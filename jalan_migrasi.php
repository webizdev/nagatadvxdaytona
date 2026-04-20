<?php

use Illuminate\Support\Facades\Artisan;

// Load Laravel
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$kernel->handle(Illuminate\Http\Request::capture());

echo "Menjalankan migrasi tambah kolom maps_url...\n";

try {
    Artisan::call('migrate', [
        '--force' => true,
    ]);
    echo Artisan::output();
    echo "Selesai!\n";
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
