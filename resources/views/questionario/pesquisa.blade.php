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




<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.12/css/all.css" integrity="sha384-G0fIWCsCzJIMAVNQPfjH08cyYaUtMwjJwqiRKxxE/rx96Uroj1BtIQ6MLJuheaO9" crossorigin="anonymous">

<header class="title">
    <div class="col-title">
        <h1>Pesquisa de Satisfação: Secretaria de Fazenda - PMCI</h1>
    </div>
</header>

<link rel="stylesheet" href="{{ asset('/css/externo/base.css') }}" />
<link rel="stylesheet" href="{{ asset('/css/externo/preset-1.css') }}" />
<link rel="stylesheet" href="{{ asset('/css/style.css') }}" />

<form method="post" action="{{ route('cadastrarResultado') }}">
    {{ csrf_field() }}            
    <section class="last">
        <fieldset class="required last">
            <h2>
                <div class="title-part">                            
                    Classifique a sua satisfação em relação ao atendimento prestado pelo nosso servidor:
                    <div class="require smallipop-initialized smallipop1" title="">
                        <span class="smallipop-hint">
                            Resposta exigida
                        </span>
                    </div>
                </div>
            </h2>

            <div class="special-padding-row">                                                                                                                                                                                                                                
                <div class="matrix-values">
                    <div class="input-group input-group-matrix input-group-matrix-title row">
                        <div class="col-sm-4 col-md-4 col-pad-0">
                        </div>
                        <div class="col-sm-8 col-md-8">
                            @for ($i = 0; $i < count($respostas); $i++)
                                <div class="title-groups" style="width: {{100/count($respostas)}}%;">
                                    <span class="input-group-title-main data-title-{{$i+1}}">{{$respostas[$i]->Descricao}}</span>
                                </div>                                
                            @endfor                                                                                
                        </div>
                    </div>

                    @for ($i = 0; $i < count($perguntas); $i++)
                        <div class="input-group input-group-matrix  row">
                            <div class="col-sm-4 col-md-4 col-pad-0 col-xs-pad-0">
                                <div class="title data-row-1">{{$perguntas[$i]->Descricao}}</div>
                            </div>                            
                            <div class="col-sm-8 col-md-8 col-xs-pad-0">
                                <div class="label-container">
                                    @for ($k = 0; $k < count($respostas); $k++)
                                        <label class="input-group input-group-radio">
                                            <input type="radio" class="hidden matrix" id="respostaP{{$perguntas[$i]->PerguntaID}}R{{$respostas[$k]->RespostaID}}" value="{{$respostas[$k]->RespostaID}}" name="pergunta[{{$perguntas[$i]->PerguntaID}}]" data-title="{{$k+1}}" data-row="{{$i+1}}">
                                            <span class="input-group-addon addon-matrix" data-title="{{$k+1}}" data-row="{{$i+1}}"></span>
                                            <span class="input-group-title">{{$k+1}}</span>
                                        </label>                                        
                                    @endfor
                                </div>
                            </div>                            
                        </div>
                    @endfor                                                                                                                                                                                                                                                        
                </div>
            </div>
        </fieldset>
    </section>
    <input id="questionarioID" type="hidden" class="form-control" name="questionarioID" value="{{$questionario->QuestionarioID}}">
    <ul class="pager">
        <li class="previous">
            <button name="zobraz_predchozi" value="true" type="submit"><i class="fa fa-arrow-left" aria-hidden="true"></i> Voltar</button>
        </li>
        <li class="next">
            <button name="odeslat" value="true" type="submit">Enviar o questionário <i class="fa fa-arrow-right" aria-hidden="true"></i></button>                
        </li>                
    </ul>    
</form>


<div id="icon-fullscreen" class="fullscreen">
    <a href="#" onclick="launchFullscreen(document.documentElement)"><img src="{{ asset('/img/fullscreen.png') }}" alt="fullscreen"></a>    
</div>

<script>
    var telacheia = false;
    // Find the right method, call on correct element
    function launchFullscreen(element) {
        if(element.requestFullscreen) {
            element.requestFullscreen();
        } else if(element.mozRequestFullScreen) {
            element.mozRequestFullScreen();
        } else if(element.webkitRequestFullscreen) {
            element.webkitRequestFullscreen();
        } else if(element.msRequestFullscreen) {
            element.msRequestFullscreen();
        }
        document.getElementById("icon-fullscreen").style.display = "none";       
    }

    function exitFullscreen() {
        if(document.exitFullscreen) {
            document.exitFullscreen();
        } else if(document.mozCancelFullScreen) {
            document.mozCancelFullScreen();
        } else if(document.webkitExitFullscreen) {
            document.webkitExitFullscreen();
        }
    }

    function dumpFullscreen() {
        console.log("document.fullscreenElement is: ", document.fullscreenElement || document.mozFullScreenElement || document.webkitFullscreenElement || document.msFullscreenElement);
        console.log("document.fullscreenEnabled is: ", document.fullscreenEnabled || document.mozFullScreenEnabled || document.webkitFullscreenEnabled || document.msFullscreenEnabled);        
    }

    // Events
    document.addEventListener("fullscreenchange", function(e) {
        console.log("fullscreenchange event! ", e);
        if( telacheia == true) {
            telacheia = false;            
            document.getElementById("icon-fullscreen").style.display = "block";
        }else{
            telacheia = true;
        }
    });
    document.addEventListener("mozfullscreenchange", function(e) {
        console.log("mozfullscreenchange event! ", e);                
    });
    document.addEventListener("webkitfullscreenchange", function(e) {
        console.log("webkitfullscreenchange event! ", e);        
        if( telacheia == true) {
            telacheia = false;            
            document.getElementById("icon-fullscreen").style.display = "block";
        }else{
            telacheia = true;
        }
    });
    document.addEventListener("msfullscreenchange", function(e) {
        console.log("msfullscreenchange event! ", e);   
        if( telacheia == true) {
            telacheia = false;            
            document.getElementById("icon-fullscreen").style.display = "block";
        }else{
            telacheia = true;
        }     
    });
    document.addEventListener("msfullscreenchange", function(e) {
        console.log("msfullscreenchange event! ", e);
        if( telacheia == true) {
            telacheia = false;            
            document.getElementById("icon-fullscreen").style.display = "block";
        }else{
            telacheia = true;
        }        
    });

    // Add different events for fullscreen
</script>


<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
<script src="{{ asset('/js/jQuery/jquery-3.3.1.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/js/jquery-ui-1.10.4.custom.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/js/jquery-ui-touch.js') }}"></script>