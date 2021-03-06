<!DOCTYPE html>
<html lang="pt-br" xml:lang="pt-br">
    <head>		
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">			
        <meta name="theme-color" content="#007EBC">
        <title>@yield('htmlheader_title')</title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        
        <meta name="language" content="pt-br" />
        <meta name="resource-type" content="document" />			
        <meta name="robots" content="ALL" />
        <meta name="distribution" content="Global" />
        <meta name="rating" content="General" />
        <meta name="author" content="Controladoria de Cachoeiro de Itapemirim" />
        <meta name="title" content="@yield('htmlheader_title')" />
        <meta name="description" content="Pesquisa de Satisfação da SEMFA" />        

        <!-- Bootstrap 4 -->
        <link rel="stylesheet" href="{{ asset('/bootstrap/css/bootstrap.min.css') }}" />            
        <link rel="stylesheet" href="{{ asset('/css/style.css') }}" />

        <!-- Fonts -->
        <link rel="dns-prefetch" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">
        
        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

        @yield('header-add')                       
    </head>
    <body>        
        <header>
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <a class="navbar-brand" href="/">PesquisaSEMFA</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="/">Home</a>
                    </li>
                    <li class="nav-item">                        
                        <a class="nav-link" href="/admin/questionario">Questionario</a>
                    </li>
                    </ul>
                    

                    <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>                        
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                    </ul>                 
                    
                </div>
            </nav>
        </header>              													                                
            <!-- Main content -->
            <div class="container" id="rodape">
                @yield('main-content')
            </div>
            <!-- /.content -->
        <footer class="border-top">
            <div class="container">
                <div class="row justify-content-center">
                    <p>Desenvolvido pela equipe do Portal da Transparência - 2018 - v-1.0</p>
                </div>
            </div>
        </footer>

                    
        <script src="{{ asset('/js/jQuery/jquery-3.3.1.min.js') }}"></script>
        <!-- <script src="{{ asset('/js/app.js') }}"></script> -->
        <script src="{{ asset('/bootstrap/js/bootstrap.min.js')}}"></script>
          
        <script>
            $("#rodape").css("min-height", $(document).height()*0.8);  
        </script>
        @yield('scriptadd')

    </body>
</html>