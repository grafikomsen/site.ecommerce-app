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
                    <a class="block transition-colors hover:text-gray-900"> Creer un produit </a>
                </li>
            </ol>
        </nav>
    </div>

    <div class="bg-gray-100 p-4 m-4 rounded-md shadow-md">

        <form name="createProdForm" id="createProdForm">

            <div class="grid grid-cols-1 gap-4 lg:grid-cols-3 lg:gap-8 bg-gray-100">
                <div class="p-4 rounded lg:col-span-2">

                    <div class="grid grid-cols-2 gap-4">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="title_fr" class="form-label">Titre <span class=" text-sm">(en français)</span></label>
                                <input type="text" id="title_fr" name="title_fr" class="mt-0.5 w-full rounded border-gray-300 shadow-sm sm:text-sm" placeholder="Titre du produit (en français)">
                                <p></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="title_en" class="form-label">Titre <span class=" text-sm">(en anglais)</span></label>
                                <input type="text" id="title_en" name="title_en" class="mt-0.5 w-full rounded border-gray-300 shadow-sm sm:text-sm" placeholder="Titre du produit (en anglais)">
                                <p></p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="slug" class="form-label">Slug</label>
                            <input type="text" id="slug" name="slug" class="mt-0.5 w-full rounded border-gray-300 shadow-sm sm:text-sm" placeholder="Slug du product">
                            <p></p>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div class="mb-3">
                            <label for="description_fr" class="form-label">Description  <span class=" text-sm">(en français)</span></label>
                            <textarea type="text" id="description_fr" name="description_fr" class="w-full resize-none border-none focus:ring-0 sm:text-sm" rows="4" rows="5" placeholder="Description du product"></textarea>
                            <p></p>
                        </div>

                        <div class="mb-3">
                            <label for="description_en" class="form-label">Description  <span class=" text-sm">(en anglais)</span></label>
                            <textarea type="text" id="description_en" name="description_en" class="w-full resize-none border-none focus:ring-0 sm:text-sm" rows="4" rows="5" placeholder="Description du product"></textarea>
                            <p></p>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div class="mb-3">
                            <label for="short_description_fr" class="form-label">Description courte <span class=" text-sm">(en Français)</span></label>
                            <textarea type="text" id="short_description_fr" name="short_description_fr" class="w-full resize-none border-none focus:ring-0 sm:text-sm" rows="4" rows="5" placeholder="description du product"></textarea>
                            <p></p>
                        </div>

                        <div class="mb-3">
                            <label for="short_description_en" class="form-label">Description courte <span class=" text-sm">(en anglais)</span></label>
                            <textarea type="text" id="short_description_en" name="short_description_en" class="w-full resize-none border-none focus:ring-0 sm:text-sm" rows="4" rows="5" placeholder="description du product"></textarea>
                            <p></p>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div class="mb-3">
                            <label for="shipping_returns_fr" class="form-label">Retours expédition <span class=" text-sm">(en français)</span></label>
                            <textarea type="text" id="shipping_returns_fr" name="shipping_returns_fr" class="w-full resize-none border-none focus:ring-0 sm:text-sm" rows="4" rows="5" placeholder="description du product"></textarea>
                            <p></p>
                        </div>

                        <div class="mb-3">
                            <label for="shipping_returns_en" class="form-label">Retours expédition <span class=" text-sm">(en anglais)</span></label>
                            <textarea type="text" id="shipping_returns_en" name="shipping_returns_en" class="w-full resize-none border-none focus:ring-0 sm:text-sm" rows="4" rows="5" placeholder="description du product"></textarea>
                            <p></p>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div class="mb-3">
                            <label for="meta_description_fr" class="form-label">Description SEO  <span class=" text-sm">(en français)</span></label>
                            <textarea id="meta_description_fr" name="meta_description_fr" class="w-full resize-none border-none focus:ring-0 sm:text-sm" rows="3" placeholder="Description SEO du produit"></textarea>
                            <p></p>
                        </div>

                        <div class="mb-3">
                            <label for="meta_description_en" class="form-label">Description SEO  <span class=" text-sm">(en anglais)</span></label>
                            <textarea id="meta_description_en" name="meta_description_en" class="w-full resize-none border-none focus:ring-0 sm:text-sm" rows="3" placeholder="Description SEO du produit"></textarea>
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

                    <div class="grid grid-cols-3 gap-4">
                        <div class="mb-3">
                            <label for="price" class="form-label">Prix</label>
                            <input type="text" id="price" name="price" class="mt-0.5 w-full rounded border-gray-300 shadow-sm sm:text-sm" placeholder="Prix du product">
                            <p></p>
                        </div>

                        <div class="mb-3">
                            <label for="compare_price" class="form-label">Prix promo</label>
                            <input type="text" id="compare_price" name="compare_price" class="mt-0.5 w-full rounded border-gray-300 shadow-sm sm:text-sm" placeholder="Prix promo du product">
                            <p></p>
                        </div>

                        <div class="mb-3">
                            <label for="cost_price" class="form-label">Coût d'achat</label>
                            <input type="text" id="cost_price" name="cost_price" class="mt-0.5 w-full rounded border-gray-300 shadow-sm sm:text-sm" placeholder="Coût du produit">
                            <p></p>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div class="mb-3">
                            <label for="sku" class="form-label">Sku</label>
                            <input type="text" id="sku" name="sku" class="mt-0.5 w-full rounded border-gray-300 shadow-sm sm:text-sm" placeholder="Sku du product">
                            <p></p>
                        </div>

                        <div class="mb-3">
                            <label for="barcode" class="form-label">Barcode</label>
                            <input type="text" id="barcode" name="barcode" class="mt-0.5 w-full rounded border-gray-300 shadow-sm sm:text-sm" placeholder="Barcode du product">
                            <p></p>
                        </div>
                    </div>

                    <div class="grid grid-cols-4 gap-4">
                        <div class="mb-3">
                            <label for="weight" class="form-label">Poids</label>
                            <input type="text" id="weight" name="weight" class="mt-0.5 w-full rounded border-gray-300 shadow-sm sm:text-sm" placeholder="Poids">
                            <p></p>
                        </div>

                        <div class="mb-3">
                            <label for="length" class="form-label">Longueur</label>
                            <input type="text" id="length" name="length" class="mt-0.5 w-full rounded border-gray-300 shadow-sm sm:text-sm" placeholder="Longueur">
                            <p></p>
                        </div>

                        <div class="mb-3">
                            <label for="width" class="form-label">Largeur</label>
                            <input type="text" id="width" name="width" class="mt-0.5 w-full rounded border-gray-300 shadow-sm sm:text-sm" placeholder="Largeur">
                            <p></p>
                        </div>

                        <div class="mb-3">
                            <label for="height" class="form-label">Hauteur</label>
                            <input type="text" id="height" name="height" class="mt-0.5 w-full rounded border-gray-300 shadow-sm sm:text-sm" placeholder="Hauteur">
                            <p></p>
                        </div>
                    </div>

                    <div class="grid grid-cols-4 gap-4">
                        <div class="mb-3">
                            <label for="qty" class="form-label">Quantity</label>
                            <input type="number" name="qty" id="qty" class="mt-0.5 w-full rounded border-gray-300 shadow-sm sm:text-sm" placeholder="Quantity du product">
                            <p></p>
                        </div>

                        <div class="mb-3">
                            <label for="low_stock_threshold" class="form-label">Seuil stock</label>
                            <input type="number" name="low_stock_threshold" id="low_stock_threshold" class="mt-0.5 w-full rounded border-gray-300 shadow-sm sm:text-sm" placeholder="Seuil de stock">
                            <p></p>
                        </div>

                        <div class="mb-3">
                            <label for="stock_status" class="form-label">Statut de stock</label>
                            <select class="mt-0.5 w-full rounded border-gray-300 shadow-sm sm:text-sm" id="stock_status" name="stock_status">
                                <option value="in_stock">En stock</option>
                                <option value="out_of_stock">Rupture</option>
                                <option value="pre_order">Précommande</option>
                                <option value="backorder">Retour en stock</option>
                            </select>
                            <p></p>
                        </div>

                        <div class="mb-3">
                            <label for="track_qty" class="form-label">Quantité de suivi</label>
                            <select class="mt-0.5 w-full rounded border-gray-300 shadow-sm sm:text-sm" id="track_qty" name="track_qty">
                                <option value="Yes" selected>Oui</option>
                                <option value="No">Non</option>
                            </select>
                            <p></p>
                        </div>
                    </div>

                    <div class="mb-3 card rounded-1">
                        <h2 class="h4">Produits associés</h2>
                        <select multiple class="related-product w-full" name="related_products[]" id="related_products">

                        </select>
                    </div>
                </div>

                <div class="p-4 rounded">
                    <div class="mb-3">
                        <label for="status" class="form-label">Statut</label>
                        <select class="mt-0.5 w-full rounded border-gray-300 shadow-sm sm:text-sm" id="status" name="status">
                            <option value="1">Activé</option>
                            <option value="0">Désactivée</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="category" class="form-label">Catégorie</label>
                        <select class="mt-0.5 w-full rounded border-gray-300 shadow-sm sm:text-sm" id="category" name="category">
                            <option value="">-- selectionnez --</option>
                            @if ($categories->isNotEmpty())
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            @endif
                            <p></p>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="sub_category" class="subCategory">Sous catégorie</label>
                        <select class="mt-0.5 w-full rounded border-gray-300 shadow-sm sm:text-sm" name="sub_category" id="sub_category">
                            <option value="">-- selectionnez --</option>
                            <p></p>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="brand" class="form-label">Marque</label>
                        <select class="mt-0.5 w-full rounded border-gray-300 shadow-sm sm:text-sm"  id="brand" name="brand">
                            <option value="">-- selectionnez --</option>
                            @if ($brands->isNotEmpty())
                                @foreach ($brands as $brand)
                                    <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="is_featured" class="form-label">en vedette</label>
                        <select class="mt-0.5 w-full rounded border-gray-300 shadow-sm sm:text-sm" id="is_featured" name="is_featured">
                            <option value="Yes">Oui</option>
                            <option value="No">Non</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="meta_title_fr" class="form-label">Titre SEO (fr)</label>
                        <input type="text" id="meta_title_fr" name="meta_title_fr" class="mt-0.5 w-full rounded border-gray-300 shadow-sm sm:text-sm" placeholder="Titre SEO du produit (en français)">
                        <p></p>
                    </div>

                    <div class="mb-3">
                        <label for="meta_title_en" class="form-label">Titre SEO (en)</label>
                        <input type="text" id="meta_title_en" name="meta_title_en" class="mt-0.5 w-full rounded border-gray-300 shadow-sm sm:text-sm" placeholder="Titre SEO du produit (en anglais)">
                        <p></p>
                    </div>

                    <div class="mb-3">
                        <label for="meta_keywords_fr" class="form-label">Mots-clés SEO (fr)</label>
                        <input type="text" id="meta_keywords_fr" name="meta_keywords_fr" class="mt-0.5 w-full rounded border-gray-300 shadow-sm sm:text-sm" placeholder="Mots-clés SEO du produit (en français)">
                        <p></p>
                    </div>

                    <div class="mb-3">
                        <label for="meta_keywords_en" class="form-label">Mots-clés SEO (en)</label>
                        <input type="text" id="meta_keywords_en" name="meta_keywords_en" class="mt-0.5 w-full rounded border-gray-300 shadow-sm sm:text-sm" placeholder="Mots-clés SEO du produit (en anglais)">
                        <p></p>
                    </div>

                    <div class="mb-3">
                        <label for="has_variations" class="form-label">Variations</label>
                        <select class="mt-0.5 w-full rounded border-gray-300 shadow-sm sm:text-sm" id="has_variations" name="has_variations">
                            <option value="No">Non</option>
                            <option value="Yes">Oui</option>
                        </select>
                        <p></p>
                    </div>

                    <div class="mb-3">
                        <label for="is_on_sale" class="form-label">En promotion</label>
                        <select class="mt-0.5 w-full rounded border-gray-300 shadow-sm sm:text-sm" id="is_on_sale" name="is_on_sale">
                            <option value="No">Non</option>
                            <option value="Yes">Oui</option>
                        </select>
                        <p></p>
                    </div>

                    <div class="mb-3">
                        <label for="is_new" class="form-label">Nouveau produit</label>
                        <select class="mt-0.5 w-full rounded border-gray-300 shadow-sm sm:text-sm" id="is_new" name="is_new">
                            <option value="No">Non</option>
                            <option value="Yes">Oui</option>
                        </select>
                        <p></p>
                    </div>

                    <div class="mb-3">
                        <label for="draft" class="form-label">Statut de publication</label>
                        <select class="mt-0.5 w-full rounded border-gray-300 shadow-sm sm:text-sm" id="draft" name="draft">
                            <option value="pending">Brouillon</option>
                            <option value="published">Publié</option>
                            <option value="archived">Archivé</option>
                        </select>
                        <p></p>
                    </div>

                    <div class="mb-3">
                        <label for="visible" class="form-label">Visibilité</label>
                        <select class="mt-0.5 w-full rounded border-gray-300 shadow-sm sm:text-sm" id="visible" name="visible">
                            <option value="visible">Visible</option>
                            <option value="hidden">Caché</option>
                            <option value="catalog_only">Catalogue seulement</option>
                            <option value="search_only">Recherche seulement</option>
                        </select>
                        <p></p>
                    </div>
                </div>

            </div>
            <div class="mt-4">
                <button type="submit" class="inline-block rounded-sm border border-indigo-600 bg-indigo-600 px-12 py-3 text-sm font-medium text-white hover:bg-transparent hover:text-indigo-600">Sauvegardez</button>
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

        function slugify(value) {
            return value.toString().toLowerCase().trim()
                .replace(/\s+/g, '-')
                .replace(/[^a-z0-9\-]+/g, '')
                .replace(/\-\-+/g, '-')
                .replace(/^-+|-+$/g, '');
        }

        $("#title_fr").change(function() {
            element = $(this);
            $("button[type='submit']").prop('disabled', true);
            $.ajax({
                url: '{{ route("getSlug") }}',
                type: 'GET',
                data: {title: element.val()},
                dataType: 'json',
                success: function (response) {
                    $("button[type='submit']").prop('disabled', false);
                    if (response['status'] == true) {
                        $("#slug").val(response['slug']);
                    }
                }
            });
        });

        $("#createProdForm").submit(function(e) {
            e.preventDefault();

            if (!$("#slug").val().trim() && $("#title_fr").val().trim()) {
                $("#slug").val(slugify($("#title_fr").val()));
            }

            let formArray = $(this).serializeArray();
            $("button[type='submit']").prop('disabled', true);

            $.ajax({
                url: '{{ route("admin.product.store") }}',
                type: 'POST',
                data: formArray,
                dataType: 'json',
                success: function (response) {
                    $("button[type='submit']").prop('desabled',false);

                    if (response['status'] == true) {

                        $('.error').removeClass('invalid-feedback').html('');
                        $("input[type='text'], select, input[type='number']")
                        .removeClass('is-invalid');

                        window.location.href="{{ route('admin.product') }}";

                    } else {

                        let errors = response['errors'];

                        $('.error').removeClass('invalid-feedback').html('');
                        $("input[type='text'], select, input[type='number']")
                        .removeClass('is-invalid');

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
                        $("#sub_category")
                        .append(`<option value='${item.id}'>${item.name}</option>`)
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
                            <a href="javascript:void(0)" onclick="deleteImage(${response.image_id})" class="border-0 btn btn-danger btn-sm rounded-1">
                                Supprimer <i class="fa fa-trash"></i>
                            </a>
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
