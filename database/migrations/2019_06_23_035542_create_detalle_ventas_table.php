<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetalleVentasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_ventas', function (Blueprint $table) {
            $table->unsignedinteger('idVenta');
            $table->unsignedinteger('idProducto');
            $table->decimal('cantidad',20,2);
            $table->decimal('precio',20,2);
            $table->boolean('estado')->default(1);
            $table->primary(['idVenta','idProducto']);
            $table->foreign('idVenta')->references('id')->on('ventas');
            $table->foreign('idProducto')->references('id')->on('productos');
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
        Schema::dropIfExists('detalle_ventas');
    }
}
