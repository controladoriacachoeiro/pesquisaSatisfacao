@extends('layouts.app')

@section('htmlheader_title')
    Cadastro de Questionário
@stop

@section('main-content')
    <h2>Cadastro de Questionário</h2><br/>
    <form method="post" action="{{url('admin/questionario/cadastrar')}}" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-4"></div>
            <div class="form-group col-md-4">
                <label for="Titulo">Título:</label>
                <input type="text" class="form-control{{ $errors->has('titulo') ? ' is-invalid' : '' }}" name="titulo" value="{{ old('titulo') }}">                
                <div class="invalid-feedback">
                    {{ $errors->first('titulo') }}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4"></div>
            <div class="form-group col-md-4">
                <label for="Introducao">Introdução:</label>
                <input type="text" class="form-control{{ $errors->has('introducao') ? ' is-invalid' : '' }}" name="introducao" value="{{ old('introducao') }}">
                <div class="invalid-feedback">
                    {{ $errors->first('introducao') }}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4"></div>
            <div class="form-group col-md-4">
                <label for="msgBoasVindas">Mensagem de Boas Vindas:</label>
                <input type="text" class="form-control{{ $errors->has('msgBoasVindas') ? ' is-invalid' : '' }}" name="msgBoasVindas" value="{{ old('msgBoasVindas') }}">
                <div class="invalid-feedback">
                    {{ $errors->first('msgBoasVindas') }}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4"></div>
            <div class="form-group col-md-4">
                <label for="indicativo">Indicativo:</label>
                <input type="text" class="form-control{{ $errors->has('indicativo') ? ' is-invalid' : '' }}" name="indicativo" value="{{ old('indicativo') }}">
                <div class="invalid-feedback">
                    {{ $errors->first('indicativo') }}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4"></div>
            <div class="form-group col-md-4">
                <label for="msgObrigado">Mensagem de Agradecimento:</label>
                <input type="text" class="form-control{{ $errors->has('msgObrigado') ? ' is-invalid' : '' }}" name="msgObrigado" value="{{ old('msgObrigado') }}">
                <div class="invalid-feedback">
                    {{ $errors->first('msgObrigado') }}
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