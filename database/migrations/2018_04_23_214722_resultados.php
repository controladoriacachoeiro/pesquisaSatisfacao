<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Resultados extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Resultados', function (Blueprint $table) {
            $table->increments('ResultadoID');
            $table->unsignedInteger('QuestionarioID');
            $table->dateTime('Data');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('QuestionarioID')->references('QuestionarioID')->on('Questionarios');
        }); 
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('Resultados');
    }
}