@extends('layouts.base')


@section('content')
    <div class="flex justify-center">
        <div class="w-2/3 bg-white p-6 rounded">
            <h1>Bienvenue sur la home page</h1>
            @auth
                <p> Vous étes bien connecté</p>
            @endauth
        </div>

    </div>

@endsection
