<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            [
                'cate_id' => 1,
                'name' => 'Sal de ajo',
                'slug' => 'sal-ajo',
                'description' => 'Exquisita Sal de Ajo, perfecto para condimentar tus comidas.',
                'small_description' => 'Exquisita Sal de Ajo.',
                'original_price' => '2000',
                'selling_price' => '1600',
                'qty' => '4',
                // 'tax' => '18',
                'status' => 1,
                'trending' => 1,
                'image' => 'a',
                // 'meta_title' => 'pantalones',
                // 'meta_description' => 'Pantalones increibles',
                // 'meta_keywords' => 'Pantalones, Pantalones negros, Cargos',
            ],[
                'cate_id' => 1,
                'name' => 'Sal de merken',
                'slug' => 'sal-merken',
                'description' => 'Exquisita Sal de merken, perfecto para condimentar tus comidas.',
                'small_description' => 'Exquisita Sal de merken.',
                'original_price' => '3000',
                'selling_price' => '2600',
                'qty' => '4',
                // 'tax' => '18',
                'status' => 1,
                'trending' => 1,
                'image' => 'a',
                // 'meta_title' => 'pantalones',
                // 'meta_description' => 'Pantalones increibles',
                // 'meta_keywords' => 'Pantalones, Pantalones negros, Cargos',
            ],[
                'cate_id' => 1,
                'name' => 'Sal de mar',
                'slug' => 'sal-mar',
                'description' => 'Exquisita Sal de mar, perfecto para condimentar tus comidas.',
                'small_description' => 'Exquisita Sal de mar.',
                'original_price' => '1600',
                'selling_price' => '1000',
                'qty' => '4',
                // 'tax' => '18',
                'status' => 1,
                'trending' => 1,
                'image' => 'a',
                // 'meta_title' => 'pantalones',
                // 'meta_description' => 'Pantalones increibles',
                // 'meta_keywords' => 'Pantalones, Pantalones negros, Cargos',
            ],
            [
                'cate_id' => 1,
                'name' => 'Sal de merquen',
                'slug' => 'sal-merquen',
                'description' => 'Exquisita Sal de merquen, perfecto para condimentar tus comidas.',
                'small_description' => 'Exquisita Sal de merquen.',
                'original_price' => '4990',
                'selling_price' => '3590',
                'qty' => '2',
                'status' => 1,
                'trending' => 1,
                'image' => 'a',
            ],
        ]);
    }
}
