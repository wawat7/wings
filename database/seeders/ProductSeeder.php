<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([
            'code' => 'SKUSKILNP',
            'name' => 'So klin Pewangi',
            'price' => 15000,
            'currency' => 'IDR',
            'discount' => '10',
            'dimension' => '13 cm x 10 cm',
            'unit' => 'PCS'
        ]);
    }
}
