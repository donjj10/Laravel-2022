<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Discount;

class DiscountTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('discounts')->truncate();

        Discount::create(['name' => 'coupon', 'value' => 0.2]);
        Discount::create(['name' => 'discount', 'value' => 0.05]);
        Discount::create(['name' => 'loyalty', 'value' => 2500.0]);
        

    }
}
