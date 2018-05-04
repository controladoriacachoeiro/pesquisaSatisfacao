@extends('layouts.app')

@section('htmlheader_title')
    Editar Resposta
@stop

@section('main-content')
    <h2>Editar Resposta</h2><br  />      
    <form method="POST" action="{{action('RespostaController@Editar', $resposta->RespostaID)}}" role="form">
        @csrf
            
        <div class="row">
            <div class="col-md-4"></div>
            <div class="form-group col-md-4">
                <label for="Descricao">Descrição:</label>
                <input type="text" class="form-control{{ $errors->has('descricao') ? ' is-invalid' : '' }}" name="descricao" value="{{$resposta->Descricao}}">
                <div class="invalid-feedback">
                    {{ $errors->first('descricao') }}
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4"></div>
            <div class="form-group col-md-4">
                <label for="Nivel">Nível:</label>
                <input type="text" class="form-control{{ ($errors->has('nivel') || session()->get('erronivel')) ? ' is-invalid' : '' }}" name="nivel" value="{{$resposta->Nivel}}">
                <div class="invalid-feedback">
                    {{ $errors->first('nivel') }}                    
                    @if(session()->has('erronivel'))                                        
                        {{ session()->get('erronivel') }}
                    @endif
                </div>
            </div>
            
        </div>

        <input id="questionarioID" type="hidden" class="form-control" name="questionarioID" value="{{$resposta->QuestionarioID}}">
                
        <div class="row">
            <div class="col-md-4"></div>
            <div class="form-group col-md-4" style="margin-top:60px">
                <button type="submit" class="btn btn-success" style="margin-left:38px">Editar</button>
            </div>
        </div>
    </form>
@stop