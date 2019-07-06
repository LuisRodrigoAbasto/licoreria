<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre',50);
            $table->string('apellido',50);
            $table->string('sexo',10);
            $table->string('telefono',10);
            $table->string('ci',10);
            $table->string('email',50);
            $table->string('password',50);
            $table->integer('tipo');
            $table->boolean('estado')->default(1);
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
        Schema::dropIfExists('usuarios');
    }
}
