@extends('layouts.app')

@section('htmlheader_title')
    Questionários
@stop

@section('main-content')
    <br/> 
    @if (\Session::has('error'))
        <div class="alert alert-danger">
          <p>{{ \Session::get('error') }}</p>
        </div>
        <br/>
    @endif
    <h2>Lista de Questionários</h2>
    <div class="row">
        <div class="col-lg-12">            
            <div class="float-lg-right">
                <a class="btn btn-success" href="{{ url('/admin/questionario/cadastrar') }}">Cadastrar Novo</a>
            </div>
        </div>
    </div>
    <br />
    @if (\Session::has('success'))
      <div class="alert alert-success">
        <p>{{ \Session::get('success') }}</p>
      </div>
      <br/>
    @endif
    <table class="table table-striped">
    <thead>
      <tr>
        <th>ID</th>
        <th>Título</th>
        <th>Introdução</th>        
        <th colspan="4">Ações</th>
      </tr>
    </thead>
    <tbody>          
      @foreach($questionarios as $questionario)      
      <tr>
        <td>{{$questionario->QuestionarioID}}</td>
        <td>{{$questionario->Titulo}}</td>        
        <td>{{$questionario->Introducao}}</td>        

        <td><a href="{{action('QuestionarioController@Mostrar', $questionario->QuestionarioID)}}" class="btn btn-primary">Visualizar</a></td>
        <td><a href="{{action('QuestionarioController@Editar', $questionario->QuestionarioID)}}" class="btn btn-warning">Editar</a></td>
        <td>
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
        </td>
        <td>
          <a href="{{action('QuestionarioController@showQuestionario', $questionario->QuestionarioID)}}" class="btn btn-warning">Pesquisar</a>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
  
@stop

@section('scriptadd')  
  <script src="{{ asset('/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('/bootstrap/js/bootstrap-confirmation.min.js') }}"></script>
  
  <script>
    $('[data-toggle=confirmation]').confirmation({
        rootSelector: '[data-toggle=confirmation]',
        popout: true
    });     
  </script> 
@stop