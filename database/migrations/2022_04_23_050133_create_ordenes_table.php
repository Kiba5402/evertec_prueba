<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdenesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ordenes', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('referencia')->unique();
            $table->foreignId('codigo_usuario');
            $table->string('customer_name', 80);
            $table->string('customer_email', 80);
            $table->string('customer_mobile', 40);
            $table->enum('status', ['created', 'payed', 'rejected'])->default('created');
            $table->enum('estado', ['activo', 'inactivo', 'eliminado'])->default('activo');
            $table->integer('registro_usuario');
            $table->integer('registro_usuario_actualizacion')->nullable();
            $table->timestamps();

            $table->foreign('codigo_usuario')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ordenes');
    }
}
