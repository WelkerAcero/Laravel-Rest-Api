<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sale = new Product();
        $sale->name = 'Avena walker';
        $sale->price = 12000.00;
        $sale->stock = 10;
        $sale->provider_id = 1;
        $sale->category_id = 1;
        $sale->save();
    }
}
