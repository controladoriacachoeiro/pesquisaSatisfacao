@extends('layouts.app')

@section('htmlheader_title')
    Relatório
@stop

@section('main-content')
    <h3>Gráficos</h3>
    <div class="row">
        @for ($i = 0; $i < count($TodosGraficos); $i++)            
            <div class="col-lg-6 col-md-6 grafico">
                <h4 style="text-align: center">{{$TodosGraficos[$i]["Pergunta"]}}</h4>
                <div id="chart{{$i+1}}"></div>
            </div>                    
        @endfor
    </div>
        
    <h3>Listagem completa</h3>
    <table class="table table-striped">
    <thead>
      <tr>
        <th>ID Resultado</th>
        <th>ID Questionario</th>
        <th>Data/Hora</th>
        <th>Pergunta</th>        
        <th>Resposta</th>        
      </tr>
    </thead>
    <tbody>          
      @foreach($dadosDb as $item)      
      <tr>
        <td>{{$item->ResultadoID}}</td>
        <td>{{$item->QuestionarioID}}</td>        
        <td>{{date('d/m/Y H:i', strtotime($item->Data))}}</td>        
        <td>{{$item->Pergunta}}</td>        
        <td>{{$item->Resposta}}</td>        
      </tr>
      @endforeach
    </tbody>
  </table>
    @if($paginacao == 1)
        {{$dadosDb->links()}}
    @endif
  
@stop

@section('scriptadd')
    <link rel="stylesheet" href="{{ asset('/Plugins/c3-0.6.2/c3.min.css') }}" />
    <script src="{{ asset('/Plugins/d3.v5/d3.min.js') }}"></script>
    <script src="{{ asset('/Plugins/c3-0.6.2/c3.min.js') }}"></script>

    <script>                    
        @for ($i = 0; $i < count($TodosGraficos); $i++)
            var chart{{$i}} = c3.generate({
            bindto: '#chart{{$i+1}}',
            data: {
                
                columns: {!!json_encode($TodosGraficos[$i]["Dados"], JSON_UNESCAPED_UNICODE)!!},
                type : 'pie',
                onclick: function (d, i) { console.log("onclick", d, i); },
                onmouseover: function (d, i) { console.log("onmouseover", d, i); },
                onmouseout: function (d, i) { console.log("onmouseout", d, i); }
                }
            });
        @endfor
    </script>
@stop