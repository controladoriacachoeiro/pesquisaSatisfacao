<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use App\Questionario;
use App\Pergunta;
use App\Resposta;

class QuestionarioController extends Controller
{
    public function index()
    {
        $questionarios = Questionario::orderBy('created_at', 'desc')->paginate(10);
        
        return view('questionario.index', compact('questionarios'));
    }

    public function showCadastrar()
    {
        return view('questionario.cadastrar');
    }

    public function Cadastrar(Request $request)
    {
        //Validação
            $regras = [
                'titulo' => 'required|max:200',
                'introducao' => 'required|max:200',
                'msgBoasVindas' => 'required|max:200',
                'msgObrigado' => 'required|max:200',
                'indicativo' => 'required|max:200'
            ];    
            $mensagens = [
                'titulo.required' => 'Título é obrigatório.',
                'titulo.max' => 'Título deve ter até 200 caracteres.',
                'introducao.required' => 'Introdução é obrigatório.',
                'introducao.max' => 'Introdução deve ter até 200 caracteres.',
                'msgBoasVindas.required' => 'Mensagem de Boas Vindas é obrigatório.',
                'msgBoasVindas.max' => 'Mensagem de Boas Vindas deve ter até 200 caracteres.',
                'msgObrigado.required' => 'Mensagem de Agradecimento é obrigatório.',
                'msgObrigado.max' => 'Mensagem de Agradecimento deve ter até 200 caracteres.',
                'indicativo.required' => 'Indicativo é obrigatório.',
                'indicativo.max' => 'Indicativo deve ter até 200 caracteres.'
            ];  

            $validator = Validator::make($request->all(), $regras, $mensagens);
                                
            if ($validator->fails()) {
                return redirect('admin/questionario/cadastrar')
                            ->withErrors($validator)
                            ->withInput();
            }        
        //Fim Validação

        $questionario = new Questionario;
        $questionario->Titulo = $request->titulo;
        $questionario->Introducao = $request->introducao;
        $questionario->MsgObrigado = $request->msgObrigado;
        $questionario->MsgBoasVindas = $request->msgBoasVindas;
        $questionario->Indicativo = $request->indicativo;
        $questionario->save();
        return redirect()->route('questionarioIndex')->with('success', 'Questionario cadastrado com sucesso');
    }

    public function Mostrar($id)
    {
        $questionario = Questionario::where('QuestionarioID', '=', $id);
        $questionario = $questionario->first();

        $perguntas = Pergunta::where('QuestionarioID', '=', $id);
        $perguntas = $perguntas->get(); 
        
        $respostas = Resposta::where('QuestionarioID', '=', $id);
        $respostas = $respostas->get();

        return view('questionario.mostrar', compact('questionario', 'perguntas', 'respostas'));
    }

    public function showEditar($id)
    {
        $questionario = Questionario::where('QuestionarioID', '=', $id);
        $questionario = $questionario->first();
        
        return view('questionario.editar', compact('questionario'));
    }

    public function Editar(Request $request, $id)
    {        
        //Validação
            $regras = [
                'titulo' => 'required|max:200',
                'introducao' => 'required|max:200',
                'msgBoasVindas' => 'required|max:200',
                'msgObrigado' => 'required|max:200',
                'indicativo' => 'required|max:200'
            ];    
            $mensagens = [
                'titulo.required' => 'Título é obrigatório.',
                'titulo.max' => 'Título deve ter até 200 caracteres.',
                'introducao.required' => 'Introdução é obrigatório.',
                'introducao.max' => 'Introdução deve ter até 200 caracteres.',
                'msgBoasVindas.required' => 'Mensagem de Boas Vindas é obrigatório.',
                'msgBoasVindas.max' => 'Mensagem de Boas Vindas deve ter até 200 caracteres.',
                'msgObrigado.required' => 'Mensagem de Agradecimento é obrigatório.',
                'msgObrigado.max' => 'Mensagem de Agradecimento deve ter até 200 caracteres.',
                'indicativo.required' => 'Indicativo é obrigatório.',
                'indicativo.max' => 'Indicativo deve ter até 200 caracteres.'
            ];  

            $validator = Validator::make($request->all(), $regras, $mensagens);
                                
            if ($validator->fails()) {
                return redirect()->route('editarQuestionario', ['id' => $id])
                            ->withErrors($validator);
            }
        //Fim Validação

        $questionario = Questionario::where('QuestionarioID', '=', $id);
        
        $questionario->update(
        ['Titulo' => $request->titulo, 'Introducao' => $request->introducao, 'MsgObrigado' => $request->msgObrigado,
        'MsgBoasVindas' => $request->msgBoasVindas, 'Indicativo' => $request->indicativo]);
                
        
        return redirect()->route('questionarioIndex')->with('success', 'Questionario alterado com sucesso');
    }

    public function Deletar($id)
    {
        try{
            $questionario = Questionario::where('QuestionarioID', '=', $id);
            $questionario->delete();
        }
        catch (\Exception $e) {            
            return redirect()->route('questionarioIndex')->with('error', 'Não foi possível excluir o questionário!');
        }
        
        return redirect()->route('questionarioIndex')->with('success','Questionário deletado com sucesso');
    }

    public function showQuestionario($id)
    {
        $questionario = Questionario::where('QuestionarioID', '=', $id);
        $questionario = $questionario->first();

        $perguntas = Pergunta::where('QuestionarioID', '=', $id);
        $perguntas = $perguntas->get(); 
        
        $respostas = Resposta::where('QuestionarioID', '=', $id)->orderBy('Nivel');
        $respostas = $respostas->get();        

        return view('questionario.pesquisa', compact('questionario', 'perguntas', 'respostas'));
    }
}