<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Configuration extends Model
{
    use HasFactory;
    protected $table = 'configurations';
    protected $fillable = [
        'productos',
        'ingredientes',
        'categorias',
        'proveedores',
        'registros',
        'ordenes',
        'usuarios',
        'roles_permisos',
        'color_principal',
        'color_secundario',
        'color_barra_lateral',
        'color_fondo_admin',
        'color_barra_horizontal',
        'color_a_tag_sidebar',
        'color_a_tag_hover',
        'color_barra_busqueda',
        'texto_banner_uno',
        'texto_banner_dos',
        'texto_banner_tres',
        'texto_banner_cuatro',
        'boton_principal_busqueda',
        'boton_calificacion',
        'boton_review',
        'boton_lista',
        'boton_carrito',
        'boton_nuevo',
        'boton_editar',
        'boton_eliminar',
        'boton_vermas',
        'boton_actualizar',
        'banner',
        //SECCION OFERTA
        'habilitar_oferta',
        'imagen_oferta',
        'titulo_oferta',
        'subtitulo_oferta',
        'texto_oferta',
        'valor_oferta',
        'fecha_oferta',
        //SECCION SOBRE NOSOTROS
        'titulo_sobre_nosotros',
        'texto_1_sobre_nosotros',
        'texto_2_sobre_nosotros',
        'titulo_texto_3_sobre_nosotros',
        'texto_3_sobre_nosotros',
        'titulo_texto_4_sobre_nosotros',
        'texto_4_sobre_nosotros',
        'imagen_sobre_nosotros',
        'titulo_historia',
        'imagen_fondo_historia',
        'texto_1_historia',
        'texto_2_historia',
        'texto_3_historia',
        'imagen_texto_historia',
    ];
}
