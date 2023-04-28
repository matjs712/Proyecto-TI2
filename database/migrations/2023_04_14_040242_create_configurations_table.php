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
            $table->integer('registros')->default(1);
            $table->integer('ordenes')->default(1);
            $table->integer('usuarios')->default(1);
            $table->integer('roles_permisos')->default(1);
            $table->string('color_principal')->default('#524656');
            $table->string('color_secundario')->default('#e5ddcb');
            $table->string('color_barra_lateral')->default('#343a40');
            $table->string('color_fondo_admin')->default('#ffffff');
            $table->string('color_barra_horizontal')->default('#ffffff');
            $table->string('color_a_tag_sidebar')->default('#ffffff');
            $table->string('color_a_tag_hover')->default('#0e74cd');
            $table->string('color_barra_busqueda')->default('#373737');
            $table->string('texto_banner_uno')->default('Lo mejor en');
            $table->string('texto_banner_dos')->default('Sales Gourmet');
            $table->string('texto_banner_tres')->default('Encuentra las variedades de nuestras exquisitas sales ');
            $table->string('texto_banner_cuatro')->default('Atrevete a darle un sabor unico a tu comida.');
            $table->string('banner')->default(' ');
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
