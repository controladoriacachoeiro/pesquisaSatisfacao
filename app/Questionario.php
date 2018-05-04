<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Questionario extends Model
{    
    protected $table = 'Questionarios';
    
    protected $primaryKey = "QuestionarioID";

    protected $fillable = [
        'Titulo', 'Introducao', 'MsgObrigado', 'MsgBoasVindas', 'Indicativo'
    ];
}
