<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ URL::asset('css/estilo.css'); }}">
    <link rel="stylesheet" href="{{ URL::asset('css/padrao.css'); }}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
</head>

<body>
    <header class="header">
        <h2 class="texto_header">Gerenciar Professor Externo</h2>
        <span class="post material-symbols-outlined ">
            contract
        </span>
    </header>

    <div class="container">
        @include('layouts.flash-message')

        @yield('content')
    </div>
</body>
