<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdenVsProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orden_vs_productos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('codigo_producto');
            $table->foreignId('codigo_orden');
            $table->integer('cantidad_producto');
            $table->enum('estado', ['activo', 'inactivo', 'eliminado'])->default('activo');
            $table->timestamps();

            $table->foreign('codigo_producto')->references('id')->on('productos');
            $table->foreign('codigo_orden')->references('id')->on('ordenes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orden_vs_productos');
    }
}
