@extends('layouts.app')

@section('htmlheader_title')
    Relatórios
@stop
        
@section('main-content')
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
    <h1>Gerar Relatório</h1>
    <h2>Questionário: {{$questionario->Titulo}}</h2>
    <div class="row">
        <div class="col-lg-12">
            <form method="post" action="{{action('QuestionarioController@Relatorio', $questionario->QuestionarioID)}}" role="form" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-4"></div>
                    <div class="form-group col-md-4">
                        <label for="DataInicial">Data Inicial:</label>
                        <input type="date" class="form-control{{ $errors->has('date') ? ' is-invalid' : '' }}" name="dataini" value="{{date_format(date_add(date_create(date('Y-m-d')), date_interval_create_from_date_string('-30 days')), 'Y-m-d')}}">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4"></div>
                    <div class="form-group col-md-4">
                        <label for="DataFinal">Data Final:</label>
                        <input type="date" class="form-control{{ $errors->has('date') ? ' is-invalid' : '' }}" name="datafim" value="{{date('Y-m-d')}}">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4"></div>
                    <div class="form-group col-md-4">                        
                        <input type="checkbox" class="form-check-input" id="chkTodos" name="chkTodos">
                        <label class="form-check-label" for="chkTodos">Exibir Todos</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4"></div>
                    <div class="form-group col-md-4" style="margin-top:60px">
                        <button type="submit" class="btn btn-success">Filtrar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@stop

@section('scriptadd')

@stop