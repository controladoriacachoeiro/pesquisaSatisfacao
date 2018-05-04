<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Respostas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Respostas', function (Blueprint $table) {
            $table->increments('RespostaID');
            $table->unsignedInteger('QuestionarioID');
            $table->string('Descricao', 100);
            $table->integer('Nivel');
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
        Schema::drop('Respostas');
    }
}
