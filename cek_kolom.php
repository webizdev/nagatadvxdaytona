<?php

use Illuminate\Support\Facades\Schema;

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$kernel->handle(Illuminate\Http\Request::capture());

$columns = Schema::getColumnListing('branches');
echo "Kolom di tabel branches:\n";
print_r($columns);

if (in_array('maps_url', $columns)) {
    echo "\n[OK] Kolom maps_url DITEMUKAN.\n";
} else {
    echo "\n[ERROR] Kolom maps_url TIDAK ADA. Silakan jalankan jalan_migrasi.php\n";
}
