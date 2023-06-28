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
                'banner' => 'banner.jpg',
                'habilitar_oferta' => 1,
                'imagen_oferta' => 'popup.jpg',
                'titulo_oferta' => 'Ofertas de apertura',
                'subtitulo_oferta' => 'Cantidades limitadas.',
                'texto_oferta' => 'Descuentos en todos los productos!! ',
                'valor_oferta' => '30',
                'fecha_oferta' => '2023-12-24',
                'titulo_sobre_nosotros' => 'Bienvenido a De Sabelle',
                'texto_1_sobre_nosotros' => 'Tempor erat elitr rebum clita. Diam dolor diam ipsum erat lorem sed stet labore lorem sit clita duo',
                'texto_2_sobre_nosotros' => 'Tempor erat elitr at rebum at at clita. Diam dolor diam ipsum et tempor sit. Clita erat ipsum et lorem et sit, sed stet no labore lorem sit. Sanctus clita duo justo et tempor eirmod magna dolore erat amet magna',
                'titulo_texto_3_sobre_nosotros' => '100% Healthy',
                'texto_3_sobre_nosotros' => 'Labore justo vero ipsum sit clita erat lorem magna clita nonumy dolor magna dolor vero',
                'titulo_texto_4_sobre_nosotros' => 'Award Winning',
                'texto_4_sobre_nosotros' => 'Labore justo vero ipsum sit clita erat lorem magna clita nonumy dolor magna dolor vero',
                'imagen_sobre_nosotros' => 'aboutUs.jpg',
                'titulo_historia' => 'Hace 5 años...',
                'imagen_fondo_historia' => 'background_history.jpg',
                'texto_1_historia' => 'Tempor erat elitr rebum clita. Diam dolor diam ipsum erat lorem sed stet labore lorem sit clita duo',
                'texto_2_historia' => 'Tempor erat elitr at rebum at at clita. Diam dolor diam ipsum et tempor sit. Clita erat ipsum et lorem et sit, sed stet no labore lorem sit. Sanctus clita duo justo et tempor eirmod magna dolore erat amet magna Lorem ipsum dolor sit amet consectetur, adipisicing elit. Praesentium molestias quo autem fuga cupiditate ea ab qui sed accusantium tempore?',
                'texto_3_historia' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Deleniti voluptatibus temporibus voluptates excepturi pariatur consectetur soluta. Alias placeat a excepturi repellendus at rerum hic corrupti illum distinctio officiis, dignissimos voluptatibus ipsa cupiditate consequatur, autem fugit dolor omnis possimus corporis. Cumque placeat iusto eveniet, corporis vero blanditiis dolorem. Fugit, ullam?',
                'imagen_texto_historia' => 'texto_historia.jpg',

            ]
        ]);
    }
}
