<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConfigurationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('configurations', function (Blueprint $table) {
            $table->id();
            $table->integer('productos')->default(1);
            $table->integer('ingredientes')->default(1);
            $table->integer('categorias')->default(1);
            $table->integer('proveedores')->default(1);
            $table->integer('recetas')->default(1);
            $table->integer('nutricionales')->default(1);
            $table->integer('registros')->default(1);
            $table->integer('ordenes')->default(1);
            $table->integer('usuarios')->default(1);
            $table->integer('seguimiento')->default(1);
            $table->integer('roles_permisos')->default(1);
            $table->string('color_principal');
            $table->string('color_secundario');
            $table->string('color_barra_lateral');
            $table->string('color_fondo_admin');
            $table->string('color_barra_horizontal');
            $table->string('color_a_tag_sidebar');
            $table->string('color_a_tag_hover');
            $table->string('color_barra_busqueda');
            $table->string('texto_banner_uno');
            $table->string('texto_banner_dos');
            $table->string('texto_banner_tres');
            $table->string('texto_banner_cuatro');

            $table->string('boton_principal_busqueda');
            $table->string('boton_calificacion');
            $table->string('boton_review');
            $table->string('boton_lista');
            $table->string('boton_carrito');
            $table->string('boton_nuevo');
            $table->string('boton_editar');
            $table->string('boton_eliminar');
            $table->string('boton_vermas');
            $table->string('boton_actualizar');


            $table->string('banner');

            $table->integer('habilitar_oferta')->default(1);
            $table->string('imagen_oferta');
            $table->string('titulo_oferta');
            $table->string('subtitulo_oferta');
            $table->string('texto_oferta');
            $table->string('valor_oferta');
            $table->datetime('fecha_oferta');


            $table->string('titulo_sobre_nosotros');
            $table->longText('texto_1_sobre_nosotros');
            $table->longText('texto_2_sobre_nosotros');
            $table->string('titulo_texto_3_sobre_nosotros');
            $table->longText('texto_3_sobre_nosotros');
            $table->string('titulo_texto_4_sobre_nosotros');
            $table->longText('texto_4_sobre_nosotros');
            $table->string('imagen_sobre_nosotros');
            $table->string('titulo_historia');
            $table->string('imagen_fondo_historia');
            $table->longText('texto_1_historia');
            $table->longText('texto_2_historia');
            $table->longText('texto_3_historia');
            $table->string('imagen_texto_historia');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('configurations');
    }
}