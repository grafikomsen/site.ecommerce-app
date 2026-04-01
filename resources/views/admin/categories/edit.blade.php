@extends('admin.app.app')
@section('content')

    <div class="bg-gray-100 p-4 m-4 rounded-md shadow-md">

        <div class="flex items-center gap-4 md:flex-row md:justify-between">
            <h5 class="mb-3 card-title">Catégorie</h5>
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

                    <li class="rtl:rotate-180">
                        <svg xmlns="http://www.w3.org/2000/svg" class="size-4" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                    </li>

                    <li>
                        <a class="block transition-colors hover:text-gray-900"> Modifier une catégorie </a>
                    </li>
                </ol>
            </nav>
        </div>
        <hr class="py-2">

        <!-- Form Validation -->
        <form name="editCategoryForm" id="editCategoryForm">
            @csrf

            <div class="grid grid-cols-3 gap-4">
                <div class="py-2 flex flex-col">
                    <label for="name_fr" class="text-sm font-medium text-gray-700">Catégorie (fr)</label>
                    <input type="text" class="mt-0.5 w-50 rounded border-gray-300 shadow-sm sm:text-sm" id="name_fr" name="name_fr" value="{{ $category->name_fr }}" placeholder="Nom de la catégorie (en français)">
                    <p></p>
                </div>
                <div class="py-2 flex flex-col">
                    <label for="name_en" class="text-sm font-medium text-gray-700">Catégorie (en)</label>
                    <input type="text" class="mt-0.5  rounded border-gray-300 shadow-sm sm:text-sm" id="name_en" name="name_en" value="{{ $category->name_en }}" placeholder="Nom de la catégorie (en anglais)">
                    <p></p>
                </div>
                <div class="py-2 flex flex-col">
                    <label for="slug" class="text-sm font-medium text-gray-700">Slug</label>
                    <input type="text" class="mt-0.5  rounded border-gray-300 shadow-sm sm:text-sm" id="slug" name="slug" value="{{ $category->slug }}" placeholder="Lien de la catégorie">
                    <p></p>
                </div>
            </div>

            <div class="py-2">
                <label for="icon" class="text-sm font-medium text-gray-700">Icône</label>
                <input type="text" class="mt-0.5 w-full rounded border-gray-300 shadow-sm sm:text-sm" id="icon" name="icon" value="{{ $category->icon }}" placeholder="Nom du fichier icône">
                <p></p>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div class="py-2">
                    <label for="description_fr" class="text-sm font-medium text-gray-700">Description (fr)</label>
                    <textarea class="mt-0.5 w-full rounded border-gray-300 shadow-sm sm:text-sm" id="description_fr" name="description_fr" rows="4" placeholder="Description de la catégorie (en français)">{{ $category->description_fr }}</textarea>
                    <p></p>
                </div>

                <div class="py-2">
                    <label for="description_en" class="text-sm font-medium text-gray-700">Description (en)</label>
                    <textarea class="mt-0.5 w-full rounded border-gray-300 shadow-sm sm:text-sm" id="description_en" name="description_en" rows="4" placeholder="Description de la catégorie (en anglais)">{{ $category->description_en }}</textarea>
                    <p></p>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div class="py-2">
                    <label for="meta_title_fr" class="text-sm font-medium text-gray-700">Titre SEO (fr)</label>
                    <input type="text" class="mt-0.5 w-full rounded border-gray-300 shadow-sm sm:text-sm" id="meta_title_fr" name="meta_title_fr" value="{{ $category->meta_title_fr }}" placeholder="Titre SEO de la catégorie (en français)">
                    <p></p>
                </div>

                <div class="py-2">
                    <label for="meta_title_en" class="text-sm font-medium text-gray-700">Titre SEO (en)</label>
                    <input type="text" class="mt-0.5 w-full rounded border-gray-300 shadow-sm sm:text-sm" id="meta_title_en" name="meta_title_en" value="{{ $category->meta_title_en }}" placeholder="Titre SEO de la catégorie (en anglais)">
                    <p></p>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div class="py-2">
                    <label for="meta_keywords_fr" class="text-sm font-medium text-gray-700">Mots-clés SEO (fr)</label>
                    <input type="text" class="mt-0.5 w-full rounded border-gray-300 shadow-sm sm:text-sm" id="meta_keywords_fr" name="meta_keywords_fr" value="{{ $category->meta_keywords_fr }}" placeholder="Mots-clés SEO de la catégorie (en français)">
                    <p></p>
                </div>

                <div class="py-2">
                    <label for="meta_keywords_en" class="text-sm font-medium text-gray-700">Mots-clés SEO (en)</label>
                    <input type="text" class="mt-0.5 w-full rounded border-gray-300 shadow-sm sm:text-sm" id="meta_keywords_en" name="meta_keywords_en" value="{{ $category->meta_keywords_en }}" placeholder="Mots-clés SEO de la catégorie (en anglais)">
                    <p></p>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div class="py-2">
                    <label for="meta_description_fr" class="text-sm font-medium text-gray-700">Description SEO (fr)</label>
                    <textarea class="mt-0.5 w-full rounded border-gray-300 shadow-sm sm:text-sm" id="meta_description_fr" name="meta_description_fr" rows="3" placeholder="Description SEO de la catégorie (en français)">{{ $category->name_fr }}</textarea>
                    <p></p>
                </div>

                <div class="py-2">
                    <label for="meta_description_en" class="text-sm font-medium text-gray-700">Description SEO</label>
                    <textarea class="mt-0.5 w-full rounded border-gray-300 shadow-sm sm:text-sm" id="meta_description_en" name="meta_description_en" rows="3" placeholder="Description SEO de la catégorie (en anglais)">{{ $category->name_fr }}</textarea>
                    <p></p>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div class="mt-4">
                    <label for="image">Logo</label>
                    <input type="hidden" id="image_id" name="image_id" value="">
                    <div id="image" class="dropzone dz-clickable">
                        <div class="dz-message needsclick">
                            <br>Déposez vos fichiers ici ou cliquez pour les télécharger.<br><br>
                        </div>
                    </div>
                </div>

                <div class="mt-4">
                    <label for="banner">Banniière</label>
                    <input type="hidden" id="banner_id" name="banner_id" value="">
                    <div id="banner" class="dropzone dz-clickable">
                        <div class="dz-message needsclick">
                            <br>Déposez vos fichiers ici ou cliquez pour les télécharger.<br><br>
                        </div>
                    </div>
                </div>
            </div>

            <div class=" grid grid-cols-2 gap-2">
                <div class="mt-4">
                    <label for="showHome" class="text-sm font-medium text-gray-700">Affichage</label>
                    <select class="mt-0.5 w-full rounded border-gray-300 shadow-sm sm:text-sm" id="showHome" name="showHome">
                        <option {{ ($category->showHome == 'Oui') ? 'selected' : '' }} value="Oui">Oui</option>
                        <option {{ ($category->showHome == 'Non') ? 'selected' : '' }} value="Non">Non</option>
                    </select>
                </div>
                <div class="mt-4">
                    <label for="status" class="text-sm font-medium text-gray-700">Statut</label>
                    <select class="mt-0.5 w-full rounded border-gray-300 shadow-sm sm:text-sm" id="status" name="status">
                        <option {{ ($category->status == 1) ? 'selected' : '' }} value="1">Activé</option>
                        <option {{ ($category->status == 0) ? 'selected' : '' }} value="0">Désactivé</option>
                    </select>
                </div>
            </div>

            <div class="mt-4 rounded-sm">
                <button class="bg-orange-500 text-white px-3 py-2 hover:bg-orange-600" type="submit">Sauvegardez</button>
            </div>
        </form>

    </div>

@endsection
@section('backendJs')
    <script>

        $('#editCategoryForm').submit(function(e) {
            e.preventDefault();
            let element = $(this);
            $("button[type=submit]").prop('desabled', true);

            $.ajax({
                url: '{{ route("admin.categorie.updated",$category->id) }}',
                type: 'PUT',
                data: element.serializeArray(),
                dataType: 'json',
                success: function (response) {
                    $("button[type=submit]").prop('desabled', false);

                    if(response['status'] == true){

                        window.location.href="{{ route('admin.categorie') }}";

                        $('#name_fr')
                            .removeClass('is-invalid')
                            .siblings('p')
                            .removeClass('invalid-feedback')
                            .html('');

                        $('#name_en')
                            .removeClass('is-invalid')
                            .siblings('p')
                            .removeClass('invalid-feedback')
                            .html('');

                        $('#slug')
                            .removeClass('is-invalid')
                            .siblings('p')
                            .removeClass('invalid-feedback')
                            .html('');

                    } else {

                        let errors = response['errors'];

                        // NAME_FR
                        if (errors['name_fr']) {
                            $('#name_fr').addClass('is-invalid')
                                .siblings('p')
                                .addClass('invalid-feedback').html(errors['name_fr']);
                        } else {
                            $('#name_fr').removeClass('is-invalid')
                                .siblings('p')
                                .removeClass('invalid-feedback').html('');
                        }

                        // NAME_EN
                        if (errors['name_en']) {
                            $('#name_en').addClass('is-invalid')
                                .siblings('p')
                                .addClass('invalid-feedback').html(errors['name_en']);
                        } else {
                            $('#name_en').removeClass('is-invalid')
                                .siblings('p')
                                .removeClass('invalid-feedback').html('');
                        }

                        // SLUG
                        if (errors['slug']) {
                            $('#slug').addClass('is-invalid')
                                .siblings('p')
                                .addClass('invalid-feedback').html(errors['slug']);
                        } else {
                            $('#slug').removeClass('is-invalid')
                                .siblings('p')
                                .removeClass('invalid-feedback').html('');
                        }
                    }

                }, error: function (jqXHR, exception) {
                    alert("Quelque chose s'est mal passé");
                }
            });
        });

        $('#name_fr').change(function() {
            element = $(this);
            $("button[type=submit]").prop('desabled', true);
            $.ajax({
                url: '{{ route("getSlug") }}',
                type: 'GET',
                data: {title: element.val()},
                dataType: 'json',
                success: function (response) {
                    $("button[type=submit]").prop('desabled', false);
                    if (response['status'] == true) {
                        $("#slug").val(response['slug']);
                    }
                }
            });
        });

        Dropzone.autoDiscover = false;
        const dropzone = $("#image").dropzone({
            init: function() {
                this.on('addedfile', function(file) {
                    if (this.files.length > 1) {
                        this.removeFile(this.files[0]);
                    }
                });
            },
            url:  "{{ route('temp-images.create') }}",
            maxFiles: 1,
            paramName: 'image',
            addRemoveLinks: true,
            acceptedFiles: "image/jpeg,image/png,image/gif,image/webp",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }, success: function(file, response){
                $("#image_id").val(response.image_id);
                //console.log(response)
            }
        });

        const dropzoneBanner = $("#banner").dropzone({
            init: function() {
                this.on('addedfile', function(file) {
                    if (this.files.length > 1) {
                        this.removeFile(this.files[0]);
                    }
                });
            },
            url: "{{ route('temp-images.create') }}",
            maxFiles: 1,
            paramName: 'image',
            addRemoveLinks: true,
            acceptedFiles: "image/jpeg,image/png,image/gif,image/webp",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(file, response) {
                $("#banner_id").val(response.banner_id);
            }
        });

    </script>
@endsection
