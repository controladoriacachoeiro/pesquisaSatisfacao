<?php

namespace App\Http\Controllers;

use App\PergResp;
use App\Resultado;
use App\Questionario;
use Illuminate\Http\Request;

class ResultadoController extends Controller
{

    //POST
    public function Cadastrar(Request $request)
    {
        $resultado = new Resultado;
        $resultado->QuestionarioID = $request->questionarioID;
        $resultado->Data = date("Y-m-d H:i:s");
        $resultado->save();                
        
        //form de pergunta é um array com o seu índice sendo o ID da pergunta e o valor do array é o ID da resposta
        foreach($request->pergunta as $key=>$value)
        {
            $pergResp = new PergResp;
            $pergResp->ResultadoID = $resultado->ResultadoID;
            $pergResp->PerguntaID = $key;
            $pergResp->RespostaID = $value;
            $pergResp->save();
        }        
        
        $questionario = Questionario::select('QuestionarioID', 'msgObrigado')->where('QuestionarioID', '=', $resultado->QuestionarioID)->first();
        
        return view('questionario.agradecimento', compact('questionario'));
    }
}