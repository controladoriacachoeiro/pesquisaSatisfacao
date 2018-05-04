<?php

namespace App\Http\Controllers;

use Validator;
use App\Resposta;
use App\Auxiliar;
use Illuminate\Http\Request;

class RespostaController extends Controller
{
    public function showCadastrar($fk)
    {  
        if(Auxiliar::VerifResultado($fk)){
            return redirect()->route('mostrarQuestionario', ['id' => $fk])->with('error', 'Questionário já respondido!');
        }

        return view('resposta.cadastrar', compact('fk'));
    }

    public function Cadastrar(Request $request, $fk)
    {
        if(Auxiliar::VerifResultado($fk)){
            return redirect()->route('mostrarQuestionario', ['id' => $fk])->with('error', 'Questionário já respondido!');
        }

        //Validação
            $regras = [
                'descricao' => 'required|max:100',
                'nivel' => 'required|numeric|min:1|max:10'                
            ];
            $mensagens = [
                'descricao.required' => 'Descrição é obrigatório.',
                'descricao.max' => 'Descrição deve ter até 100 caracteres.',
                'nivel.required' => 'Nível é obrigatório.',
                'nivel.numeric' => 'Nível deve ser um número entre 1 e 10.',
                'nivel.max' => 'Nível deve ser um número entre 1 e 10.',
                'nivel.min' => 'Nível deve ser um número entre 1 e 10.'
            ];

            $validator = Validator::make($request->all(), $regras, $mensagens);            

            if ($validator->fails()) {
                return redirect()->route('cadastrarResposta', ['fk' => $fk])                            
                            ->withErrors($validator)
                            ->withInput();
            }

            //Verifica se número do nível já está cadastrado
            $auxiliar = Resposta::where('QuestionarioID', '=', $fk)->where('Nivel', '=', $request->nivel)->first();
            if(!empty($auxiliar)){
                return redirect()->route('cadastrarResposta', ['fk' => $fk])
                            ->with('erronivel', 'Nível já existente')
                            ->withErrors($validator)
                            ->withInput();
            }
        //Fim Validação

        $resposta = new Resposta;
        $resposta->Descricao = $request->descricao;
        $resposta->Nivel = $request->nivel;
        $resposta->QuestionarioID = $fk;
        $resposta->save();

        return redirect()->route('mostrarQuestionario', ['id' => $fk])->with('success', 'Resposta cadastrada com sucesso');         
    }   

    public function showEditar($id)
    {
        $resposta = Resposta::where('RespostaID', '=', $id);
        $resposta = $resposta->first();

        if(Auxiliar::VerifResultado($resposta->QuestionarioID)){
            return redirect()->route('mostrarQuestionario', ['id' => $resposta->QuestionarioID])->with('error', 'Questionário já respondido!');
        }

        return view('resposta.editar', compact('resposta'));
    }

    public function Editar(Request $request, $id)
    {    
        if(Auxiliar::VerifResultado($request->questionarioID)){
            return redirect()->route('mostrarQuestionario', ['id' => $request->questionarioID])->with('error', 'Questionário já respondido!');
        }

        //Validação
            $regras = [
                'descricao' => 'required|max:100',
                'nivel' => 'required|numeric|min:1|max:10'                
            ];
            $mensagens = [
                'descricao.required' => 'Descrição é obrigatório.',
                'descricao.max' => 'Descrição deve ter até 100 caracteres.',
                'nivel.required' => 'Nível é obrigatório.',
                'nivel.numeric' => 'Nível deve ser um número entre 1 e 10.',
                'nivel.max' => 'Nível deve ser um número entre 1 e 10.',
                'nivel.min' => 'Nível deve ser um número entre 1 e 10.'
            ];

            $validator = Validator::make($request->all(), $regras, $mensagens);            

            if ($validator->fails()) {
                return redirect()->route('editarResposta', ['id' => $id])                            
                            ->withErrors($validator)
                            ->withInput();
            }

            //Verifica se número do nível já está cadastrado
            $auxiliar = Resposta::where('QuestionarioID', '=', $request->questionarioID)->where('Nivel', '=', $request->nivel)->where('RespostaID', '!=', $id)->first();
            if(!empty($auxiliar)){
                return redirect()->route('editarResposta', ['id' => $id])
                            ->with('erronivel', 'Nível já existente')
                            ->withErrors($validator)
                            ->withInput();
            }
        //Fim Validação

        $resposta = Resposta::where('RespostaID', '=', $id);
        $resposta->update(['Descricao' => $request->descricao,
                           'Nivel' => $request->nivel]);
                        
        return redirect()->route('mostrarQuestionario', ['id' => $request->questionarioID])->with('success', 'Resposta alterada com sucesso');
    }

    public function Deletar(Request $request, $id)
    {
        if(Auxiliar::VerifResultado($request->questionarioID)){
            return redirect()->route('mostrarQuestionario', ['id' => $request->questionarioID])->with('error', 'Questionário já respondido!');
        }

        try{
            $resposta = Resposta::where('RespostaID', '=', $id);
            $resposta->delete();
        }
        catch (\Exception $e) {            
            return redirect()->route('mostrarQuestionario', ['id' => $request->questionarioID])->with('error', 'Não foi possível excluir a resposta!');
        }
        
        return redirect()->route('mostrarQuestionario', ['id' => $request->questionarioID])->with('success','Resposta excluída com sucesso');
    }
}
