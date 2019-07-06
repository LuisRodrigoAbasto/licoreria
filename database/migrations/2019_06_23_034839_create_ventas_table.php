<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVentasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ventas', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedinteger('idUsuario');
            $table->unsignedinteger('idCliente');
            $table->datetime('fecha');
            $table->string('descripcion',200)->nullable();
            $table->decimal('monto',20,2);
            $table->boolean('estado')->default(1);
            $table->foreign('idUsuario')->references('id')->on('usuarios');
            $table->foreign('idCliente')->references('id')->on('clientes');
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
        Schema::dropIfExists('ventas');
    }
}
