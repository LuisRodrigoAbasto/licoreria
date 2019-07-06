<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePedidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedinteger('idCliente');
            $table->unsignedinteger('idUbicacion');
            $table->unsignedinteger('idUsuario');
            $table->datetime('fechaPedido');
            $table->datetime('fechaEntrega');
            $table->decimal('monto',20,2);
            $table->boolean('estado')->default(1);
            $table->foreign('idCliente')->references('id')->on('usuarios');
            $table->foreign('idUbicacion')->references('id')->on('ubicaciones');
            $table->foreign('idUsuario')->references('id')->on('usuarios');            
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
        Schema::dropIfExists('pedidos');
    }
}
