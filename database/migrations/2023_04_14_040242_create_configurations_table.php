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
