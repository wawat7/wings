<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'code' => 'SKUSKILNP',
                'name' => 'So klin Pewangi',
                'price' => 15000,
                'currency' => 'IDR',
                'discount' => '19',
                'dimension' => '13 cm x 10 cm',
                'unit' => 'PCS'
            ],[
                'code' => strtoupper(Str::random(9)),
                'name' => 'Pilus Garuda',
                'price' => 20000,
                'currency' => 'IDR',
                'discount' => '13',
                'dimension' => '13 cm x 10 cm',
                'unit' => 'PCS'
            ],[
                'code' => strtoupper(Str::random(9)),
                'name' => 'Kopi Kapal Api',
                'price' => 30000,
                'currency' => 'IDR',
                'discount' => '12',
                'dimension' => '13 cm x 10 cm',
                'unit' => 'PCS'
            ],[
                'code' => strtoupper(Str::random(9)),
                'name' => 'Coklat Silver King',
                'price' => 35000,
                'currency' => 'IDR',
                'discount' => '15',
                'dimension' => '13 cm x 10 cm',
                'unit' => 'PCS'
            ]
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
