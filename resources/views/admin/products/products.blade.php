@extends('admin.app.app')
@section('content')

    <div class="overflow-x-auto bg-gray-100 p-4 m-4 rounded-md shadow-md">
        <nav aria-label="Breadcrumb">
            <ol class="flex items-center justify-end gap-1 text-sm text-gray-700">
                <li>
                    <a href="{{ route('admin.dashboard') }}" class="block transition-colors hover:text-gray-900"> Tableau de bord </a>
                </li>

                <li class="rtl:rotate-180">
                    <svg xmlns="http://www.w3.org/2000/svg" class="size-4" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                    </svg>
                </li>

                <li>
                    <a href="{{ route('admin.product') }}" class="block transition-colors hover:text-gray-900"> Liste des produits </a>
                </li>
            </ol>
        </nav>
    </div>

    <div class="overflow-x-auto bg-gray-100 p-4 m-4 rounded-md shadow-md">

        @include('admin.app.message')

        <div class="flex-col">
            <h5 class="mb-3 card-title">Produit</h5>
            <a href="{{ route('admin.product.create') }}" class="px-3 py-2 text-white rounded-sm bg-slate-400 hover:bg-slate-500 float-end">Ajoutez un produit</a>
            <form method="GET">
                <div class="flex lg:flex-row">
                    <input type="text" value="{{ Request::get('keyword') }}" name="keyword" class="py-2 border-none rounded-l-sm" placeholder="Cherchez ici...">
                    <div class="input-group-append">
                        <button type="submit" class="px-3 py-2 bg-orange-500 rounded-r-sm text-orange-50">
                            search
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <!-- end card header -->

        <table class="min-w-full my-8 divide-y-2 divide-gray-200 dark:divide-gray-700">
            <thead class="ltr:text-left rtl:text-right">
                <tr class="text-gray-600">
                    <th class="py-2 text-start whitespace-nowrap">N°</th>
                    <th class="py-2 text-start whitespace-nowrap">Titre</th>
                    <th class="py-2 text-start whitespace-nowrap">SKU</th>
                    <th class="py-2 text-start whitespace-nowrap">Prix</th>
                    <th class="py-2 text-start whitespace-nowrap">Statut</th>
                    <th class="py-2 text-start whitespace-nowrap">Date de création</th>
                    <th class="py-2 text-start whitespace-nowrap">Action</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                @if ($products->isNotEmpty())
                    @foreach ($products as $product)
                        <tr class="text-gray-600">
                            <td class="py-2 whitespace-nowrap">{{ $product->id }}</td>
                            <td class="py-2 whitespace-nowrap">{{ $product->title }}</td>
                            <td class="py-2 whitespace-nowrap">{{ $product->sku }}</td>
                            <td class="py-2 whitespace-nowrap">{{ number_format($product->price,0,',',' ') }} CFA</td>
                            <td class="py-2 whitespace-nowrap">
                                @if ($product->status)
                                    <i class="fa fa-check-circle text-green-500"></i>
                                @else
                                    <i class="fa-solid fa-circle-xmark text-red-500"></i>
                                @endif
                            </td>
                            <td class="py-2 whitespace-nowrap">{{ $product->created_at }}</td>
                            <td class="py-2 whitespace-nowrap">
                                <a class="p-1 mx-1 text-white bg-blue-700 rounded-sm" href="{{ route('admin.product.edit',$product->id) }}">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <a class="p-1 mx-1 text-white bg-red-700 rounded-sm" onclick="deleteProduct({{ $product->id }})">
                                    <i class="fa-solid fa-trash"></i>
                                </a>
                            </td>

                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>

@endsection

@section('backendJs')

@endsection
