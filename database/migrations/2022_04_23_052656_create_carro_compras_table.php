<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarroComprasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carro_compras', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->foreignId('codigo_usuario');
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
        Schema::dropIfExists('carro_compras');
    }
}
