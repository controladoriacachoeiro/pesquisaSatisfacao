<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PergResp extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('PergResp', function (Blueprint $table) {
            $table->increments('PergRespID');
            $table->unsignedInteger('ResultadoID');
            $table->unsignedInteger('PerguntaID');
            $table->unsignedInteger('RespostaID');            
            $table->timestamps();
            $table->softDeletes();
            
            $table->foreign('ResultadoID')->references('ResultadoID')->on('Resultados');
            $table->foreign('PerguntaID')->references('PerguntaID')->on('Perguntas');
            $table->foreign('RespostaID')->references('RespostaID')->on('Respostas');
        }); 
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('PergResp');
    }
}
