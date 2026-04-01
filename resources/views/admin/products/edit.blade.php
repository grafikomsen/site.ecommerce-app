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

                <li class="rtl:rotate-180">
                    <svg xmlns="http://www.w3.org/2000/svg" class="size-4" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                    </svg>
                </li>

                <li>
                    <a class="block transition-colors hover:text-gray-900"> Modifier un produit </a>
                </li>
            </ol>
        </nav>
    </div>

    <div class="bg-gray-100 p-4 m-4 rounded-md shadow-md">

        <form method="POST" action="{{ route('admin.product.updated', $product->id) }}" name="editProdForm" id="editProdForm">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 gap-4 lg:grid-cols-3 lg:gap-8 bg-gray-100">
                <div class="p-4 rounded lg:col-span-2">

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" id="title" name="title" class="mt-0.5 w-full rounded border-gray-300 shadow-sm sm:text-sm" value="{{ $product->title }}" placeholder="Titre du product">
                            <p></p>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="slug" class="form-label">Slug</label>
                            <input type="text" id="slug" name="slug" class="mt-0.5 w-full rounded border-gray-300 shadow-sm sm:text-sm" value="{{ $product->slug }}" placeholder="Slug du product">
                            <p></p>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea type="text" id="description" name="description" class="w-full resize-none border-none focus:ring-0 sm:text-sm" rows="4" rows="5" placeholder="description du product">{{ $product->description }}</textarea>
                            <p></p>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="short_description" class="form-label">Description courte</label>
                            <textarea type="text" id="short_description" name="short_description" class="w-full resize-none border-none focus:ring-0 sm:text-sm" rows="4" rows="5" placeholder="description du product">{{ $product->short_description }}</textarea>
                            <p></p>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="shipping_returns" class="form-label">Retours expédition</label>
                            <textarea type="text" id="shipping_returns" name="shipping_returns" class="w-full resize-none border-none focus:ring-0 sm:text-sm" rows="4" rows="5" placeholder="description du product">{{ $product->shipping_returns }}</textarea>
                            <p></p>
                        </div>
                    </div>

                    <div class="mb-3 card rounded-1">
                        <div class="card-body">
                            <h2 class="mb-3 h4">Media</h2>
                            <div id="image" class="dropzone dz-clickable">
                                <div class="dz-message needsclick">
                                    <br>Déposez les fichiers ici ou cliquez pour télécharger.<br><br>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 row" id="product-gallery">

                    </div>

                    <hr class="py-4">

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="price" class="form-label">Prix</label>
                            <input type="text" id="price" name="price" value="{{ $product->price }}" class="mt-0.5 w-full rounded border-gray-300 shadow-sm sm:text-sm" placeholder="Prix du product">
                            <p></p>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="compare_price" class="form-label">Prix promo</label>
                            <input type="text" id="compare_price" name="compare_price" value="{{ $product->compare_price }}" class="mt-0.5 w-full rounded border-gray-300 shadow-sm sm:text-sm" placeholder="Prix promo du product">
                            <p></p>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="cost_price" class="form-label">Coût d'achat</label>
                            <input type="text" id="cost_price" name="cost_price" value="{{ $product->cost_price }}" class="mt-0.5 w-full rounded border-gray-300 shadow-sm sm:text-sm" placeholder="Coût du produit">
                            <p></p>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="sku" class="form-label">Sku</label>
                            <input type="text" id="sku" name="sku"  value="{{ $product->sku }}" class="mt-0.5 w-full rounded border-gray-300 shadow-sm sm:text-sm" placeholder="Sku du product">
                            <p></p>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="barcode" class="form-label">Barcode</label>
                            <input type="text" id="barcode" name="barcode"  value="{{ $product->barcode }}" class="mt-0.5 w-full rounded border-gray-300 shadow-sm sm:text-sm" placeholder="Barcode du product">
                            <p></p>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="mb-3">
                            <label for="weight" class="form-label">Poids</label>
                            <input type="text" id="weight" name="weight"  value="{{ $product->weight }}" class="mt-0.5 w-full rounded border-gray-300 shadow-sm sm:text-sm" placeholder="Poids">
                            <p></p>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="mb-3">
                            <label for="length" class="form-label">Longueur</label>
                            <input type="text" id="length" name="length"  value="{{ $product->length }}" class="mt-0.5 w-full rounded border-gray-300 shadow-sm sm:text-sm" placeholder="Longueur">
                            <p></p>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="mb-3">
                            <label for="width" class="form-label">Largeur</label>
                            <input type="text" id="width" name="width"  value="{{ $product->width }}" class="mt-0.5 w-full rounded border-gray-300 shadow-sm sm:text-sm" placeholder="Largeur">
                            <p></p>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="mb-3">
                            <label for="height" class="form-label">Hauteur</label>
                            <input type="text" id="height" name="height"  value="{{ $product->height }}" class="mt-0.5 w-full rounded border-gray-300 shadow-sm sm:text-sm" placeholder="Hauteur">
                            <p></p>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="qty" class="form-label">Quantity</label>
                            <input type="number" name="qty" id="qty"  value="{{ $product->qty }}" class="mt-0.5 w-full rounded border-gray-300 shadow-sm sm:text-sm" placeholder="Quantity du product">
                            <p></p>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="low_stock_threshold" class="form-label">Seuil stock</label>
                            <input type="number" name="low_stock_threshold" id="low_stock_threshold"  value="{{ $product->low_stock_threshold }}" class="mt-0.5 w-full rounded border-gray-300 shadow-sm sm:text-sm" placeholder="Seuil de stock">
                            <p></p>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="stock_status" class="form-label">Statut de stock</label>
                            <select class="mt-0.5 w-full rounded border-gray-300 shadow-sm sm:text-sm" id="stock_status" name="stock_status">
                                <option {{ ($product->stock_status == 'in_stock') ? 'selected' : '' }} value="in_stock">En stock</option>
                                <option {{ ($product->stock_status == 'out_of_stock') ? 'selected' : '' }} value="out_of_stock">Rupture</option>
                                <option {{ ($product->stock_status == 'pre_order') ? 'selected' : '' }} value="pre_order">Précommande</option>
                                <option {{ ($product->stock_status == 'backorder') ? 'selected' : '' }} value="backorder">Retour en stock</option>
                            </select>
                            <p></p>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="track_qty" class="form-label">Quantité de suivi</label>
                        <select class="mt-0.5 w-full rounded border-gray-300 shadow-sm sm:text-sm" id="track_qty" name="track_qty">
                            <option value="Yes" {{ ($product->track_qty == 'Yes') ? 'selected' : '' }}>Oui</option>
                            <option value="No" {{ ($product->track_qty == 'No') ? 'selected' : '' }}>Non</option>
                        </select>
                        <p></p>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="has_variations" class="form-label">Variations</label>
                            <select class="mt-0.5 w-full rounded border-gray-300 shadow-sm sm:text-sm" id="has_variations" name="has_variations">
                                <option value="No" {{ ($product->has_variations == 0) ? 'selected' : '' }}>Non</option>
                                <option value="Yes" {{ ($product->has_variations == 1) ? 'selected' : '' }}>Oui</option>
                            </select>
                            <p></p>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="is_on_sale" class="form-label">En promotion</label>
                            <select class="mt-0.5 w-full rounded border-gray-300 shadow-sm sm:text-sm" id="is_on_sale" name="is_on_sale">
                                <option value="No" {{ ($product->is_on_sale == 0) ? 'selected' : '' }}>Non</option>
                                <option value="Yes" {{ ($product->is_on_sale == 1) ? 'selected' : '' }}>Oui</option>
                            </select>
                            <p></p>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="is_new" class="form-label">Nouveau produit</label>
                            <select class="mt-0.5 w-full rounded border-gray-300 shadow-sm sm:text-sm" id="is_new" name="is_new">
                                <option value="No" {{ ($product->is_new == 0) ? 'selected' : '' }}>Non</option>
                                <option value="Yes" {{ ($product->is_new == 1) ? 'selected' : '' }}>Oui</option>
                            </select>
                            <p></p>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="draft" class="form-label">Statut de publication</label>
                            <select class="mt-0.5 w-full rounded border-gray-300 shadow-sm sm:text-sm" id="draft" name="draft">
                                <option value="pending" {{ ($product->draft == 'pending') ? 'selected' : '' }}>Brouillon</option>
                                <option value="published" {{ ($product->draft == 'published') ? 'selected' : '' }}>Publié</option>
                                <option value="archived" {{ ($product->draft == 'archived') ? 'selected' : '' }}>Archivé</option>
                            </select>
                            <p></p>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="visible" class="form-label">Visibilité</label>
                            <select class="mt-0.5 w-full rounded border-gray-300 shadow-sm sm:text-sm" id="visible" name="visible">
                                <option value="visible" {{ ($product->visible == 'visible') ? 'selected' : '' }}>Visible</option>
                                <option value="hidden" {{ ($product->visible == 'hidden') ? 'selected' : '' }}>Caché</option>
                                <option value="catalog_only" {{ ($product->visible == 'catalog_only') ? 'selected' : '' }}>Catalogue seulement</option>
                                <option value="search_only" {{ ($product->visible == 'search_only') ? 'selected' : '' }}>Recherche seulement</option>
                            </select>
                            <p></p>
                        </div>
                    </div>

                    <div class="mb-3 rounded-1">
                        <h2 class="mb-3 h4">Produits associés</h2>
                        <select multiple class="related-product w-full" name="related_products[]" id="related_products">
                            @if (!empty($relatedProducts))
                                @foreach($relatedProducts as $relProduct)
                                    <option selected value="{{ $relProduct->id }}">{{ $relProduct->title }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>

                <div class="p-4 rounded">
                    <div class="mb-3">
                        <label for="status" class="form-label">Statut</label>
                        <select class="mt-0.5 w-full rounded border-gray-300 shadow-sm sm:text-sm" id="status" name="status">
                            <option {{ ($product->status == 1) ? 'selected' : '' }} value="1">Active</option>
                            <option {{ ($product->status == 0) ? 'selected' : '' }} value="0">Désactivé</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="category" class="form-label">Catégorie</label>
                        <select class="mt-0.5 w-full rounded border-gray-300 shadow-sm sm:text-sm" id="category" name="category">
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
                        <select class="mt-0.5 w-full rounded border-gray-300 shadow-sm sm:text-sm" name="sub_category" id="sub_category">
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
                        <select class="mt-0.5 w-full rounded border-gray-300 shadow-sm sm:text-sm"  id="brand" name="brand">
                            @if ($brands->isNotEmpty())
                                @foreach ($brands as $brand)
                                    <option {{ ($product->brand_id == $brand->id ) ? 'selected' : '' }} value="{{ $brand->id }}">{{ $brand->name }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="is_featured" class="form-label">en vedette</label>
                        <select class="mt-0.5 w-full rounded border-gray-300 shadow-sm sm:text-sm" id="is_featured" name="is_featured">
                            <option {{ ($product->is_featured == 'Yes') ? 'selected' : '' }} value="Yes">Oui</option>
                            <option {{ ($product->is_featured == 'No') ? 'selected' : '' }} value="No">Non</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="meta_title" class="form-label">Titre SEO</label>
                        <input type="text" id="meta_title" name="meta_title" value="{{ $product->meta_title_fr }}" class="mt-0.5 w-full rounded border-gray-300 shadow-sm sm:text-sm" placeholder="Titre SEO du produit">
                        <p></p>
                    </div>

                    <div class="mb-3">
                        <label for="meta_description" class="form-label">Description SEO</label>
                        <textarea id="meta_description" name="meta_description" class="w-full resize-none border-none focus:ring-0 sm:text-sm" rows="3" placeholder="Description SEO du produit">{{ $product->meta_description_fr }}</textarea>
                        <p></p>
                    </div>

                    <div class="mb-3">
                        <label for="meta_keywords" class="form-label">Mots-clés SEO</label>
                        <input type="text" id="meta_keywords" name="meta_keywords" value="{{ $product->meta_keywords_fr }}" class="mt-0.5 w-full rounded border-gray-300 shadow-sm sm:text-sm" placeholder="Mots-clés SEO du produit">
                        <p></p>
                    </div>
                </div>

            </div>
            <div class="mt-4">
                <button type="submit" class="inline-block rounded-sm border border-indigo-600 bg-indigo-600 px-12 py-3 text-sm font-medium text-white hover:bg-transparent hover:text-indigo-600">Modifiez</button>
            </div>
        </form>
    </div>

@endsection
@section('backendJs')
    <script>
        $('.related-product').select2({
            ajax: {
                url: '{{ route("admin.getProducts") }}',
                dataType: 'json',
                tags: true,
                multiple: true,
                minimumInputLength: 3,
                processResults: function (data) {
                    return {
                        results: data.tags
                    };
                }
            }
        });

        $("#title").change(function() {
            element = $(this);
            $("button[type='submit']").prop('desabled', true);
            $.ajax({
                url: '{{ route("getSlug") }}',
                type: 'GET',
                data: {title: element.val()},
                dataType: 'json',
                success: function (response) {
                    $("button[type='submit']").prop('desabled', false);
                    if (response['status'] == true) {
                        $("#slug").val(response['slug']);
                    }
                }
            });
        });

        $("#editProdForm").submit(function(e) {
            e.preventDefault();
            let formArray = $(this).serializeArray();
            $("button[type='submit']").prop('desabled',true);

            $.ajax({
                url: '{{ route("admin.product.updated",$product->id) }}',
                type: 'PUT',
                data: formArray,
                dataType: 'json',
                success: function (response) {
                    $("button[type='submit']").prop('desabled',false);

                    if (response['status'] == true) {

                        $('.error').removeClass('invalid-feedback').html('');
                        $("input[type='text'], select, input[type='number']").removeClass('is-invalid');

                        window.location.href="{{ route('admin.product') }}";

                    } else {

                        let errors = response['errors'];

                        $('.error').removeClass('invalid-feedback').html('');
                        $("input[type='text'], select, input[type='number']").removeClass('is-invalid');

                        $.each(errors, function(key,value) {
                            $(`#${key}`)
                            .addClass('is-invalid')
                            .siblings('p')
                            .addClass('invalid-feedback')
                            .html(value);
                        });
                    }
                },
                error: function () {
                    console.log('Quelque chose bloque les choses?');
                }
            });
        });

        $("#category").change(function(event) {

            let category_id = $(this).val();
            $.ajax({
                url: '{{ route("admin.productSubCategorie") }}',
                type: 'GET',
                data: {category_id:category_id},
                dataType: 'json',
                success: function (response) {
                    $("#sub_category").find("option").not(":first").remove();
                    $.each(response["subCategories"], function(key,item) {
                        $("#sub_category").append(`<option value='${item.id}'>${item.name}</option>`)
                    })
                },
                error: function () {
                    console.log('Quelque chose bloque les choses?');
                }
            });
        });

        Dropzone.autoDiscover = false;
        const dropzone = $("#image").dropzone({
            url:  "{{ route('temp-images.create') }}",
            maxFiles: 10,
            paramName: 'image',
            addRemoveLinks: true,
            acceptedFiles: "image/jpeg,image/png,image/gif,image/webp",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }, success: function(file, response){
                let html = `
                <div class="col-md-3" id="image-row-${response.image_id}">
                    <div class="card">
                        <input type="hidden" name="image_array[]" value="${response.image_id}">
                        <img src="${response.ImagePath}" class="card-img-top" alt="">
                        <div class="card-body">
                            <a href="javascript:void(0)" onclick="deleteImage(${response.image_id})" class="border-0 btn btn-danger btn-sm rounded-1">Supprimer <i class="fa fa-trash"></i></a>
                        </div>
                    </div>
                </div>`;
                $("#product-gallery").append(html);
            },
            complete: function (file) {
                this.removeFile(file);
            }
        });

        function deleteImage(id){
            $("#image-row-"+id).remove();
        }

    </script>
@endsection
