<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDatosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('datos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('parentesco');
            $table->string('celular');
            $table->string('fecha');
            $table->string('fiebre');
            $table->string('tos');
            $table->string('fatiga');
            $table->string('congestion');
            $table->string('muscular');
            $table->string('garganta');
            $table->string('cafe');
            $table->string('nauseas');
            $table->string('diarrea');
            $table->string('escalofrios');
            $table->string('respiratoria');
            $table->string('otros');
            $table->string('a');
            $table->string('b');
            $table->string('c');
            $table->string('enfermedad');
            $table->string('embarazo');
            $table->string('inmunodepresion');
            $table->string('dano');
            $table->string('insuficiencia');
            $table->string('otros2');
            $table->string('caso');
            $table->string('casono');
            $table->string('observaciones');
            $table->unsignedBigInteger('caso_id');
            $table->foreign('caso_id')->references('id')->on('casos');
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
        Schema::dropIfExists('datos');
    }
}
