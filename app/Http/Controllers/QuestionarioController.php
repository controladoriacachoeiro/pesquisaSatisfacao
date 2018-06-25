<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use App\Questionario;
use App\Pergunta;
use App\Resposta;
use App\PergResp;
use App\Resultado;

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

    //GET
    public function filtroRelatorio($id)
    {
        $questionario = Questionario::where('QuestionarioID', '=', $id);
        $questionario = $questionario->first();        

        return view('questionario.filtrorelatorio', compact('questionario'));
    }

    //POST
    public function Relatorio(Request $request, $id)
    {
        //Validação
            $regras = [
                'dataini' => 'required|max:200',
                'datafim' => 'required|max:200'
            ];
            $mensagens = [
                'dataini.required' => 'Data Inicial é obrigatório.',
                'datafim.required' => 'Data Final é obrigatório.',
                'titulo.max' => 'Título deve ter até 200 caracteres.'
            ];
    
            $validator = Validator::make($request->all(), $regras, $mensagens);
                                
            if ($validator->fails()) {
                return redirect()->route('filtroRelatorio', ['id' => $id])
                            ->withErrors($validator);
            }
        //Fim Validação

        if($request->chkTodos == null){
            $paginacao = 1;
        }else{
            $paginacao = 0;
        }
        

        $dataini = $this->ajeitaDataUrl($request->dataini);
        $datafim = $this->ajeitaDataUrl($request->datafim);

        return redirect()->route('mostrarRelatorio', ['id' => $id, 'paginacao' => $paginacao, 'dataIni' => $dataini, 'dataFim' => $datafim]);
    }

    //GET
    public function MostrarRelatorio($id, $paginacao, $dataIni, $dataFim)
    {               
        $dataini = $this->ajeitaDataUrl2($dataIni);
        $datafim = $this->ajeitaDataUrl2($dataFim);        

        /* 
            select pr.ResultadoID, questionarios.QuestionarioID, resultados.Data,  
            pr.PerguntaID, perguntas.Descricao, pr.RespostaID, respostas.Descricao from pergresp pr
            inner join resultados on pr.ResultadoID = resultados.ResultadoID
            inner join perguntas on pr.PerguntaID = perguntas.PerguntaID
            inner join respostas on pr.RespostaID = respostas.RespostaID
            inner join questionarios on resultados.QuestionarioID = questionarios.QuestionarioID
            ORDER by ResultadoID 
        */

        $dadosDb = PergResp::selectRaw('PergResp.ResultadoID, Questionarios.QuestionarioID, Resultados.Data,
        Perguntas.Descricao as Pergunta, Respostas.Descricao as Resposta')
        ->join('Resultados', 'PergResp.ResultadoID', '=', 'Resultados.ResultadoID')
        ->join('Perguntas', 'PergResp.PerguntaID', '=', 'Perguntas.PerguntaID')
        ->join('Respostas', 'PergResp.RespostaID', '=', 'Respostas.RespostaID')
        ->join('Questionarios', 'Resultados.QuestionarioID', '=', 'Questionarios.QuestionarioID')
        ->where('Questionarios.QuestionarioID', '=', $id)
        ->whereBetween('Resultados.Data', [$dataini, $datafim])
        ->orderBy('Resultados.ResultadoID');
        if($paginacao == 1){
            $dadosDb = $dadosDb->paginate(15);
        }else{
            $dadosDb = $dadosDb->get();
        }        
        
        
        // $perguntas = [];
        // foreach($dadosDb as $item){
        //     $aux = array($item->, )
        // }


        //Quantidade de pesquisas feitas
        $quantResult = Resultado::selectRaw('count(*) as Quantidade')->first();

        $perguntas = PergResp::select('PerguntaID')->distinct()->get();

        if(count($perguntas) > 0){
            $TodosGraficos = [];
            foreach($perguntas as $pergunta){
                $dadosPergunta = PergResp::selectRaw('PergResp.PerguntaID as PerguntaID, Perguntas.Descricao as Pergunta, PergResp.RespostaID as RespostaID,
                                                Respostas.Descricao as Resposta, count(*) as Quantidade')        
                ->join('Perguntas', 'Perguntas.PerguntaID', '=', 'PergResp.PerguntaID')
                ->join('Respostas', 'Respostas.RespostaID', '=', 'PergResp.RespostaID')
                ->where('PergResp.PerguntaID', $pergunta->PerguntaID)            
                ->groupBy('PergResp.PerguntaID', 'PergResp.RespostaID')
                ->orderBy('Respostas.Nivel');
                $dadosPergunta = $dadosPergunta->get();
                
                
                $grafico = [];
                foreach($dadosPergunta as $key => $dado){
                    array_push($grafico, array($dado->Resposta, $dado->Quantidade));
                }                
                array_push($TodosGraficos, array("Pergunta" => $dadosPergunta[0]->Pergunta, "Dados" => $grafico));
            }
        }
        
        
        return view('questionario.relatorio', compact('dadosDb', 'TodosGraficos', 'paginacao'));
    }

    public function ajeitaDataUrl($data){
        $elemento = explode("-", $data);

        $ano = $elemento[0];
        $mes = $elemento[1];
        $dia = $elemento[2];

        $resultado = $dia . "-" . $mes . "-" . $ano;
        
        return $resultado;
    }

    public function ajeitaDataUrl2($data){
        $elemento = explode("-", $data);

        $dia = $elemento[0];
        $mes = $elemento[1];
        $ano = $elemento[2];

        $resultado = $ano . "-" . $mes . "-" . $dia;
        
        return $resultado;
    }
}