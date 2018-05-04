@extends('layouts.app')

@section('htmlheader_title')
    Editar Questionário
@stop

@section('main-content')
    <h2>Editar Questionário</h2><br  />      
    <form method="POST" action="{{action('QuestionarioController@Editar', $questionario->QuestionarioID)}}" role="form">
    @csrf
            
    <div class="row">
        <div class="col-md-4"></div>
        <div class="form-group col-md-4">
        <label for="Titulo">Título:</label>
        <input type="text" class="form-control{{ $errors->has('titulo') ? ' is-invalid' : '' }}" name="titulo" value="{{$questionario->Titulo}}">
        <div class="invalid-feedback">
            {{ $errors->first('titulo') }}
        </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4"></div>
        <div class="form-group col-md-4">
            <label for="Introducao">Introdução:</label>
            <input type="text" class="form-control{{ $errors->has('introducao') ? ' is-invalid' : '' }}" name="introducao" value="{{$questionario->Introducao}}">
            <div class="invalid-feedback">
                {{ $errors->first('introducao') }}
            </div>
        </div>
        </div>
    <div class="row">
        <div class="col-md-4"></div>
        <div class="form-group col-md-4">
            <label for="msgBoasVindas">Mensagem de Boas Vindas:</label>
            <input type="text" class="form-control{{ $errors->has('msgBoasVindas') ? ' is-invalid' : '' }}" name="msgBoasVindas" value="{{$questionario->MsgBoasVindas}}">
            <div class="invalid-feedback">
                {{ $errors->first('msgBoasVindas') }}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4"></div>
        <div class="form-group col-md-4">
            <label for="indicativo">Indicativo:</label>
            <input type="text" class="form-control{{ $errors->has('indicativo') ? ' is-invalid' : '' }}" name="indicativo" value="{{$questionario->Indicativo}}">
            <div class="invalid-feedback">
                {{ $errors->first('indicativo') }}
            </div>
        </div>
    </div>  
    <div class="row">
        <div class="col-md-4"></div>
        <div class="form-group col-md-4">
            <label for="msgObrigado">Mensagem de Agradecimento:</label>
            <input type="text" class="form-control{{ $errors->has('msgObrigado') ? ' is-invalid' : '' }}" name="msgObrigado" value="{{$questionario->MsgObrigado}}">
            <div class="invalid-feedback">
                {{ $errors->first('msgObrigado') }}
            </div>
        </div>
    </div>        
    <div class="row">
        <div class="col-md-4"></div>
        <div class="form-group col-md-4" style="margin-top:60px">
        <button type="submit" class="btn btn-success" style="margin-left:38px">Editar</button>
        </div>
    </div>
    </form>
@stop