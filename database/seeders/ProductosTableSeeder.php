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
                'trending' => 0,
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
                'trending' => 0,
                'image' => 'a',
                // 'meta_title' => 'pantalones',
                // 'meta_description' => 'Pantalones increibles',
                // 'meta_keywords' => 'Pantalones, Pantalones negros, Cargos',
            ],
            [
                'cate_id' => 1,
                'name' => 'Sal de limon',
                'slug' => 'sal-limon',
                'description' => 'Exquisita Sal de limon, perfecto para condimentar tus comidas.',
                'small_description' => 'Exquisita Sal de limon.',
                'original_price' => '2400',
                'selling_price' => '2000',
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
                'name' => 'Sal de romero',
                'slug' => 'sal-romer',
                'description' => 'Exquisita Sal de romero, perfecto para condimentar tus comidas.',
                'small_description' => 'Exquisita Sal de romero.',
                'original_price' => '3200',
                'selling_price' => '2900',
                'qty' => '4',
                // 'tax' => '18',
                'status' => 1,
                'trending' => 0,
                'image' => 'a',
                // 'meta_title' => 'pantalones',
                // 'meta_description' => 'Pantalones increibles',
                // 'meta_keywords' => 'Pantalones, Pantalones negros, Cargos',
            ]
        ]);
    }
}
