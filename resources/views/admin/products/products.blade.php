@extends('admin.app.app')
@section('content')

    <div class="content">

        <!-- Start Content-->
        <div class="container-xxl">

            <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                <div class="flex-grow-1">
                    <h4 class="m-0 fs-18 fw-semibold">Ecommerce</h4>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="overflow-hidden card">
                        <div class="card-header">
                            <a href="{{ route('admin.product.create') }}" class="btn btn-primary float-end">Ajouter un produit</a>
                            <form method="GET">
                                <div class="input-group" style="width: 250px;">
                                    <input type="text" value="{{ Request::get('keyword') }}" name="keyword" class="float-right form-control rounded-1" placeholder="Cherchez ici...">
                                    <div class="input-group-append">
                                        <button type="submit" class="border-0 btn btn-primary rounded-1">
                                            <i data-feather="crosshair" class="widgets-icons"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="p-0 card-body">
                            <div class="table-responsive">
                                <table class="table mb-0 table-traffic">

                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Title</th>
                                            <th>Sku</th>
                                            <th>Price</th>
                                            <th>Created</th>
                                            <th>Modified</th>
                                            <th colspan="2">Status</th>
                                        </tr>
                                    </thead>


                                    @if ($products->isNotEmpty())
                                        @foreach ($products as $product)
                                        <tr>
                                            <td>
                                                <a href="javascript:void(0);" class="text-reset">#{{ $product->id }}</a>
                                            </td>
                                            <td class="d-flex align-items-center">
                                                <p class="mb-0 fw-medium">{{ $product->title }}</p>

                                                    <img src="{{ asset('admin/assets/images/users/user-14.jpg') }}" class="avatar avatar-sm rounded-2 me-3" width="50" />

                                            </td>
                                            <td>
                                                <p class="mb-0">{{ $product->sku }}</p>
                                            </td>
                                            <td>
                                                <p class="mb-0">{{ number_format($product->price,0,',',' ') }} CFA</p>
                                            </td>
                                            <td>
                                                <p class="mb-0">{{ $product->created_at }}</p>
                                            </td>
                                            <td>
                                                <p class="mb-0">{{ $product->updated_at }}</p>
                                            </td>
                                            <td>
                                                @if ($product->status == 1)
                                                    <i class="fa fa-check-circle text-primary"></i>
                                                    <p class="mb-0 text-success">Yes</p>
                                                @else
                                                    <i class="fa fa-check-circle text-danger"></i>
                                                    <p class="mb-0 text-danger">No</p>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.product.edit',$product->id) }}"><i class="p-1 border mdi mdi-pencil text-muted fs-18 rounded-2 me-1"></i></a>
                                                <a href="#"><i class="p-1 border mdi mdi-delete text-muted fs-18 rounded-2"></i></a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    @endif

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div> <!-- container-fluid -->
    </div> <!-- content -->

@endsection

@section('backendJs')

@endsection
