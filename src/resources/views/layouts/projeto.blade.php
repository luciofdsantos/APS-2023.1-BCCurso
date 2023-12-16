<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
    <link rel="stylesheet" href="{{ URL::asset('css/estilo.css'); }}">
    <link rel="stylesheet" href="{{ URL::asset('css/padrao.css'); }}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

</head>

<body>
    <header class="header">
        <h2 class="texto_header">Gerenciar Projetos</h2>
        <span class="post material-symbols-outlined ">
            contract
        </span>
    </header>

    <div class="container">
        @include('layouts.flash-message')

        @yield('content')
    </div>
</body>