@extends('layouts.app')

@section('htmlheader_title')
    Editar Pergunta
@stop

@section('main-content')
    <h2>Editar Pergunta</h2><br  />      
    <form method="POST" action="{{action('PerguntaController@Editar', $pergunta->PerguntaID)}}" role="form">
        @csrf
            
        <div class="row">
            <div class="col-md-4"></div>
            <div class="form-group col-md-4">
                <label for="Descricao">Descrição:</label>
                <input type="text" class="form-control{{ $errors->has('descricao') ? ' is-invalid' : '' }}" name="descricao" value="{{$pergunta->Descricao}}">
                <div class="invalid-feedback">
                    {{ $errors->first('descricao') }}
                </div>
            </div>
        </div>

        <input id="questionarioID" type="hidden" class="form-control" name="questionarioID" value="{{$pergunta->QuestionarioID}}">
                
        <div class="row">
            <div class="col-md-4"></div>
            <div class="form-group col-md-4" style="margin-top:60px">
                <button type="submit" class="btn btn-success" style="margin-left:38px">Editar</button>
            </div>
        </div>
    </form>
@stop