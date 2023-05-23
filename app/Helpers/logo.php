<?php

use App\Models\Logo;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Storage;

function logo_sitio()
{
    $logo = Logo::first();
    $path = 'logo/' . $logo->logo;
    View::share('logo', Storage::url($path));
    View::share('sitio', $logo->sitio);

    // ADMIN
    $color_barra_lateral = DB::table('configurations')->select('color_barra_lateral')->first();
    View::share('color_barra_lateral', $color_barra_lateral->color_barra_lateral);

    $color_fondo_admin = DB::table('configurations')->select('color_fondo_admin')->first();
    View::share('color_fondo_admin', $color_fondo_admin->color_fondo_admin);

    $color_barra_horizontal = DB::table('configurations')->select('color_barra_horizontal')->first();
    View::share('color_barra_horizontal', $color_barra_horizontal->color_barra_horizontal);

    $color_a_tag_sidebar = DB::table('configurations')->select('color_a_tag_sidebar')->first();
    View::share('color_a_tag_sidebar', $color_a_tag_sidebar->color_a_tag_sidebar);

    $color_a_tag_hover = DB::table('configurations')->select('color_a_tag_hover')->first();
    View::share('color_a_tag_hover', $color_a_tag_hover->color_a_tag_hover);

    // FRONT
    $color_principal = DB::table('configurations')->select('color_principal')->first();
    View::share('color_principal', $color_principal->color_principal);

    $color_secundario = DB::table('configurations')->select('color_secundario')->first();
    View::share('color_secundario', $color_secundario->color_secundario);

    $color_barra_busqueda = DB::table('configurations')->select('color_barra_busqueda')->first();
    View::share('color_barra_busqueda', $color_barra_busqueda->color_barra_busqueda);
    // BOTONES
    $boton_principal_busqueda = DB::table('configurations')->select('boton_principal_busqueda')->first();
    View::share('boton_principal_busqueda', $boton_principal_busqueda->boton_principal_busqueda);

    $boton_calificacion = DB::table('configurations')->select('boton_calificacion')->first();
    View::share('boton_calificacion', $boton_calificacion->boton_calificacion);

    $boton_review = DB::table('configurations')->select('boton_review')->first();
    View::share('boton_review', $boton_review->boton_review);

    $boton_lista = DB::table('configurations')->select('boton_lista')->first();
    View::share('boton_lista', $boton_lista->boton_lista);

    $boton_carrito = DB::table('configurations')->select('boton_carrito')->first();
    View::share('boton_carrito', $boton_carrito->boton_carrito);

    $boton_nuevo = DB::table('configurations')->select('boton_nuevo')->first();
    View::share('boton_nuevo', $boton_nuevo->boton_nuevo);

    $boton_editar = DB::table('configurations')->select('boton_editar')->first();
    View::share('boton_editar', $boton_editar->boton_editar);

    $boton_eliminar = DB::table('configurations')->select('boton_eliminar')->first();
    View::share('boton_eliminar', $boton_eliminar->boton_eliminar);

    $boton_vermas = DB::table('configurations')->select('boton_vermas')->first();
    View::share('boton_vermas', $boton_vermas->boton_vermas);

    $boton_actualizar = DB::table('configurations')->select('boton_actualizar')->first();
    View::share('boton_actualizar', $boton_actualizar->boton_actualizar);

    $texto_1 = DB::table('configurations')->select('texto_banner_uno')->first();
    View::share('texto_1', $texto_1->texto_banner_uno);
    $texto_2 = DB::table('configurations')->select('texto_banner_dos')->first();
    View::share('texto_2', $texto_2->texto_banner_dos);
    $texto_3 = DB::table('configurations')->select('texto_banner_tres')->first();
    View::share('texto_3', $texto_3->texto_banner_tres);
    $texto_4 = DB::table('configurations')->select('texto_banner_cuatro')->first();
    View::share('texto_4', $texto_4->texto_banner_cuatro);

    $banner = DB::table('configurations')->select('banner')->first();
    $path = 'banner/' . $banner->banner;

    View::share('banner', Storage::url($path));
}
