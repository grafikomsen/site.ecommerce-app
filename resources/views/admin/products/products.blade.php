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
                                            <th>Customer</th>
                                            <th>Items</th>
                                            <th>Price</th>
                                            <th>Created</th>
                                            <th>Modified</th>
                                            <th colspan="2">Status</th>
                                        </tr>
                                    </thead>

                                    <tr>
                                        <td>
                                            <a href="javascript:void(0);" class="text-reset">#3413</a>
                                        </td>
                                        <td class="d-flex align-items-center">
                                            <img src="assets/images/users/user-12.jpg" class="avatar avatar-sm rounded-2 me-3" />
                                            <p class="mb-0 fw-medium">Richard Dom</p>
                                        </td>
                                        <td>
                                            <p class="mb-0">82</p>
                                        </td>
                                        <td>
                                            <p class="mb-0">$480.00</p>
                                        </td>
                                        <td>
                                            <p class="mb-0">August 09, 2023</p>
                                        </td>
                                        <td>
                                            <p class="mb-0">August 18, 2023</p>
                                        </td>
                                        <td>
                                            <p class="mb-0 text-danger">Cancelled</p>
                                        </td>
                                        <td>
                                            <a href="#"><i class="p-1 border mdi mdi-pencil text-muted fs-18 rounded-2 me-1"></i></a>
                                            <a href="#"><i class="p-1 border mdi mdi-delete text-muted fs-18 rounded-2"></i></a>
                                        </td>
                                    </tr>

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
