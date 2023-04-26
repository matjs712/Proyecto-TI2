<?php
use App\Models\Logo;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

function logo_sitio(){
    $logo = Logo::first();
    $path = 'logo/'.$logo->logo;
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


}