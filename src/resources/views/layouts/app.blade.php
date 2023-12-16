<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- <title>{{ config('app.name', 'Laravel') }}</title> --}}

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">



    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    <style>
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
            text-decoration: none;
            /* Remove o sublinhado */
            color: black;
            /* Altera a cor do texto */
        }
    </style>
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
        @if(auth()->check() && auth()->user()->hasRole('coordenador'))
        @include('layouts.authenticated-header')
        @elseif(auth()->check() && auth()->user()->hasRole('professor'))
        @include('layouts.authenticated-header-professor')
        @else
        @include('layouts.header')
        @endif

        <div class="custom-container">
            <div>
                <div>
                    <i class="fas fa-pencil-alt fa-2x"></i>
                    <h3 class="smaller-font">Editar Perfil</h3>
                </div>
            </div>
        </div>

        <!-- Page Heading -->
        @if (isset($header))
        <header class="bg-white dark:bg-gray-800 shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
        @endif

        <!-- Page Content -->
        <main>
            @yield('content')
        </main>

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
                        <p><a href="https://www.ifnmg.edu.br/montesclaros" target="_blank">IFNMG - Montes Claros</a></p>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</body>

</html>