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
                'image' => '1685480330.jpg',
            ],
            [
                'name' => 'Sacos',
                'slug' => 'sacos',
                'description' => 'Sacos de sal.',
                'status' => 1,
                'popular' => 1,
                'image' =>  '1685484259.jpg'
            ]
        ]);
    }
}
