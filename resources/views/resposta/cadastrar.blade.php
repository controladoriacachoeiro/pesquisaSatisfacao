@extends('layouts.app')

@section('htmlheader_title')
    Cadastro de Resposta
@stop

@section('main-content')
    <h2>Cadastro de Resposta</h2>
    <br/>
        
    <form method="post" action="{{action('RespostaController@Cadastrar', $fk)}}" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-4"></div>
            <div class="form-group col-md-4">
                <label for="Descricao">Descrição:</label>
                <input type="text" class="form-control{{ $errors->has('descricao') ? ' is-invalid' : '' }}" name="descricao" value="{{ old('descricao') }}">
                <div class="invalid-feedback">
                    {{ $errors->first('descricao') }}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4"></div>
            <div class="form-group col-md-4">
                <label for="Nivel">Nível da Resposta:</label>
                <input type="text" class="form-control{{ ($errors->has('nivel') || session()->get('erronivel')) ? ' is-invalid' : '' }}" name="nivel" value="{{ old('nivel') }}">
                <div class="invalid-feedback">
                    {{ $errors->first('nivel') }}                    
                    @if(session()->has('erronivel'))                                        
                        {{ session()->get('erronivel') }}
                    @endif
                </div>
            </div>
        </div>        
        <div class="row">
            <div class="col-md-4"></div>
            <div class="form-group col-md-4" style="margin-top:60px">
                <button type="submit" class="btn btn-success">Cadastrar</button>
            </div>
        </div>
    </form>
@stop