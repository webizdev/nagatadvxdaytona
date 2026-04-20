<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\MotorcycleModel;
use App\Models\ProductSpecification;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ScrapedProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            // --- Batch 1 (Previous) ---
            [
                "name" => "SUPERPRO T-Floating Race Disc Rotor",
                "category_lvl1" => "Performance Components", "category_lvl2" => "Brake System", "category_lvl3" => "Disc Rotors",
                "sku" => "SP-BRK-001",
                "image_url" => "https://daytonaindonesia.com/uploads/ngc_global_posts/6912d600bed4e_20251111132152-1.JPG",
                "description" => "SUPERPRO RACE DISC “COOL and LIGHT”, DISC BRAKE SUPERPRO “DINGIN dan RINGAN”. Designed for competition use with aerospace technology.",
                "specifications" => ["Material" => "A7075 Aerospace Technology (center bracket), A6061 CNC (bracket)", "Design" => "T-Floating design", "Cooling" => "Tapered tornado-holes cooling system"],
                "compatibility" => [["brand" => "Yamaha", "model" => "Jupiter Z"], ["brand" => "Honda", "model" => "Beat"], ["brand" => "Yamaha", "model" => "Xmax"]]
            ],
            [
                "name" => "Superstock Air Filter",
                "category_lvl1" => "Maintenance Parts", "category_lvl2" => "Filter System", "category_lvl3" => "Air Filters",
                "sku" => "SS-FLT-001",
                "image_url" => "https://daytonaindonesia.com/uploads/ngc_global_posts/5ef4700d11756_20200625164621-1.JPG",
                "description" => "CLEANER & HIGH FLOW, ALIRAN UDARA LEBIH BERSIH DAN LANCAR. 15% greater filtering performance and 15% longer life.",
                "specifications" => ["Filtering" => "15% greater filtering performance", "Durability" => "15% longer life"],
                "compatibility" => [["brand" => "Honda", "model" => "Vario"], ["brand" => "Yamaha", "model" => "Nmax"]]
            ],
            [
                "name" => "ANIMA 190FE Engine Kit",
                "category_lvl1" => "Racing Engines", "category_lvl2" => "Anima Series", "category_lvl3" => "Complete Kits",
                "sku" => "ANM-ENG-190",
                "image_url" => "https://daytonaindonesia.com/uploads/ngc_global_posts/67972ba783321_Anima%20190%20FE%20update-01.jpg",
                "description" => "High-performance engine designed for serious riders and competitive racers.",
                "specifications" => ["Displacement" => "187.2cc (φ62 x 62mm)", "Type" => "SOHC/4-Valve", "Transmission" => "5-speed"],
                "compatibility" => [["brand" => "Honda", "model" => "CRF50"]]
            ],
            [
                "name" => "Double Iridium Spark Plug",
                "category_lvl1" => "Performance Components", "category_lvl2" => "Ignition System", "category_lvl3" => "Spark Plugs",
                "sku" => "IG-SPK-IRI",
                "image_url" => "https://daytonaindonesia.com/uploads/ngc_global_posts/5ef18c7eaad09_20200623121510-1.JPG",
                "description" => "STRONGEST IGNITION AND POWER, PENGAPIAN LEBIH BESAR, MOTOR LEBIH BERTENAGA.",
                "specifications" => ["Material" => "Double Iridium", "Electrode" => "0.5(dia.) mm"],
                "compatibility" => [["brand" => "Honda", "model" => "Vario 150"], ["brand" => "Yamaha", "model" => "Xmax"]]
            ],
            [
                "name" => "Heavy Duty Drive Chain 428",
                "category_lvl1" => "Drive & Transmission", "category_lvl2" => "Chain Kit", "category_lvl3" => "Drive Chains",
                "sku" => "DRV-CHN-428",
                "image_url" => "https://daytonaindonesia.com/uploads/ngc_global_posts/5ef178873ad7d_20200623104847-1.JPG",
                "description" => "THICKER PLATES AND SOLID BUSHING, LEBIH KUAT DENGAN PLAT LEBIH TEBAL DAN SOLID BUSHING.",
                "specifications" => ["Bushing" => "Solid Bush Chain (23% Stronger)", "Plates" => "Hardened 2.0mm plates"],
                "compatibility" => [["brand" => "Yamaha", "model" => "Vixion"], ["brand" => "Honda", "model" => "Supra X 125"]]
            ],
            [
                "name" => "Hi-Kevlar™ Carbon Clutch Shoe",
                "category_lvl1" => "Drive & Transmission", "category_lvl2" => "CVT Parts", "category_lvl3" => "Clutch Shoe",
                "sku" => "CVT-CLT-KEV",
                "image_url" => "https://daytonaindonesia.com/uploads/ngc_global_posts/5ef4675753066_20200625160913-1.JPG",
                "description" => "REDUCES SLIPPING WITH HI-KEVLAR™ & CARBON COMPOUND. Provides great high temperature resistance.",
                "specifications" => ["Material" => "Kevlar and Carbon Compound", "Benefit" => "Reduces slipping"],
                "compatibility" => [["brand" => "Yamaha", "model" => "Nmax"], ["brand" => "Honda", "model" => "PCX 150"]]
            ],

            // --- Batch 2 (New) ---
            [
                "name" => "CNC Brake Caliper 2 Piston",
                "category_lvl1" => "Performance Components", "category_lvl2" => "Brake System", "category_lvl3" => "Brake Calipers",
                "sku" => "5668",
                "image_url" => "https://daytonaindonesia.com/uploads/ngc_global_posts/69118f7ac9843_20251110140842-1.JPG",
                "description" => "CALIPER DAYTONA ULTRA DRIVE 2 PISTON CNC. DAYA PENGEREMAN EXTRIM.",
                "specifications" => ["Piston Size" => "32mm", "Material" => "Aluminum CNC T6061", "Seals" => "Made in Japan"],
                "compatibility" => [["brand" => "Universal", "model" => "Brembo 2P Bracket"]]
            ],
            [
                "name" => "CNC Brake Caliper 4 Piston - Right Side",
                "category_lvl1" => "Performance Components", "category_lvl2" => "Brake System", "category_lvl3" => "Brake Calipers",
                "sku" => "5670",
                "image_url" => "https://daytonaindonesia.com/uploads/ngc_global_posts/5638c6423c914_20251110141655-1.JPG",
                "description" => "CALIPER DAYTONA ULTRA DRIVE 4 PISTON - RIGHT SIDE. DAYA PENGEREMAN EXTRIM.",
                "specifications" => ["Piston Size" => "30mm (x4)", "Material" => "Aluminum CNC T6061", "Feature" => "High Quality Brake Pad included"],
                "compatibility" => [["brand" => "Universal", "model" => "Brembo 4P Bracket"]]
            ],
            [
                "name" => "Superstock Pulley EVO 13.8° Kit",
                "category_lvl1" => "Performance Components", "category_lvl2" => "CVT System", "category_lvl3" => "Pulley Kits",
                "sku" => "5543",
                "image_url" => "https://daytonaindonesia.com/uploads/ngc_global_posts/69144f0f53c8e_20251112161039-1.jpg",
                "description" => "QUICK ACCELERATION. AKSELERASI LEBIH CEPAT.",
                "specifications" => ["Angle" => "13.8 degree", "Feature" => "Large Drive Face, Interlock system"],
                "compatibility" => [["brand" => "Honda", "model" => "Beat Fi"], ["brand" => "Honda", "model" => "Vario 125"], ["brand" => "Honda", "model" => "Vario 160"]]
            ],
            [
                "name" => "Evo Spark Plug Cap",
                "category_lvl1" => "Maintenance Parts", "category_lvl2" => "Ignition System", "category_lvl3" => "Spark Plug Caps",
                "sku" => "5239",
                "image_url" => "https://daytonaindonesia.com/uploads/ngc_global_posts/69140bb56aeb6_20251112112317-1.jpg",
                "description" => "BIGGER IGNITION. PENGAPIAN LEBIH BESAR. Proven Increase by Dynostar.",
                "specifications" => ["Stability" => "Stable Ignition", "Resistance" => "Less Resistance"],
                "compatibility" => [["brand" => "Honda", "model" => "Universal"], ["brand" => "Yamaha", "model" => "Universal"]]
            ],
            [
                "name" => "Road Race Grip",
                "category_lvl1" => "Performance Components", "category_lvl2" => "Control System", "category_lvl3" => "Handlebar Grips",
                "sku" => "2738",
                "image_url" => "https://daytonaindonesia.com/uploads/ngc_global_posts/554d193e4811a_20251111165217-1.jpg",
                "description" => "SOFT AND ANTI-FATIQUE. Dual Compound with Sharp edge pattern.",
                "specifications" => ["Grooves" => "3 Wire-Lock Grooves", "Material" => "Dual Compound"],
                "compatibility" => [["brand" => "Universal", "model" => "22mm Handlebar"]]
            ],
            [
                "name" => "Wheel & C3 Crankshaft Bearings",
                "category_lvl1" => "Maintenance Parts", "category_lvl2" => "Engine & Wheels", "category_lvl3" => "Bearings",
                "sku" => "3227",
                "image_url" => "https://daytonaindonesia.com/uploads/ngc_global_posts/515291eb8f42f_WhatsApp_Image_2019-10-02_at_11.53.05.jpeg",
                "description" => "STRONG & DURABLE. KUAT DAN TAHAN LAMA. 20% Longer Life.",
                "specifications" => ["Seal" => "Two Rubber Seals (2RS)", "Life" => "20% Longer Life"],
                "compatibility" => [["brand" => "Honda", "model" => "Universal"], ["brand" => "Yamaha", "model" => "Universal"]]
            ],
            [
                "name" => "7 Star Wheel CNC",
                "category_lvl1" => "Performance Components", "category_lvl2" => "Engine & Wheels", "category_lvl3" => "Cast Wheels",
                "sku" => "5040",
                "image_url" => "https://daytonaindonesia.com/uploads/ngc_global_posts/69b2559d6774e_20260312125645-1.jpeg",
                "description" => "The legendary '7 Star Wheel' was the first cast wheel specifically designed for motorcycles in Japan.",
                "specifications" => ["Material" => "Aluminum A356-T6", "Process" => "Precision CNC Machining", "Standard" => "JWL and SNI"],
                "compatibility" => [["brand" => "Honda", "model" => "Beat Fi"], ["brand" => "Honda", "model" => "Vario 150"]]
            ],
            [
                "name" => "Fuel Injector",
                "category_lvl1" => "Maintenance Parts", "category_lvl2" => "Engine & Wheels", "category_lvl3" => "Fuel System",
                "sku" => "5412",
                "image_url" => "https://daytonaindonesia.com/uploads/ngc_global_posts/692910602e3fa_20251128100048-1.png",
                "description" => "STABLE, LONGER LIFE. STABIL, UMUR PAKAI LEBIH LAMA. Passed extreme temperature test.",
                "specifications" => ["Flow Rate" => "OEM specification", "Welding" => "USA automatic welding machine"],
                "compatibility" => [["brand" => "Honda", "model" => "Beat Esp"], ["brand" => "Yamaha", "model" => "NMAX 155"]]
            ]
        ];

        foreach ($products as $pData) {
            // 1. Create hierarchy categories
            $lvl1 = Category::firstOrCreate(
                ['slug' => Str::slug($pData['category_lvl1'])],
                ['name' => $pData['category_lvl1']]
            );
            $lvl2 = Category::firstOrCreate(
                ['slug' => Str::slug($pData['category_lvl2'])],
                ['name' => $pData['category_lvl2'], 'parent_id' => $lvl1->id]
            );
            $lvl3 = Category::firstOrCreate(
                ['slug' => Str::slug($pData['category_lvl3'])],
                ['name' => $pData['category_lvl3'], 'parent_id' => $lvl2->id]
            );

            // 2. Download Image
            $imagePath = null;
            try {
                $response = Http::get($pData['image_url']);
                if ($response->successful()) {
                    $ext = pathinfo($pData['image_url'], PATHINFO_EXTENSION) ?: 'jpg';
                    if (strpos($ext, '?') !== false) $ext = explode('?', $ext)[0];
                    $filename = 'products/' . Str::slug($pData['name']) . '-' . time() . '.' . $ext;
                    Storage::disk('public')->put($filename, $response->body());
                    $imagePath = $filename;
                }
            } catch (\Exception $e) { }

            // 3. Create/Update Product
            $product = Product::updateOrCreate(
                ['sku' => $pData['sku']],
                [
                    'category_id' => $lvl3->id,
                    'name' => $pData['name'],
                    'slug' => Str::slug($pData['name']),
                    'description' => $pData['description'],
                    'image_path' => $imagePath ?? 'products/placeholder.jpg',
                ]
            );

            // 4. Create Specifications
            $product->specifications()->delete(); 
            foreach ($pData['specifications'] as $key => $value) {
                ProductSpecification::create([
                    'product_id' => $product->id,
                    'spec_key' => $key,
                    'spec_value' => $value,
                ]);
            }

            // 5. Create/Link Motorcycle Models
            foreach ($pData['compatibility'] as $moto) {
                $model = MotorcycleModel::firstOrCreate([
                    'brand' => $moto['brand'],
                    'model_name' => $moto['model']
                ]);
                if (!$product->motorcycles()->where('motorcycle_id', $model->id)->exists()) {
                    $product->motorcycles()->attach($model->id);
                }
            }
        }
    }
}
