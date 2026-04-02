<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        {!! SEO::generate() !!}
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <link rel="stylesheet" href="{{ asset('frontend/assets/fontawesome/css/all.min.css') }}" />
    </head>
    <body class="font-poppins">
        <header class="fixed top-0 left-0 z-50 w-full bg-[#0F1111]">
            <nav class="px-8 py-2">
                <div class="hidden lg:flex lg:justify-between lg:items-center text-white font-poppins">
                    <a href="{{ route('home') }}">
                        <img class="w-[100px] border border-transparent hover:border-white p-2" src="{{ asset('frontend/assets/images/amazon_logo.png') }}" alt="">
                    </a>
                    <div class="flex items-center space-x-2 border border-transparent hover:border-white p-2">
                        <i class="fa-solid text-white fa-location-dot"></i>
                        <h5 class="text-xs">Votre adresse de livraison: <br> <span class="font-semibold">Sénégal</span></h5>
                    </div>

                    <form class="flex">
                        <select class="text-xs bg-gray-500 rounded-l-sm px-2 py-2 border-transparent">
                            <option> Catégories</option>
                            @if(getCategories()->isNotEmpty())
                                @foreach(getCategories() as $category)
                                    <option >
                                        <a href="{{ route('shop',$category->slug) }}">
                                            {{ $category->name }}
                                        </a>
                                    </option>
                                @endforeach
                            @endif
                        </select>
                        <input type="text" class=" bg-gray-200 py-2 px-2 text-sm w-[350px] outline-none text-black focus:outline-none" placeholder="Recherche ici...">
                        <button type="submit" class="bg-orange-600 py-2 px-3 rounded-r-sm"><i class="fa-solid text-md fa-magnifying-glass"></i></button>
                    </form>

                    <div class="px-2">
                        <select name="" id="" class="bg-gray-800 rounded-sm border border-transparent hover:border-white">
                            <option value="">FR</option>
                            <option value="">EN</option>
                        </select>
                    </div>
                   <div class="flex items-center border border-transparent hover:border-white p-2">
                        @if (Route::has('login'))
                            <nav class="flex items-center justify-end gap-4">
                                @auth
                                    <div class="relative" x-data="{ open: false }">
                                        <button @click="open = !open" class="text-xs flex items-center gap-1">
                                            Bonjour, {{ Auth::user()->name }}
                                            <svg class="w-3 h-3 transition-transform" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                            </svg>
                                        </button>

                                        <div
                                            x-show="open"
                                            @click.outside="open = false"
                                            x-transition
                                            class="absolute right-0 mt-2 w-48 bg-white text-gray-800 shadow-lg rounded z-50"
                                        >
                                            {{-- Liens communs --}}
                                            <a href="{{ url('/dashboard') }}" class="block px-4 py-2 text-sm hover:bg-gray-100">
                                                Mon compte
                                            </a>

                                            @if (Auth::user()->role === 'admin')
                                                <hr class="my-1">
                                                <span class="block px-4 py-1 text-xs text-gray-400 uppercase tracking-wide">Admin</span>
                                                <a href="{{ url('/admin/dashboard') }}" class="block px-4 py-2 text-sm hover:bg-gray-100">
                                                    Dashboard
                                                </a>
                                                <a href="{{ url('/admin/settings') }}" class="block px-4 py-2 text-sm hover:bg-gray-100">
                                                    Paramètres
                                                </a>

                                            @elseif (Auth::user()->role === 'vendor')
                                                <hr class="my-1">
                                                <span class="block px-4 py-1 text-xs text-gray-400 uppercase tracking-wide">Vendeur</span>
                                                <a href="{{ url('/vendor/dashboard') }}" class="block px-4 py-2 text-sm hover:bg-gray-100">
                                                    Tableau de bord
                                                </a>
                                                <a href="{{ url('/vendor/products') }}" class="block px-4 py-2 text-sm hover:bg-gray-100">
                                                    Mes produits
                                                </a>
                                                <a href="{{ url('/vendor/orders') }}" class="block px-4 py-2 text-sm hover:bg-gray-100">
                                                    Mes commandes
                                                </a>

                                            @elseif (Auth::user()->role === 'user')
                                                <hr class="my-1">
                                                <span class="block px-4 py-1 text-xs text-gray-400 uppercase tracking-wide">Mon espace</span>
                                                <a href="{{ url('/orders') }}" class="block px-4 py-2 text-sm hover:bg-gray-100">
                                                    Mes commandes
                                                </a>
                                                <a href="{{ url('/profile') }}" class="block px-4 py-2 text-sm hover:bg-gray-100">
                                                    Mon profil
                                                </a>
                                            @endif

                                            {{-- Déconnexion --}}
                                            <hr class="my-1">
                                            <form method="POST" action="{{ route('logout') }}">
                                                @csrf
                                                <button type="submit" class="w-full text-left px-4 py-2 text-sm hover:bg-gray-100 text-red-500">
                                                    Se déconnecter
                                                </button>
                                            </form>
                                        </div>
                                    </div>

                                @else
                                    <a href="{{ route('login') }}" class="text-xs">
                                        Bonjour, Identifiez-vous
                                        <br><span class="font-semibold">à votre compte</span>
                                    </a>
                                @endauth
                            </nav>
                        @endif
                    </div>
                    <div class="border border-transparent hover:border-white p-2">
                        <a href="" class="text-xs">
                            Retours
                            <br><span class="font-semibold">et commande</span>
                        </a>
                    </div>
                    <a href="" class="flex items-center space-x-2 border border-transparent hover:border-white p-2">
                        <h5 class="text-sm">Panier</h5>
                        <i class="fa-solid fa-bag-shopping"></i>
                    </a>
                </div>
                <div class="lg:hidden flex items-center justify-between text-white font-poppins">
                    <img class="w-25 border border-transparent hover:border-white p-2" src="{{ asset('frontend/assets/images/amazon_logo.png') }}" alt="">
                    <div class="flex items-center space-x-2 border border-transparent hover:border-white p-2">
                        <h5 class="text-sm">Panier</h5>
                        <i class="fa-solid fa-bag-shopping"></i>
                    </div>
                </div>
            </nav>
            <div class="bg-[#222F3D] h-10 flex items-center text-white text-sm px-10 font-poppins">
                <div class="flex items-center gap-1 p-2 border border-transparent hover:border-white">
                    <i class="fa-solid fa-bars fa-lg"></i>
                    <p class="font-semibold">Tous les catégories</p>
                </div>

                <ul class="flex items-center font-poppins">
                    <li class="p-2 border border-transparent hover:border-white">Todays Deals</li>
                    <li class="p-2 border border-transparent hover:border-white">Customer Service</li>
                    <li class="p-2 border border-transparent hover:border-white">Registry</li>
                    <li class="p-2 border border-transparent hover:border-white">Gift Cards</li>
                    <li class="p-2 border border-transparent hover:border-white">Sell</li>
                </ul>
            </div>
        </header>
        <main class="pt-2">
            @yield('main')
        </main>
        <footer class="text-white">
            <div class="footerTopBar bg-[#37475A] text-center py-4">
                <h5>Retour en haut</h5>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 bg-[#333] px-20 py-12">
                <div>
                    <h5 class="text-lg font-semibold">Retour en haut pour mieux nous connaître</h5>
                    <ul class="flex-column mt-3">
                        <li><a class="py-4" href="">À propos Amazon</a></li>
                        <li><a class="py-4" href="">Carrières</a></li>
                        <li><a class="py-4" href="">Durabilité</a></li>
                        <li><a class="py-4" href="">Amazon Science</a></li>
                    </ul>
                </div>
                <div>
                    <h5 class="text-lg font-semibold">Gagnez de argent</h5>
                    <ul class="flex-column mt-3">
                        <li><a class="py-4" href="">À propos Amazon</a></li>
                        <li><a class="py-4" href="">Carrières</a></li>
                        <li><a class="py-4" href="">Durabilité</a></li>
                        <li><a class="py-4" href="">Amazon Science</a></li>
                    </ul>
                </div>
                <div>
                    <h5 class="text-lg font-semibold">Moyens de paiement Amazon</h5>
                    <ul class="flex-column mt-3">
                        <li><a class="py-4" href="">À propos Amazon</a></li>
                        <li><a class="py-4" href="">Carrières</a></li>
                        <li><a class="py-4" href="">Durabilité</a></li>
                        <li><a class="py-4" href="">Amazon Science</a></li>
                    </ul>
                </div>
                <div>
                    <h5 class="text-lg font-semibold">Besoin aide ?</h5>
                    <ul class="flex-column mt-3">
                        <li><a class="py-4" href="">À propos Amazon</a></li>
                        <li><a class="py-4" href="">Carrières</a></li>
                        <li><a class="py-4" href="">Durabilité</a></li>
                        <li><a class="py-4" href="">Amazon Science</a></li>
                    </ul>
                </div>
            </div>
        </footer>
    </body>
</html>
