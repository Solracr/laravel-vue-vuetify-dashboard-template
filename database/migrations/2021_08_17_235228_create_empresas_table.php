<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpresasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empresas', function (Blueprint $table) {
            $table->id();
            $table->string('nit');
            $table->string('razonSocial');
            $table->text('domicilio');
            $table->string('tipoEntidad');
            $table->integer('cantidadTrabajadores');
            $table->string('telefono');
            $table->string('correo');
            $table->string('direccionNotificaciones');
            $table->string('actividadEconomica');


            $table->string('nitRepresentante');
            $table->string('primerNombreRepresentante');
            $table->string('otrosNombresRepresentante');
            $table->string('primerApellidoRepresentante');
            $table->string('segundoApellidoRepresentante');
            $table->string('cargo');
            $table->string('nacionalidad')->nullable();
            

            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');

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
        Schema::dropIfExists('empresas');
    }
}
