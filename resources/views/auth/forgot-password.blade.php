<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>{{ config('app.name', 'eshop') }}</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <link rel="stylesheet" href="{{ asset('frontend-assets/fontawesome/css/all.min.css') }}" />
    </head>
    <body class="bg-gray-300">
        <div  class="mx-auto my-auto max-w-md sm:my-20 border-2 p-8 rounded-md shadow-md bg-[#222F3D]">
            <a href="{{ route('home') }}" class="flex justify-center mb-4">
                <img class="w-[150px]" src="{{ asset('frontend-assets/images/amazon_logo.png') }}" alt="Logo">
            </a>
            <div class="mb-4 text-sm text-gray-200 text-center">
               <p> Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.</p>
            </div>
            <form action="{{ route('password.email') }}" method="POST">
                @csrf
                <div class="grid grid-cols-1 gap-x-8 gap-y-4">

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm/6 font-semibold text-white">Email</label>
                        <div class="mt-1">
                            <input type="email" name="email" :value="old('email')" class="block w-full rounded-md bg-white/5 px-3.5 py-2 text-base text-white outline-1 -outline-offset-1 outline-white/10 placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500" />
                        </div>
                        @error('email')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <button class="bg-orange-500 text-white p-2 rounded-md" type="submit">Email Password Reset Link</button>
                </div>
            </form>
        </div>
    </body>
</html>
