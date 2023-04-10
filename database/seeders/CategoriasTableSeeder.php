<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;


class CategoriasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */


     
    public function run()
    {

        DB::table('categorias')->insert([
            [
                'name' => 'Sales',
                'slug' => 'sales',
                'description' => 'Frascos de sal gourmet. Exquisitas variedades .',
                'status' => 1,
                'popular' => 1,
                'image' =>  asset('images/ajo2.png'),
                'meta_title' => 'Frascos de sal',
                'meta_description' => 'Frascos de sal',
                'meta_keywords' => 'Sal, Sal gourmet, Sal premium',
            ],
            [
                'name' => 'Sacos de sal',
                'slug' => 'sacos',
                'description' => 'Sacos de sal sin procesar.',
                'status' => 1,
                'popular' => 1,
                'image' =>  asset('images/saco.png'),
                'meta_title' => 'Sacos de sal',
                'meta_description' => 'Sacos de sal',
                'meta_keywords' => 'Sal, Sal Gourmet, Sacos de sal',
            ],
        ]);
    }
}
