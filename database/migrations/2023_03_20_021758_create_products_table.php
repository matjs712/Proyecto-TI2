<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('cate_id');
            $table->string('name');
            $table->string('slug');
            $table->mediumText('small_description');
            $table->longText('description');
            $table->decimal('original_price', 8, 2);
            $table->decimal('selling_price', 8, 2);
            $table->string('image')->nullable();
            $table->string('qty');
            // $table->string('tax');
            $table->tinyInteger('status');
            $table->tinyInteger('trending');
            // $table->mediumText('meta_title');
            // $table->mediumText('meta_keywords');
            // $table->mediumText('meta_description');
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
        Schema::dropIfExists('products');
    }
}
