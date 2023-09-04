<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cat = array('Harinas', 'Cereales', 'Lácteos');

        for ($i = 0; $i < count($cat); $i++) {
            $docType[$i] = new Category();
            $docType[$i]->name = $cat[$i];
            $docType[$i]->save();
        }
    }
}
