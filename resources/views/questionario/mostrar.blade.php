@extends('layouts.app')

@section('htmlheader_title')
    Questionário
@stop
        
@section('main-content')
    <br />
    <br/> 
    @if (\Session::has('error'))
        <div class="alert alert-danger">
          <p>{{ \Session::get('error') }}</p>
        </div>
        <br/>
    @endif
    @if (\Session::has('success'))
        <div class="alert alert-success">
        <p>{{ \Session::get('success') }}</p>
        </div>
        <br/>
    @endif
    <h2>Dados do Questionário</h2>
    <p><b>Questionário: {{$questionario->Titulo}}</b></p>
    <p>ID: {{$questionario->QuestionarioID}}</p>
    <p>Introdução: {{$questionario->Introducao}}</p>
    <p>Mensagem de Boas Vindas: {{$questionario->MsgBoasVindas}}</p>
    <p>Indicativo: {{$questionario->Indicativo}}</p>
    <p>Mensagem de Agradecimento: {{$questionario->MsgObrigado}}</p>    
    <br/>
    <a href="{{action('QuestionarioController@Editar', $questionario->QuestionarioID)}}" class="btn btn-warning">Editar</a>                     
    <form class="delete" action="{{action('QuestionarioController@Deletar', $questionario->QuestionarioID)}}" method="post">
        @csrf                

        <button class="btn btn-large btn-primary" type="submit" data-popout="true"
                data-toggle="confirmation"
                data-btn-ok-label="Sim" data-btn-ok-class="btn-success"
                data-btn-ok-icon-class="material-icons" 
                data-btn-cancel-label="Não" data-btn-cancel-class="btn-danger"
                data-btn-cancel-icon-class="material-icons"
                data-title="Confirma a exclusão?">
        Excluir
        </button>                
    </form>
    <br/>
    <br/>
    <p><b>Perguntas do Questionário</b></p>
    <div class="row">
        <div class="col-lg-12">            
            <div class="float-lg-right">
                <a class="btn btn-success" href="{{ route('cadastrarPergunta', ['fk' => $questionario->QuestionarioID])}}">Nova Pergunta</a>
            </div>
        </div>
    </div>
    <table class="table table-striped">
    <thead>
      <tr>
        <th>ID</th>
        <th>Descrição</th>        
        <th colspan="3">Ações</th>
      </tr>
    </thead>
    <tbody>          
      @foreach($perguntas as $pergunta)      
      <tr>
        <td>{{$pergunta->PerguntaID}}</td>
        <td>{{$pergunta->Descricao}}</td>              
        
        <td><a href="{{action('PerguntaController@Editar', $pergunta->PerguntaID)}}" class="btn btn-warning">Editar</a></td>
        <td>
          <form class="delete" action="{{action('PerguntaController@Deletar', $pergunta->PerguntaID)}}" method="post">
            @csrf
            
            <input id="questionarioID" type="hidden" class="form-control" name="questionarioID" value="{{$pergunta->QuestionarioID}}">
            <button class="btn btn-large btn-primary" type="submit" data-popout="true"
                    data-toggle="confirmation"
                    data-btn-ok-label="Sim" data-btn-ok-class="btn-success"
                    data-btn-ok-icon-class="material-icons" 
                    data-btn-cancel-label="Não" data-btn-cancel-class="btn-danger"
                    data-btn-cancel-icon-class="material-icons"
                    data-title="Confirma a exclusão?">
              Excluir
            </button>
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
  <br/>
    <br/>
    <p><b>Respostas do Questionário</b></p>
    <div class="row">
        <div class="col-lg-12">            
            <div class="float-lg-right">
                <a class="btn btn-success" href="{{ route('cadastrarResposta', ['fk' => $questionario->QuestionarioID])}}">Nova Resposta</a>
            </div>
        </div>
    </div>
    <table class="table table-striped">
    <thead>
        <tr>
        <th>ID</th>
        <th>Descrição</th>
        <th>Nível</th>        
        <th colspan="3">Ações</th>
        </tr>
    </thead>
    <tbody>          
        @foreach($respostas as $resposta)      
        <tr>
        <td>{{$resposta->RespostaID}}</td>
        <td>{{$resposta->Descricao}}</td>
        <td>{{$resposta->Nivel}}</td>               
        
        <td><a href="{{action('RespostaController@Editar', $resposta->RespostaID)}}" class="btn btn-warning">Editar</a></td>
        <td>
            <form class="delete" action="{{action('RespostaController@Deletar', $resposta->RespostaID)}}" method="post">
            @csrf
            
            <input id="questionarioID" type="hidden" class="form-control" name="questionarioID" value="{{$resposta->QuestionarioID}}">
            <button class="btn btn-large btn-primary" type="submit" data-popout="true"
                    data-toggle="confirmation"
                    data-btn-ok-label="Sim" data-btn-ok-class="btn-success"
                    data-btn-ok-icon-class="material-icons" 
                    data-btn-cancel-label="Não" data-btn-cancel-class="btn-danger"
                    data-btn-cancel-icon-class="material-icons"
                    data-title="Confirma a exclusão?">
                Excluir
            </button>
            </form>
        </td>
        </tr>
        @endforeach
    </tbody>
    </table>

@stop

@section('scriptadd')
    <!-- <script src="{{ asset('/js/popper-1.14.3.js') }}"></script> -->
    <script src="{{ asset('/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('/bootstrap/js/bootstrap-confirmation.min.js') }}"></script>
    
    <script>
    $('[data-toggle=confirmation]').confirmation({
        rootSelector: '[data-toggle=confirmation]',
        popout: true
    });     
    </script> 
@stop