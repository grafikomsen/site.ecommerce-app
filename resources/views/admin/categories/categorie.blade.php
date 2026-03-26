@extends('admin.app.app')
@section('content')

    <div class="overflow-x-auto bg-gray-100 p-4 m-4 rounded-md shadow-md">
        <div class="flex items-center gap-4 md:flex-row md:justify-between">
            <h5 class="mb-3 card-title">Category</h5>
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
                        <a href="{{ route('admin.categorie') }}" class="block transition-colors hover:text-gray-900"> Liste des catégories </a>
                    </li>
                </ol>
            </nav>
        </div>

        @include('admin.app.message')

        <div class="flex-col">
            <a href="{{ route('admin.categorie.create') }}" class="px-3 py-2 text-white rounded-sm bg-slate-400 hover:bg-slate-500 float-end">Ajoutez une catégorie</a>
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
                    <th class="px-3 text-start py-2 whitespace-nowrap">N°</th>
                    <th class="px-3 text-start py-2 whitespace-nowrap">Nom</th>
                    <th class="px-3 text-start py-2 whitespace-nowrap">Lien</th>
                    <th class="px-3 text-start py-2 whitespace-nowrap">Affichage</th>
                    <th class="px-3 text-start py-2 whitespace-nowrap">Statut</th>
                    <th class="px-3 text-start py-2 whitespace-nowrap">Date création</th>
                    <th class="px-3 text-start py-2 whitespace-nowrap">Action</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                @if($categories->isNotEmpty())
                    @foreach($categories as $category)
                        <tr class="text-gray-600">
                            <td class="px-3 py-2 whitespace-nowrap">{{ $category->id }}</td>
                            <td class="px-3 py-2 whitespace-nowrap">{{ $category->name }}</td>
                            <td class="px-3 py-2 whitespace-nowrap text-sm">{{ $category->slug }}</td>
                            <td class="px-3 py-2 whitespace-nowrap">
                                @if ($category->showHome == 'Oui')
                                    <i class="fa-solid text-green-500 fa-eye"></i>
                                @else
                                    <i class="fa-solid text-red-500 fa-eye-slash"></i>
                                @endif
                            </td>
                            <td class="px-3 py-2 whitespace-nowrap">
                                @if ($category->status)
                                    <i class="fa fa-check-circle text-green-500"></i>
                                @else
                                    <i class="fa-solid fa-circle-xmark text-red-500"></i>
                                @endif
                            </td>
                            <td class="px-3 py-2 whitespace-nowrap">{{ $category->created_at }}</td>
                            <td class="px-3 py-2 whitespace-nowrap">
                                <a class="p-1 mx-1 text-white bg-blue-700 rounded-sm" href="{{ route('admin.categorie.edit',$category->id) }}">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <a class="p-1 mx-1 text-white bg-red-700 rounded-sm" onclick="deleteCategory({{ $category->id }})">
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
    <script>
        function deleteCategory(id){

            let url = '{{ route("admin.categorie.destroy","ID") }}';
            let newUrl = url.replace('ID',id);

            if (confirm('Etes-vous sûr de vouloir supprimer')) {
                $.ajax({
                    url: newUrl,
                    type: 'DELETE',
                    data: {},
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (response) {
                        $("button[type=submit]").prop('desabled', false);
                        if (response['status']) {
                            window.location.href="{{ route('admin.categorie') }}";
                        }
                    }
                })
            }
        }
    </script>
@endsection
