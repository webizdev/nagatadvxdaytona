<?php
// Temporary diagnostic script to count data
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';

use Illuminate\Support\Facades\DB;
use App\Models\Category;
use App\Models\Product;
use App\Models\MotorcycleModel;

$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

echo "START_STATS" . PHP_EOL;
try {
    echo "Categories: " . Category::count() . PHP_EOL;
    echo "Products: " . Product::count() . PHP_EOL;
    echo "Motorcycles: " . MotorcycleModel::count() . PHP_EOL;
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage();
}
echo "END_STATS";
