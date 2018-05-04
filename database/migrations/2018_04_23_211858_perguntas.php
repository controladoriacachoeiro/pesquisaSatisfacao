<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Perguntas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Perguntas', function (Blueprint $table) {
            $table->increments('PerguntaID');
            $table->unsignedInteger('QuestionarioID');
            $table->text('Descricao');                        
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('QuestionarioID')->references('QuestionarioID')->on('Questionarios')->onDelete('cascade');
        });        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('Perguntas');
    }
}
