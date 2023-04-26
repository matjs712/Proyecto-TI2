<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\RoleSeeder;
use Database\Seeders\LogosTableSeeder;
use Database\Seeders\UsersTableSeeder;
use Database\Seeders\ConfigurationSeeder;
use Database\Seeders\ProductosTableSeeder;
use Database\Seeders\RegistrosTableSeeder;
use Database\Seeders\CategoriasTableSeeder;
use Database\Seeders\ProductosIngredientes;
use Database\Seeders\ProveedoresTableSeeder;
use Database\Seeders\IngredientesTableSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(ProveedoresTableSeeder::class);
        $this->call(CategoriasTableSeeder::class);
        $this->call(IngredientesTableSeeder::class);
        $this->call(RegistrosTableSeeder::class);
        $this->call(ProductosTableSeeder::class);
        $this->call(ProductosIngredientes::class);
        $this->call(LogosTableSeeder::class);
        $this->call(ConfigurationSeeder::class);
    }
}
