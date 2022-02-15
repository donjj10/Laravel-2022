<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('products')->truncate();

        Product::create(['name' => 'shoes', 'price' => 15000.0, 'quantity' => 5]);
        Product::create(['name' => 'shirts', 'price' => 12000.0, 'quantity' => 8]);
        Product::create(['name' => 'shorts', 'price' => 8000.0, 'quantity' => 10]);




    }
}
