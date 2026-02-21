@extends('admin.app.app')
@section('content')

    <div class="overflow-x-auto bg-gray-100 p-4 m-4 rounded-sm shadow-md">

        <div class="text-center col-md-12">
            @include('admin.app.message')
        </div>

        <div class="flex-col">
            <h5 class="mb-3 card-title">Category</h5>
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
                    <th class="px-3 py-2 whitespace-nowrap">N°</th>
                    <th class="px-3 py-2 whitespace-nowrap">Name</th>
                    <th class="px-3 py-2 whitespace-nowrap">Slug</th>
                    <th class="px-3 py-2 whitespace-nowrap">Statut</th>
                    <th class="px-3 py-2 whitespace-nowrap">Started date</th>
                    <th class="px-3 py-2 whitespace-nowrap">Action</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                @if($categories->isNotEmpty())
                    @foreach($categories as $category)
                        <tr class="text-gray-600">
                            <td class="px-3 py-2 whitespace-nowrap">{{ $category->id }}</td>
                            <td class="px-3 py-2 whitespace-nowrap">{{ $category->name }}</td>
                            <td class="px-3 py-2 whitespace-nowrap">{{ $category->slug }}</td>
                            <td class="px-3 py-2 whitespace-nowrap">
                                @if ($category->status)
                                    <a class="btn btn-info btn-sm">Oui</a>
                                @else
                                    <a class="btn btn-danger btn-sm">Non</a>
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
