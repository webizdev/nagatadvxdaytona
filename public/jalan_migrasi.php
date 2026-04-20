<?php

/**
 * NAGATA DAYTONA - AUTOMATIC MIGRATION RUNNER
 * Digunakan untuk menjalankan migrasi database tanpa akses terminal.
 */

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Response;

$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

echo "<html><body style='font-family:sans-serif; background:#0f172a; color:#f8fafc; padding:40px; line-height:1.6;'>";
echo "<div style='max-width:600px; margin:0 auto; background:#1e293b; padding:30px; border-radius:20px; border:1px solid #334155; box-shadow:0 10px 30px rgba(0,0,0,0.3);'>";
echo "<h1 style='color:#ef4444; margin-top:0;'>Nagata DB Sync</h1>";
echo "<p style='color:#94a3b8;'>Sedang menjalankan migrasi database...</p>";
echo "<hr style='border:none; border-top:1px solid #334155; margin:20px 0;'>";

try {
    // Jalankan migrasi
    $exitCode = Artisan::call('migrate', ['--force' => true]);
    
    echo "<p style='color:#22c55e; font-weight:bold;'>✓ Berhasil!</p>";
    echo "<div style='background:#0f172a; padding:15px; border-radius:10px; font-family:monospace; font-size:12px; color:#10b981;'>";
    echo str_replace("\n", "<br>", Artisan::output());
    echo "</div>";
    
    echo "<p style='margin-top:20px; font-size:14px;'>Database Anda sekarang sudah sinkron dengan menu baru. Silakan hapus file ini demi keamanan.</p>";
    echo "<a href='/admin/settings' style='display:inline-block; background:#ef4444; color:white; padding:12px 25px; border-radius:10px; text-decoration:none; font-weight:bold; margin-top:10px;'>Masuk ke Pengaturan Website</a>";

} catch (\Exception $e) {
    echo "<p style='color:#ef4444; font-weight:bold;'>❌ Error Terjadi:</p>";
    echo "<pre style='background:#fef2f2; color:#991b1b; padding:15px; border-radius:10px; font-size:12px; overflow:auto;'>";
    echo $e->getMessage();
    echo "</pre>";
}

echo "</div></body></html>";
