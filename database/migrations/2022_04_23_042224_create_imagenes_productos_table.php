<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImagenesProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('imagenes_productos', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->foreignId('codigo_producto');  
            $table->text('url');
            $table->enum('estado', ['activo', 'inactivo', 'eliminado'])->default('activo');
            $table->integer('registro_usuario');
            $table->integer('registro_usuario_actualizacion')->nullable();
            $table->timestamps();

            $table->foreign('codigo_producto')->references('id')->on('productos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('imagenes_productos');
    }
}
