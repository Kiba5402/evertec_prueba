<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarroComprasVsProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carro_compras_vs_productos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('codigo_producto');
            $table->foreignId('codigo_carro_compras');
            $table->integer('cantidad_producto');
            $table->enum('estado', ['activo', 'inactivo', 'eliminado'])->default('activo');
            $table->timestamps();

            $table->foreign('codigo_producto')->references('id')->on('productos');
            $table->foreign('codigo_carro_compras')->references('id')->on('carro_compras');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('carro_compras_vs_productos');
    }
}
