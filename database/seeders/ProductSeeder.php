<?php

namespace Database\Seeders;

use App\Models\Admin\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       for ($x = 0; $x <= 100; $x++) {
        Product::create([
            'name' => 'product name-'.$x,
            'slug' => Str::random(10),
            'status' => 1,
            'plv1' => 11,
            'plv2' => 12,
            'plv3' => 113,
            'inventory_status' => 0,
            'img_is_default' => mt_rand(7, 12),
            'category_id' => 17,
            'sku' => Str::random(10),
        ]);
    }
    }
}
