<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConfigurationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('configurations')->insert([
            [
                'color_principal' => '#ffffff',
                'color_secundario' => '#088178',
                'color_barra_lateral' => '#343838',
                'color_fondo_admin' => '#ffffff',
                'color_barra_horizontal' => '#ffffff',
                'color_a_tag_sidebar' => '#ffffff',
                'color_a_tag_hover' => '#008C9E',
                'color_barra_busqueda' => '#ffffff',
                'texto_banner_uno' => 'Lo mejor en',
                'texto_banner_dos' => 'Sales Gourmet',
                'texto_banner_tres' => 'Encuentra las variedades de nuestras exquisitas sales',
                'texto_banner_cuatro' => 'Atrévete a darle un sabor único a tu comida.',
                'boton_principal_busqueda' => '#EF2B41',
                'boton_calificacion' => '#F9BF76',
                'boton_review' => '#8EB2C5',
                'boton_lista' => '#615375',
                'boton_carrito' => '#EF2B41',
                'boton_nuevo' => '#00B4CC',
                'boton_editar' => '#F2A73D',
                'boton_eliminar' => '#C22047',
                'boton_vermas' => '#758918',
                'boton_actualizar' => '#F2A73D',
                'productos' => 1,
                'ingredientes' => 1,
                'categorias' => 1,
                'proveedores' => 1,
                'registros' => 1,
                'ordenes' => 1,
                'usuarios' => 1,
                'roles_permisos' => 1,
                'banner' => 'banner.jpg'
            ]
        ]);
    }
}
