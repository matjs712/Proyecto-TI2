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
                'qty' => '2',
                'status' => 1,
                'trending' => 1,
                'image' => 'sal2.png',
            ], [
                'cate_id' => 1,
                'name' => 'Sal de merken',
                'slug' => 'sal-merken',
                'description' => 'Exquisita Sal de merken, perfecto para condimentar tus comidas.',
                'small_description' => 'Exquisita Sal de merken.',
                'original_price' => '3000',
                'selling_price' => '2600',
                'qty' => '4',
                'status' => 1,
                'trending' => 0,
                'image' => 'sal2.png',
            ], [
                'cate_id' => 1,
                'name' => 'Sal de tomate',
                'slug' => 'sal-tomate',
                'description' => 'Exquisita Sal de tomate, perfecto para condimentar tus comidas.',
                'small_description' => 'Exquisita Sal de mar.',
                'original_price' => '1600',
                'selling_price' => '1000',
                'qty' => '4',
                'status' => 1,
                'trending' => 1,
                'image' => 'sal-tomate.png',
            ], [
                'cate_id' => 1,
                'name' => 'Sal de tomate',
                'slug' => 'sal-tomate',
                'description' => 'Exquisita Sal de tomate, perfecto para condimentar tus comidas.',
                'small_description' => 'Exquisita Sal de mar.',
                'original_price' => '1600',
                'selling_price' => '1000',
                'qty' => '4',
                'status' => 1,
                'trending' => 1,
                'image' => 'sal-tomate.png',
            ], [
                'cate_id' => 1,
                'name' => 'Sal de tomate',
                'slug' => 'sal-tomate',
                'description' => 'Exquisita Sal de tomate, perfecto para condimentar tus comidas.',
                'small_description' => 'Exquisita Sal de mar.',
                'original_price' => '1600',
                'selling_price' => '1000',
                'qty' => '4',
                'status' => 1,
                'trending' => 1,
                'image' => 'sal-tomate.png',
            ], [
                'cate_id' => 1,
                'name' => 'Sal de tomate',
                'slug' => 'sal-tomate',
                'description' => 'Exquisita Sal de tomate, perfecto para condimentar tus comidas.',
                'small_description' => 'Exquisita Sal de mar.',
                'original_price' => '1600',
                'selling_price' => '1000',
                'qty' => '4',
                'status' => 1,
                'trending' => 1,
                'image' => 'sal-tomate.png',
            ], [
                'cate_id' => 1,
                'name' => 'Sal de tomate',
                'slug' => 'sal-tomate',
                'description' => 'Exquisita Sal de tomate, perfecto para condimentar tus comidas.',
                'small_description' => 'Exquisita Sal de mar.',
                'original_price' => '1600',
                'selling_price' => '1000',
                'qty' => '4',
                'status' => 1,
                'trending' => 1,
                'image' => 'sal-tomate.png',
            ], [
                'cate_id' => 1,
                'name' => 'Sal de tomate',
                'slug' => 'sal-tomate',
                'description' => 'Exquisita Sal de tomate, perfecto para condimentar tus comidas.',
                'small_description' => 'Exquisita Sal de mar.',
                'original_price' => '1600',
                'selling_price' => '1000',
                'qty' => '4',
                'status' => 1,
                'trending' => 1,
                'image' => 'sal-tomate.png',
            ], [
                'cate_id' => 1,
                'name' => 'Sal de tomate',
                'slug' => 'sal-tomate',
                'description' => 'Exquisita Sal de tomate, perfecto para condimentar tus comidas.',
                'small_description' => 'Exquisita Sal de mar.',
                'original_price' => '1600',
                'selling_price' => '1000',
                'qty' => '4',
                'status' => 1,
                'trending' => 1,
                'image' => 'sal-tomate.png',
            ], [
                'cate_id' => 1,
                'name' => 'Sal de tomate',
                'slug' => 'sal-tomate',
                'description' => 'Exquisita Sal de tomate, perfecto para condimentar tus comidas.',
                'small_description' => 'Exquisita Sal de mar.',
                'original_price' => '1600',
                'selling_price' => '1000',
                'qty' => '4',
                'status' => 1,
                'trending' => 1,
                'image' => 'sal-tomate.png',
            ], [
                'cate_id' => 1,
                'name' => 'Sal de tomate',
                'slug' => 'sal-tomate',
                'description' => 'Exquisita Sal de tomate, perfecto para condimentar tus comidas.',
                'small_description' => 'Exquisita Sal de mar.',
                'original_price' => '1600',
                'selling_price' => '1000',
                'qty' => '4',
                'status' => 1,
                'trending' => 1,
                'image' => 'sal-tomate.png',
            ]
        ]);
    }
}
