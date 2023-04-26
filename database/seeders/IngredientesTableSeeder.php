<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IngredientesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ingredientes')->insert([
            [
                'name' => 'Sal',
                'cantidad' => 2000,
            ],
            [
                'name' => 'Merquen',
                'cantidad' => 2500,
            ],
            [
                'name' => 'Tomate seco',
                'cantidad' => 3000,
            ],
            [
                'name' => 'Ajo',
                'cantidad' => 1500,
            ],
        ]);
    }
}
