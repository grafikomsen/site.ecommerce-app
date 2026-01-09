@extends('admin.app.app')
@section('content')

    <div class="content">

        <!-- Start Content-->
        <div class="container-xxl">

            <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                <div class="flex-grow-1">
                    <h4 class="m-0 fs-18 fw-semibold">Category</h4>
                </div>

                <div class="text-end">
                    <ol class="py-0 m-0 breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Category</li>
                    </ol>
                </div>
            </div>

            <div class="col-md-12 text-center">
                @include('admin.app.message')
            </div>

           <!-- Datatables  -->
            <div class="row">
                <div class="col-12">
                    <div class="card">

                        <div class="card-header">
                            <h5 class="mb-3 card-title">Category</h5>
                            <a href="{{ route('admin.categorie.create') }}" class="btn btn-primary float-end">Ajoutez une catégorie</a>
                            <form action="" method="GET">
                                <div class="input-group input-group" style="width: 250px;">
                                    <input type="text" value="{{ Request::get('keyword') }}" name="keyword" class="form-control rounded-1 float-right" placeholder="Cherchez ici...">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-primary border-0 rounded-1">
                                            search
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div><!-- end card header -->

                        <div class="card-body">
                            <table id="datatable" class="table table-bordered dt-responsive table-responsive nowrap">
                                <thead>
                                <tr>
                                    <th>N°</th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Statut</th>
                                    <th>Start date</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>

                                    @if($categories->isNotEmpty())
                                        @foreach($categories as $category)
                                            <tr>
                                                <td>{{ $category->id }}</td>
                                                <td>{{ $category->name }}</td>
                                                <td>{{ $category->slug }}</td>
                                                <td>
                                                    @if ($category->status)
                                                        <a class="btn btn-info btn-sm">Oui</a>
                                                    @else
                                                        <a class="btn btn-danger btn-sm">Non</a>
                                                    @endif
                                                </td>
                                                <td>{{ $category->created_at }}</td>
                                                <td>
                                                    <a class="btn btn-info btn-sm" href="{{ route('admin.categorie.edit',$category->id) }}">e</a>
                                                    <a class="btn btn-danger btn-sm" onclick="deleteCategory({{ $category->id }})">s</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
