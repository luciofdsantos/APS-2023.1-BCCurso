<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ URL::asset('css/estilo.css'); }}">
    <link rel="stylesheet" href="{{ URL::asset('css/padrao.css'); }}">
    <!-- importe bootstrap 5.0-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

    <!-- importe de icones -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
</head>

<body>
    <header class="header">
        <h2 class="texto_header">Gerenciar Postagem</h2>
        <span class="post material-symbols-outlined ">
            contract
        </span>
    </header>


    <div class="container">
        @include('layouts.flash-message')
        
        @yield('content')
    </div>
</body>

</html>
