<?php

namespace Database\Seeders;

use App\Models\Sale;
use Illuminate\Database\Seeder;

class SaleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sale = new Sale();
        $sale->sale_code = 'QPGCTPXM0OII';
        $sale->user_id = 1;
        $sale->customer_id = 1;
        $sale->save();
    }
}
