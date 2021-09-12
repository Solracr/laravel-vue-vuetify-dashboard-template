<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSolicitudsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solicituds', function (Blueprint $table) {
                        
            $table->id();
            $table->string('primerNombre');
            $table->string('otrosNombres')->nullable();
            $table->string('primerApellido');
            $table->string('otrosApellidos')->nullable();
            $table->string('apellidoCasada')->nullable();
            $table->integer('numeroTelefono');
            $table->dateTime('fechaNacimiento', $precision = 0);
            $table->string('nacionalidad');
            $table->string('genero');
            $table->string('estadoCivil');
            $table->string('documentoIdentificacion');            
            $table->bigInteger('numeroDocumento');
            $table->string('direccion');
            $table->integer('departamento');
            $table->integer('municipio');            
            $table->string('correoElectronico');
            $table->text('profesion')->nullable();
                        
            $table->string('nivelEstudio');
            $table->text('especificarCarrera');
            $table->string('experiencia');            
            $table->string('ocupacion');            
            $table->text('idiomas');
            $table->text('observaciones');

            $table->string('nombrePlaza')->nullable();
            $table->text('perfilPlaza')->nullable();
            $table->string('funcionesGenerales')->nullable();
            $table->string('periodicidadPago')->nullable();;           
            $table->unsignedDecimal('montoPago', $precision = 8, $scale = 2)->nullable();
            


            //SITUACION MIGRATORIA
            $table->string('situacionMigratoria')->nullable();
            $table->integer('expedienteMigracion')->nullable();
            $table->integer('llaveMigracion')->nullable();
                        
            //INFORMACION FAMILIAR
            $table->string('tipoParentesco')->nullable();
            $table->string('partida')->nullable();
            $table->string('folio')->nullable();
            $table->string('libro')->nullable();
            $table->string('certificadoCui')->nullable();
            $table->string('exp1')->nullable();
            $table->string('status')->nullable();

            
            $table->string('tipo1');
            $table->string('tipo2');            
            $table->string('periodo');            
            $table->string('expediente')->nullable();
            $table->string('qr')->nullable();
            
            $table->integer('codigoEmpresa')->nullable();

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
        Schema::dropIfExists('solicituds');
    }
}
