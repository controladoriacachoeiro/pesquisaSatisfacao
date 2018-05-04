@extends('layouts.app')

@section('htmlheader_title')
    Pesquisa de Satisfação - SEMFA
@stop

@section('main-content')
    <h1>Pesquisa de Satisfação</h1>
    <br/>

    <div class="row">
        <div class="col-md-12">
            <form method="post" action="{{ route('cadastrarResultado') }}">
                {{ csrf_field() }}                                    
                <table class="table" id="products-table">
                    <thead>
                        <tr>
                            <th></th>
                            @for ($i = 0; $i < count($respostas); $i++)
                                <th>{{$respostas[$i]->Descricao}}</th>
                            @endfor                                    
                        </tr>
                    </thead>
                    <tbody>
                        @for ($i = 0; $i < count($perguntas); $i++)
                            <tr>
                                <th>{{$perguntas[$i]->Descricao}}</th>
                                @for ($k = 0; $k < count($respostas); $k++)
                                    <td><input style="font-size: 16px" type="radio" name="pergunta[{{$perguntas[$i]->PerguntaID}}]" id="respostaP{{$perguntas[$i]->PerguntaID}}R{{$respostas[$k]->RespostaID}}" value="{{$respostas[$k]->RespostaID}}"></td>                                    
                                @endfor
                            </tr>
                        @endfor
                    </tbody>
                </table>    
                <input id="questionarioID" type="hidden" class="form-control" name="questionarioID" value="{{$questionario->QuestionarioID}}">
                <button class="btn btn-primary" type="submit">Concluir</button>                                  
            </form>   
        </div>     
    </div>
@stop