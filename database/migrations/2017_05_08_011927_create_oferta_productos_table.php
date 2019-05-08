<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOfertaProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('oferta_productos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('oferta_id')->unsigned();
            $table->integer('producto_id')->unsigned();
            $table->foreign('oferta_id')->references('id')->on('ofertas');
            $table->foreign('producto_id')->references('id')->on('productos');
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
        Schema::dropIfExists('oferta_productos');
    }
}
