<?php

namespace App;

use App\Resultado;

class Auxiliar
{
    public static function VerifResultado($questionarioID)
    {
        if(empty(Resultado::where('QuestionarioID', '=', $questionarioID)->first()))
        {
            return false;
        }else{
            return true;
        }
    }
}