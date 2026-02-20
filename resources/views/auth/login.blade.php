<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>{{ config('app.name', 'Connexion Amazon') }}</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <link rel="stylesheet" href="{{ asset('frontend-assets/fontawesome/css/all.min.css') }}" />
    </head>
    <body class="bg-gray-300">
        <div  class="mx-auto my-14 max-w-sm sm:my-20 border-2 p-8 rounded-md shadow-md bg-[#222F3D]">
            <a href="{{ route('home') }}" class=" flex justify-center">
                <img class="w-[150px]" src="{{ asset('frontend-assets/images/amazon_logo.png') }}" alt="Logo">
            </a>
            <h3 class="text-white text-lg py-2">S'identifier</h3>
            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="grid grid-cols-1 gap-x-8 gap-y-4">

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm/6 font-semibold text-white">Email</label>
                        <div class="mt-1">
                            <input type="email" name="email" :value="old('email')" class="block w-full rounded-md bg-white/5 px-3.5 py-2 text-base text-white outline-1 -outline-offset-1 outline-white/10 placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500" />
                        </div>
                        @error('email')
                            <p class="text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-sm/6 font-semibold text-white">Password</label>
                        <div class="mt-1">
                            <input type="password" name="password" class="block w-full rounded-md bg-white/5 px-3.5 py-2 text-base text-white outline-1 -outline-offset-1 outline-white/10 placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500" />
                        </div>
                        @error('password')
                            <p class="text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center justify-between">
                        <!-- Remember Me -->
                        <div class="block mt-2">
                            <label for="remember_me" class="inline-flex items-center">
                                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                                <span class="ms-2 text-sm text-gray-200">Remember me</span>
                            </label>
                        </div>

                        <div>
                            @if (Route::has('password.request'))
                                <a class="underline text-sm text-gray-200 hover:text-gray-500 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                                    Forgot your password?
                                </a>
                            @endif
                        </div>
                    </div>
                    <button class="bg-orange-500 text-white p-2 rounded-md" type="submit">Se connecter</button>
                    <a class="bg-orange-500 text-white p-2 rounded-md text-center" href="" >Se connecter avec google</a>
                    <a href="{{ route('register') }}" class="text-end text-xs text-white">Nouveau chez Amazon ? créer votre compte Amazon</a>
                </div>
            </form>
        </div>
    </body>
</html>


