<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInfoNutricionalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('info_nutricionales', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_producto');
            $table->float('valor_energetico')->nullable()->default(0);
            $table->float('grasa_saturada')->nullable()->default(0);
            $table->float('grasa_total')->nullable()->default(0);
            $table->float('sal')->nullable()->default(0);
            $table->float('yodo')->nullable()->default(0);
            $table->float('azucar')->nullable()->default(0);
            $table->float('proteina')->nullable()->default(0);
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
        Schema::dropIfExists('info_nutricionales');
    }
}