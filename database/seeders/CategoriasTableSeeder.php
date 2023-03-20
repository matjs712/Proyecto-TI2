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
                'name' => 'Pantalones',
                'slug' => 'Pantalones',
                'description' => 'Pantalones de todo tipo y de todas las tallas.',
                'status' => 1,
                'popular' => 0,
                'image' =>  'asd',
                'meta_title' => 'pantalones',
                'meta_description' => 'Pantalones increibles',
                'meta_keywords' => 'Pantalones, Pantalones negros, Cargos',
            ],
        ]);
    }
}
