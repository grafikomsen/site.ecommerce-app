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
        <div  class="mx-auto my-12 max-w-sm border-2 p-8 rounded-md shadow-md bg-[#222F3D]">
            <a href="{{ route('home') }}" class="flex justify-center ">
                <img class="w-[150px]" src="{{ asset('frontend-assets/images/amazon_logo.png') }}" alt="Logo">
            </a>
            <h3 class="py-2 text-lg text-white">Se connecter</h3>
            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="grid grid-cols-1 gap-x-8 gap-y-4">

                    <!-- Email -->
                    <div>
                        <label for="email" class="block font-semibold text-white text-sm/6">Email</label>
                        <div class="mt-1">
                            <input type="email" name="email" :value="old('email')" class="block w-full rounded-md bg-white/5 px-3.5 py-2 text-base text-white outline-1 -outline-offset-1 outline-white/10 placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500" />
                        </div>
                        @error('email')
                            <p class="text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="block font-semibold text-white text-sm/6">Password</label>
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
                                <input id="remember_me" type="checkbox" class="text-indigo-600 border-gray-300 rounded shadow-sm focus:ring-indigo-500" name="remember">
                                <span class="text-xs text-gray-200 ms-2">Remember me</span>
                            </label>
                        </div>

                        <div>
                            @if (Route::has('password.request'))
                                <a class="text-xs text-gray-200 underline rounded-md hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                                    Forgot your password?
                                </a>
                            @endif
                        </div>
                    </div>
                    <button class="p-2 text-white bg-orange-500 rounded-md" type="submit">Se connecter</button>
                    <div class="flex items-center justify-center gap-2 p-2 border border-orange-500 rounded-md">
                        <img class="w-6" src="{{ asset('frontend-assets/images/google.svg') }}" alt="">
                        <a class="p-2 text-xs text-center text-orange-500 rounded-md" href="" >Se connecter avec google</a>
                    </div>
                    <a href="{{ route('register') }}" class="text-xs text-white text-end">Nouveau chez Amazon ? créer votre compte Amazon</a>
                </div>
            </form>
        </div>
    </body>
</html>


