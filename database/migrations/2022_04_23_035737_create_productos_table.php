<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('nombre', '150');
            $table->string('descripcion', '250');
            $table->decimal('valor', 30, 3)->nullable();
            $table->enum('estado', ['activo', 'inactivo', 'eliminado'])->default('activo');
            $table->integer('registro_usuario');
            $table->integer('registro_usuario_actualizacion')->nullable();
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
        Schema::dropIfExists('productos');
    }
}
