<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">



    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">

    <style>
        body {
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        .container2 {
            flex: 1;
        }

        footer {
            background-color: #1c2c4c;
            color: white;
            padding: 8px;
            text-align: center;
            padding-top: 20px;
            margin-top: 20px;
        }

        .footer-logo {
            max-width: 130px;
            max-height: 100px;
        }

        .logo-if {            
            max-width: 60px;
            max-height: 40px;
            margin-right: 10px;
        }
        .left-align {
        text-align: left;
        }

        .no-decoration-link {
            text-decoration: none; /* Remove o sublinhado */
            color: black; /* Altera a cor do texto */
        }
    </style>


</head>

<body>
    @if(auth()->check() && auth()->user()->hasRole('coordenador'))
        @include('layouts.authenticated-header')
    @elseif(auth()->check() && auth()->user()->hasRole('professor'))
        @include('layouts.authenticated-header-professor')
    @else
        @include('layouts.header')
    @endif


    @include('layouts.flash-message')

    <div class="navbar-divider"></div>

    <div class="container2">
        @yield('content')
    </div>

     <div class="spacer"></div> <!-- espaçador antes do footer -->
    <footer>
        <div class="container">
            <div class="row">
            
                <div class="col-md-6 left-align">
                    
                <a href="https://www.ifnmg.edu.br/montesclaros" target="_blank" class="no-decoration-link">
                    <img class="logo-if" src="{{ asset('images/logo-if-branco2.png') }}" alt="Logo">
                </a>

                <a href="{{ route('postagem.display') }}" class="no-decoration-link">
                    <img class="footer-logo" src="{{ asset('images/logo-footer.png') }}" alt="Logo">
                </a>
                    <p> </p>
                    <p>&copy; 2023 Departamento de Ciência da Computação - IFNMG</p>
                    <p>Rua Dois, 300 - Village do Lago I - Montes Claros - MG – CEP 39.404-058</p>
                </div>
                
                <div class="col-md-6 left-align">
                    <p>Telefone: (38) 2103-4141</p>
                    <p>E-mail: <a href="mailto:comunicacao.montesclaros@ifnmg.edu.br">comunicacao.montesclaros@ifnmg.edu.br</a></p>
                    <p><a href="https://www.ifnmg.edu.br/montesclaros" target="_blank" >IFNMG - Montes Claros</a></p>
                </div>
            </div>
        </div>
    </footer>


</body>

</html>