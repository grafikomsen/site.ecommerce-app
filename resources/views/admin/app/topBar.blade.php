<div class="overflow-x-auto bg-gray-100 p-4 m-4 rounded-sm shadow-md">
    <nav aria-label="Breadcrumb">
        <div class="flex items-center md:flex-row md:justify-between gap-1 text-sm text-gray-700">
            <div>
                <form method="GET">
                    <div class="flex lg:flex-row">
                        <input type="text" value="{{ Request::get('keyword') }}" name="keyword" class="py-2 border-none rounded-l-sm w-[400px]" placeholder="Cherchez ici...">
                    </div>
                </form>
            </div>

            <div class="flex items-center border border-transparent hover:border-white p-2">
                @if (Route::has('login'))
                    <div class="flex items-center justify-end gap-4">
                        @auth
                            <div class="relative" x-data="{ open: false }">
                                <button @click="open = !open" class="text-md flex items-center gap-1">
                                    Bonjour, {{ Auth::user()->name }}
                                    <svg class="w-3 h-3 transition-transform" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                    </svg>
                                </button>

                                <div x-show="open" @click.outside="open = false" x-transition class="absolute right-0 mt-2 w-48 bg-white text-gray-800 shadow-lg rounded z-50">
                                    {{-- Liens communs --}}
                                    <a href="{{ route('home') }}" class="block px-4 py-2 text-sm hover:bg-gray-100">
                                        Aller sur site
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
                                        <a href="{{ url('/vendor/products') }}" class="block px-4 py-2 text-sm hover:bg-gray-100">
                                            Mes produits
                                        </a>
                                        <a href="{{ url('/vendor/orders') }}" class="block px-4 py-2 text-sm hover:bg-gray-100">
                                            Mes commandes
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
                        @endauth
                    </div>
                @endif
            </div>
        </div>
    </nav>
</div>
