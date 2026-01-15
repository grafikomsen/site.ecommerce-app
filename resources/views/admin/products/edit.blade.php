@extends('admin.app.app')
@section('content')

        <!-- Start Content-->
        <div class="container-xxl">

            <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                <div class="flex-grow-1">
                    <h4 class="m-0 fs-18 fw-semibold">Créer un produit</h4>
                </div>

                <div class="text-end">
                    <ol class="py-0 m-0 breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Créer un produit</li>
                    </ol>
                </div>
            </div>

            <!-- General Form -->
            <div class="row">
                <div class="col-12">
                    <div class="card">

                        <div class="card-header">
                            <h5 class="mb-0 card-title">Créer un produit</h5>
                        </div><!-- end card header -->
                        <form action="" method="POST" name="editProdForm" id="editProdForm">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-9">
                                        <div class="row">

                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="title" class="form-label">Title</label>
                                                    <input type="text" id="title" name="title" class="form-control"  value="{{ $product->title }}" placeholder="Titre du product">
                                                    <p></p>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="slug" class="form-label">Slug</label>
                                                    <input type="text" id="slug" name="slug" class="form-control"  value="{{ $product->slug }}" placeholder="Slug du product">
                                                    <p></p>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="description" class="form-label">description</label>
                                                    <textarea type="text" id="description" name="description" class="form-control" rows="5" placeholder="description du product"></textarea>
                                                    <p></p>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="short_description" class="form-label">Description courte</label>
                                                    <textarea type="text" id="short_description" name="short_description" class="form-control" rows="5" placeholder="description du product"></textarea>
                                                    <p></p>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="shipping_returns" class="form-label">Retours expédition</label>
                                                    <textarea type="text" id="shipping_returns" name="shipping_returns" class="form-control" rows="5" placeholder="description du product"></textarea>
                                                    <p></p>
                                                </div>
                                            </div>

                                            <div class="card rounded-1 mb-3">
                                                <div class="card-body">
                                                    <h2 class="h4 mb-3">Media</h2>
                                                    <div id="image" class="dropzone dz-clickable">
                                                        <div class="dz-message needsclick">
                                                            <br>Déposez les fichiers ici ou cliquez pour télécharger.<br><br>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-3" id="product-gallery">

                                            </div>
                                            <hr>

                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="price" class="form-label">Prix</label>
                                                    <input type="text" id="price" name="price" class="form-control"  value="{{ $product->price }}" placeholder="Prix du product">
                                                    <p></p>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="compare_price" class="form-label">Prix promo</label>
                                                    <input type="text" id="compare_price" name="compare_price" class="form-control"  value="{{ $product->compare_price }}" placeholder="Prix promo du product">
                                                    <p></p>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label for="sku" class="form-label">Sku</label>
                                                    <input type="text" id="sku" name="sku" class="form-control" value="{{ $product->sku }}" placeholder="Sku du product">
                                                    <p></p>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label for="barcode" class="form-label">Barcode</label>
                                                    <input type="text" id="barcode" name="barcode" class="form-control"  value="{{ $product->barcode }}" placeholder="Barcode du product">
                                                    <p></p>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label for="qty" class="form-label">Quantity</label>
                                                    <input type="number" name="qty" id="qty" class="form-control"  value="{{ $product->qty }}" placeholder="Quantity du product">
                                                    <p></p>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="track_qty" class="form-label">Quantité de suivi</label>
                                                    <input checked class="custom-control-input" type="checkbox" id="track_qty" name="track_qty" value="Yes" {{ ($product->track_qty == 'Yes') ? 'checked' : '' }}>
                                                    <p></p>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-lg-3">
                                        <div class="mb-3">
                                            <label for="status" class="form-label">Statut</label>
                                            <select class="form-select" id="status" name="status">
                                                <option {{ ($product->status == 1) ? 'selected' : '' }} value="1">Active</option>
                                                <option {{ ($product->status == 0) ? 'selected' : '' }} value="0">Désactivé</option>
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label for="category" class="form-label">Catégorie</label>
                                            <select class="form-select" id="category" name="category">
                                                <option value="">-- selectionnez --</option>
                                                @if ($categories->isNotEmpty())
                                                    @foreach ($categories as $category)
                                                        <option {{ ($product->category_id == $category->id ) ? 'selected' : '' }} value="{{ $category->id }}">{{ $category->name }}</option>
                                                    @endforeach
                                                @endif
                                                <p></p>
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label for="sub_category" class="subCategory">Sous catégorie</label>
                                            <select class="form-select" name="sub_category" id="sub_category">
                                                @if ($subCategories->isNotEmpty())
                                                    @foreach ($subCategories as $subCategory)
                                                        <option {{ ($product->sub_category_id == $subCategory->id ) ? 'selected' : '' }} value="{{ $subCategory->id }}">{{ $subCategory->name }}</option>
                                                    @endforeach
                                                @endif
                                                <p></p>
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label for="brand" class="form-label">Marque</label>
                                            <select class="form-select"  id="brand" name="brand">
                                                @if ($brands->isNotEmpty())
                                                    @foreach ($brands as $brand)
                                                        <option {{ ($product->brand_id == $brand->id ) ? 'selected' : '' }} value="{{ $brand->id }}">{{ $brand->name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label for="is_featured" class="form-label">en vedette</label>
                                            <select class="form-select" id="is_featured" name="is_featured">
                                                <option value="Yes">Oui</option>
                                                <option value="No">Non</option>
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <div class="card rounded-1 mb-3">
                                                <div class="card-body">
                                                    <div class="mb-3">
                                                        <h2 class="h4 mb-3">Produits associés</h2>
                                                        <select multiple class="related-product w-100" name="related_products[]" id="related_products">

                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Modifiez</button>
                            </div><!-- end card footer -->
                        </form>
                    </div>
                </div>
            </div>

        </div> <!-- container-fluid -->

@endsection
