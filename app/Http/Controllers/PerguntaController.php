<?php

namespace App\Http\Controllers;

use Validator;
use App\Pergunta;
use App\Auxiliar;
use Illuminate\Http\Request;

class PerguntaController extends Controller
{
    public function showCadastrar($fk)
    {
        if(Auxiliar::VerifResultado($fk)){
            return redirect()->route('mostrarQuestionario', ['id' => $fk])->with('error', 'Questionário já respondido!');
        }        
        return view('pergunta.cadastrar', compact('fk'));
    }

    public function Cadastrar(Request $request, $fk)
    {
        if(Auxiliar::VerifResultado($fk)){
            return redirect()->route('mostrarQuestionario', ['id' => $fk])->with('error', 'Questionário já respondido!');
        }

        //Validação
            $regras = [
                'descricao' => 'required'                            
            ];    
            $mensagens = [                
                'descricao.required' => 'Descrição é obrigatório.'            
            ];   

            $validator = Validator::make($request->all(), $regras, $mensagens);
                                
            if ($validator->fails()) {
                return redirect()->route('cadastrarPergunta', ['fk' => $fk])
                            ->withErrors($validator)
                            ->withInput();
            }
        //Fim Validação

        $pergunta = new Pergunta;
        $pergunta->Descricao = $request->descricao;        
        $pergunta->QuestionarioID = $fk;        
        $pergunta->save();

        return redirect()->route('mostrarQuestionario', ['id' => $fk])->with('success', 'Pergunta cadastrada com sucesso');
    }

    public function showEditar($id)
    {
        $pergunta = Pergunta::where('PerguntaID', '=', $id);
        $pergunta = $pergunta->first();

        if(Auxiliar::VerifResultado($pergunta->QuestionarioID)){
            return redirect()->route('mostrarQuestionario', ['id' => $pergunta->QuestionarioID])->with('error', 'Questionário já respondido!');
        }
        
        return view('pergunta.editar', compact('pergunta'));
    }

    public function Editar(Request $request, $id)
    {
        if(Auxiliar::VerifResultado($request->questionarioID)){
            return redirect()->route('mostrarQuestionario', ['id' => $request->questionarioID])->with('error', 'Questionário já respondido!');
        }

        //Validação
            $regras = [
                'descricao' => 'required'                            
            ];    
            $mensagens = [
                'descricao.required' => 'Descrição é obrigatório.'            
            ];   

            $validator = Validator::make($request->all(), $regras, $mensagens);
    
            if ($validator->fails()) {
                return redirect()->route('editarPergunta', ['id' => $id])
                            ->withErrors($validator);                            
            }
        //Fim Validação

        $pergunta = Pergunta::where('PerguntaID', '=', $id);        
        $pergunta->update(['Descricao' => $request->descricao]);        
                        
        return redirect()->route('mostrarQuestionario', ['id' => $request->questionarioID])->with('success', 'Pergunta alterada com sucesso');
    }

    public function Deletar(Request $request, $id)
    {
        if(Auxiliar::VerifResultado($request->questionarioID)){
            return redirect()->route('mostrarQuestionario', ['id' => $request->questionarioID])->with('error', 'Questionário já respondido!');
        }
        
        try{
            $pergunta = Pergunta::where('PerguntaID', '=', $id);
            $pergunta->delete();
        }
        catch (\Exception $e) {            
            return redirect()->route('mostrarQuestionario', ['id' => $request->questionarioID])->with('error', 'Não foi possível excluir a pergunta!');
        }
        
        return redirect()->route('mostrarQuestionario', ['id' => $request->questionarioID])->with('success','Pergunta excluída com sucesso');
    }
}