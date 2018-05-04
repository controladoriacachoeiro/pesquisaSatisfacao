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
        <!-- <meta name="keywords" content="Transparência, Cachoeiro de Itapemirim, Contas públicas, Despesas, Receitas" /> -->

        <!-- Bootstrap 4 -->
        <link rel="stylesheet" href="{{ asset('/bootstrap/css/bootstrap.min.css') }}" />                
        
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
                        <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <!-- <li class="nav-item">
                        <a class="nav-link" href="#">Features</a>
                    </li> -->
                    <!-- <li class="nav-item">
                        <a class="nav-link" href="#">Pricing</a>
                    </li> -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Admin
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="/admin/questionario">Questionario</a>
                            <!-- <a class="dropdown-item" href="#">Another action</a>
                            <a class="dropdown-item" href="#">Something else here</a> -->
                        </div>
                    </li>
                    </ul>
                </div>
            </nav>
        </header>
        <div>        													                                
            <!-- Main content -->
            <div class="container">
                @yield('main-content')
            </div>
            <!-- /.content -->
        </div>

        <footer>

        </footer>
                    
        <script src="{{ asset('/js/jQuery/jquery-3.3.1.min.js') }}"></script>
        <!-- <script src="{{ asset('/js/app.js') }}"></script> -->
        <script src="{{ asset('/bootstrap/js/bootstrap.min.js')}}"></script>
          
        @yield('scriptadd')

    </body>
</html>