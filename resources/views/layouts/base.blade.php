<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <title> Projet S6 </title>
</head>
<body class="bg-gray-100">

<header class="p-6 bg-white flex justify-between mb-3">
    <ul class="flex items-center">
        <li class="p-3"><a href="/">Home</a></li>
        @auth
            <li class="p-3"><a href="">Mes projets</a></li>
        @endauth
    </ul>

    <h1 class="text-center font-bold text-3xl">Projet Equipe 3</h1>

    <ul class="flex items-center">
        @guest
            <li class="p-3"><a href="{{ route('login') }}">Se connecter</a></li>
            <li class="p-3"><a href="{{ route('register') }}">S'inscrire</a></li>
        @endguest
        @auth
            <li class="p-3"><a href="{{ route('login') }}">Mon compte</a></li>
            <li class="p-3"><a href="{{ route('register') }}">Se déconnecter</a></li>
        @endauth
    </ul>
</header>


@yield('content')



</body>
</html>
