<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now(); 

        // 1. Get Category IDs and Prefixes (Assumes CategorySeeder ran first)
        $categories = DB::table('categories')->pluck('id', 'sku_prefix')->toArray();
        // Example: $categories['FSTNR'] = 1, $categories['ELEC'] = 5, etc.

        // 2. Get Supplier IDs (Assumes SupplierSeeder ran first)
        // We will assign default_supplier_id 1 to all products for simplicity.
        $default_supplier_id = 1;

        $products = [
            // --- FASTENERS (FSTNR - ID 1) ---
            [
                'sku' => 'FSTNR-00001',
                'name' => 'Wood Screw 1 inch (per piece)',
                'description' => 'Flat head wood screws, 1-inch length, zinc coating.',
                'category_id' => $categories['FSTNR'],
                'manufacturer_barcode' => null, // No barcode
                'default_supplier_id' => $default_supplier_id, 
                'price' => 1.50,
                'quantity_in_stock' => 5000,
                'reorder_level' => 1000,
                'last_unit_cost' => 0.75,
            ],
            [
                'sku' => 'FSTNR-00002',
                'name' => 'Hex Bolt M6 x 20mm',
                'description' => 'Standard M6 hexagonal bolt, 20mm length.',
                'category_id' => $categories['FSTNR'],
                'manufacturer_barcode' => null,
                'default_supplier_id' => $default_supplier_id, 
                'price' => 5.00,
                'quantity_in_stock' => 2000,
                'reorder_level' => 500,
                'last_unit_cost' => 2.50,
            ],

            // --- ELECTRICAL (ELEC - ID 5) ---
            [
                'sku' => 'ELEC-00001',
                'name' => 'Electrical Wire 14 AWG (per meter)',
                'description' => 'Solid copper 14 gauge electrical wire, sold by the meter.',
                'category_id' => $categories['ELEC'],
                'manufacturer_barcode' => null, // No barcode
                'default_supplier_id' => $default_supplier_id, 
                'price' => 35.00,
                'quantity_in_stock' => 500, // 500 meters
                'reorder_level' => 100,
                'last_unit_cost' => 18.00,
            ],
            [
                'sku' => 'ELEC-00002',
                'name' => 'Wall Outlet Switch (Single)',
                'description' => 'Basic single gang wall outlet switch, white.',
                'category_id' => $categories['ELEC'],
                'manufacturer_barcode' => null,
                'default_supplier_id' => $default_supplier_id, 
                'price' => 120.00,
                'quantity_in_stock' => 85,
                'reorder_level' => 20,
                'last_unit_cost' => 60.00,
            ],
            
            // --- HAND TOOLS (HNDTL - ID 2) ---
            [
                'sku' => 'HNDTL-00001',
                'name' => 'Measuring Tape 5 Meter',
                'description' => 'Retractable steel measuring tape, 5 meter length.',
                'category_id' => $categories['HNDTL'],
                'manufacturer_barcode' => null,
                'default_supplier_id' => $default_supplier_id, 
                'price' => 250.00,
                'quantity_in_stock' => 40,
                'reorder_level' => 10,
                'last_unit_cost' => 125.00,
            ],
        ];

        // Add timestamps and default fields
        $products = array_map(function ($product) use ($now) {
            $product['image_path'] = null;
            $product['is_active'] = true;
            $product['date_disabled'] = null;
            $product['disabled_by_user_id'] = null;
            $product['created_at'] = $now;
            $product['updated_at'] = $now;
            return $product;
        }, $products);

        DB::table('products')->insert($products);
    }
}
