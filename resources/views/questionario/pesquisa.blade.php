<!DOCTYPE html>
<html>
<head>
    <title>Pesquisa de Satisfação</title>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />        
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="stylesheet" href="{{ asset('/css/externo/base.css') }}" />
    <link rel="stylesheet" href="{{ asset('/css/externo/preset-1.css') }}" />
    <link rel="stylesheet" href="{{ asset('/css/style.css') }}" />
    <style>
        header{
            padding-top: 10px;
        }
        .cabecalho{
            font-size: 38px;
            text-align: center;            
        }
        .cabecalho img{
            width: 150px;
            float: left;
        }
        .cabecalho p{
            padding-left: 25px;
            margin-bottom: 0px;
        }
        .col-title h1{
            clear: both;
            padding-top: 30px;
        }
        @media only screen and (max-width: 862px) {
            .cabecalho{
                font-size: 30px;
            }
            .cabecalho img{
                width: 125px;
            }
            .cabecalho p{
                padding-left: 20px;
            }
        }
        @media only screen and (max-width: 767px) {
            header{
                padding-top: 5px;
            }
        }
        @media only screen and (max-width: 685px) {
            .cabecalho img{            
                float: none;
            }       
            .cabecalho{
                font-size: 22px;
            }     
        }
    </style>
</head>

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.12/css/all.css" integrity="sha384-G0fIWCsCzJIMAVNQPfjH08cyYaUtMwjJwqiRKxxE/rx96Uroj1BtIQ6MLJuheaO9" crossorigin="anonymous" />

<header class="title">
    <div class="col-title">
        <div class="cabecalho">            
            <div class="logo">
                <img class="" src="{{ asset('/img/logoPMCI.png') }}" alt="logo da prefeitura de Cachoeiro de Itapemirim">
            </div>
            <div class="texto">
                <p>Prefeitura de Cachoeiro de Itapemirim</p>
                <p>Secretaria Municipal de Fazenda</p>
            </div>
        </div>
        <h1 style="text-align: center">{{$questionario->Titulo}}</h1>
    </div>
</header>

<body>
    <div id="conteudo">    
        <div class="centro" id="agradecimento" style="display: none"></div>
        <form>      
            <section class="last">
                <fieldset class="required last">
                    <h2>
                        <div class="title-part">                            
                            {{$questionario->Indicativo}}:
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
            <input style="display:none" type="reset" id="limpa" />
            <input id="questionarioID" type="hidden" class="form-control" name="questionarioID" value="{{$questionario->QuestionarioID}}">
            <ul class="pager">
                <!-- <li class="previous">
                    <button name="zobraz_predchozi" value="true" type="submit"><i class="fa fa-arrow-left" aria-hidden="true"></i> Voltar</button>
                </li> -->
                <li class="next">
                    <button disabled name="odeslat" value="true" type="submit" class="btn-submit">Enviar o questionário <i class="fa fa-arrow-right" aria-hidden="true"></i></button>                
                </li>                
            </ul>    
        </form>

        <div id="icon-fullscreen" class="fullscreen">
            <a href="#" onclick="launchFullscreen(document.documentElement)">
                <img src="{{ asset('/img/fullscreen.png') }}" alt="fullscreen">
            </a>    
        </div>
    </div>
</body>

<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
<script src="{{ asset('/js/jQuery/jquery-3.3.1.min.js') }}"></script>

<script type="text/javascript" src="{{ asset('/js/jquery-ui-touch.js') }}"></script>


<script>    

</script>

<script type="text/javascript">
    var numPerguntas = {{count($perguntas)}}
    $("input").click(function(e){        
        var numInputs = $("input:checked").length;
        if(numInputs == numPerguntas){
            $(".btn-submit").prop("disabled", false)            
        }
    })


    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    
    $(".btn-submit").click(function(e){
        $('.btn-submit').prop("disabled", true);
        e.preventDefault();        

        var data = $("form").serialize();        

        $.ajax({
           type:'POST',
           url:'/resultado/cadastrar',
           data: data,
           beforeSend: function () {
            $('.btn-submit').html("Carregando...");
            },
            success:function(data){
                $("#conteudo form").hide();
                $("header").hide();
                $(".centro").css("line-height", ($( window ).height()) + "px");
                $(".centro").css("height", ($( window ).height()) + "px");
                $("#agradecimento").show().html('<h1>' + data.success + '</h1>');
                setTimeout(function(){
                    $('#limpa').click();
                    $(".btn-submit").html("Enviar o questionário <i class='fa fa-arrow-right' aria-hidden='true'></i>").prop("disabled", true);
                    $("header").show();
                    $("#conteudo form").show();
                    $("#agradecimento").hide();
                }, 4000);
           }
        });
	});
</script>

<!-- Botão de FullScreen -->
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