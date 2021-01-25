@extends('layouts.base')


@section('content')
    <div class="flex justify-center">
        <div class="w-1/3 bg-white p-6 rounded">
            <form action="{{ route('login') }}" method="post">
                @csrf
                <div class="flex flex-col">
                    <div class="mb-4">
                        <label class="block text-grey-darker text-sm font-bold mb-2" for="email">
                            Email
                        </label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker @error('email') border-red-500 @enderror" id="email" type="text" placeholder="Mon email">
                        @error('email')
                            <div class="text-red-500 mt-2 text-sm">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-6">
                        <label class="block text-grey-darker text-sm font-bold mb-2" for="password">
                            Mot de passe
                        </label>
                        <input class="shadow appearance-none border border-red rounded w-full py-2 px-3 text-grey-darker mb-3 @error('password') border-red-500 @enderror" id="password" type="password" placeholder="******************">
                        @error('password')
                        <div class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                </div>
                <div>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-3 rounded font-medium w-full">Connexion</button>
                </div>
            </form>

        </div>

    </div>
@endsection
