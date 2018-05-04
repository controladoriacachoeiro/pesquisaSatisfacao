<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Questionarios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Questionarios', function (Blueprint $table) {
            $table->increments('QuestionarioID');
            $table->string('Titulo', 200);
            $table->text('Introducao');
            $table->string('MsgBoasVindas', 200);
            $table->string('MsgObrigado', 200);
            $table->string('Indicativo', 200);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('Questionarios');
    }
}