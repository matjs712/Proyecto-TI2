<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
                'name' => 'Polera Black',
                'slug' => 'Polera-Black',
                'description' => 'Increible polera deseñada con las mejor tela del mundo.',
                'small_description' => 'Increible polera.',
                'original_price' => '18999',
                'selling_price' => '16999',
                'qty' => '4',
                'tax' => '18',
                'status' => 1,
                'trending' => 0,
                'image' =>  'asd',
                'meta_title' => 'pantalones',
                'meta_description' => 'Pantalones increibles',
                'meta_keywords' => 'Pantalones, Pantalones negros, Cargos',
            ],
        ]);
    }
}
