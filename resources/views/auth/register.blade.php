@extends('layouts.base')


@section('content')
    <div class="flex justify-center">
        <div class="w-1/3 bg-white p-6 rounded">
            <form action="{{ route('register') }}" method="post">
                @csrf
                <div class="mb-4">
                    <label class="sr-only" for="lastname">
                        Nom
                    </label>
                    <input name="lastname" id="lastname" type="text" placeholder="Nom" value="{{ old('lastname') }}" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('lastname') border-red-500 @enderror">
                    @error('lastname')
                    <div class="text-red-500 mt-2 text-sm">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="sr-only" for="firstname">
                        Prénom
                    </label>
                    <input name="firstname" id="firstname" type="text" placeholder="Prénom" value="{{ old('firstname') }}" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('firstname') border-red-500 @enderror">
                    @error('firstname')
                    <div class="text-red-500 mt-2 text-sm">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="sr-only" for="email">
                        Email
                    </label>
                    <input name="email" id="email" type="text" placeholder="Email" value="{{ old('email') }}" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('email') border-red-500 @enderror">
                    @error('email')
                    <div class="text-red-500 mt-2 text-sm">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="sr-only" for="password">
                        Mot de passe
                    </label>
                    <input name="password" id="password" type="password" placeholder="Choisir un mot de passe" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('password') border-red-500 @enderror">
                    @error('password')
                    <div class="text-red-500 mt-2 text-sm">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="sr-only" for="password_confirmation">
                        Mot de passe
                    </label>
                    <input name="password_confirmation" id="password_confirmation" type="password" placeholder="Confirmer votre mot de passe" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('password') border-red-500 @enderror">
                    @error('password_confirmation')
                    <div class="text-red-500 mt-2 text-sm">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-3 rounded font-medium w-full">Inscription</button>
                </div>
            </form>

        </div>

    </div>
@endsection
