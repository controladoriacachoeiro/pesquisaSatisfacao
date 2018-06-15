@extends('layouts.app')

@section('htmlheader_title')
    Agradecimento
@stop

@section('main-content')
    <h1>{{$questionario->msgObrigado}}</h1>        
@stop

@section('scriptadd')
    <script>
        setTimeout("document.location = '/questionario/{{$questionario->QuestionarioID}}'",4000);
    </script>
@stop