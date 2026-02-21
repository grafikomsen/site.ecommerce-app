@extends('admin.app.app')
@section('content')
    <div class="bg-gray-100 p-4 m-4 rounded-sm shadow-md">
        <div class="flex items-center justify-between py-3">
            <div class="">
                <h4 class="m-0 fs-18 fw-semibold">Création de la catégorie</h4>
            </div>

            <nav aria-label="Breadcrumb">
                <ol class="flex items-center gap-1 text-sm text-gray-700">
                    <li>
                        <a href="{{ route('admin.dashboard') }}" class="block transition-colors hover:text-gray-900"> Dashboard </a>
                    </li>

                    <li class="rtl:rotate-180">
                        <svg xmlns="http://www.w3.org/2000/svg" class="size-4" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                    </li>

                    <li>
                        <a href="{{ route('admin.categorie') }}" class="block transition-colors hover:text-gray-900"> Catégorie </a>
                    </li>

                    <li class="rtl:rotate-180">
                    <svg xmlns="http://www.w3.org/2000/svg" class="size-4" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                    </svg>
                    </li>

                    <li>
                        Création de la catégorie
                    </li>
                </ol>
            </nav>
        </div>

        <!-- Form Validation -->
        <div class="pt-5">
            <!-- stard card header -->
            <div class="flex items-center justify-between py-8">
                <div class="">
                    <h5 class="mb-0 card-title">Browser Defaults</h5>
                </div>
                <div class="">
                    <a class=" bg-orange-500 text-orange-50 hover:bg-orange-600 px-3 py-2 rounded-sm" href="{{ route('admin.categorie') }}">Retour</a>
                </div>
            </div>
            <!-- end card header -->

            <!-- start card-body -->
            <div class="">
                <form name="categoryForm" id="categoryForm">

                    <div class="py-2">
                        <label for="name" class="text-sm font-medium text-gray-700">Category</label>
                        <input type="text" class="mt-0.5 w-full rounded border-gray-300 shadow-sm sm:text-sm" id="name" name="name" placeholder="Nom de la catégorie">
                        <p></p>
                    </div>
                    <div class="py-2">
                        <label for="slug" class="text-sm font-medium text-gray-700">Slug</label>
                        <input type="text" class="mt-0.5 w-full rounded border-gray-300 shadow-sm sm:text-sm" id="slug" name="slug" placeholder="Lien de la catégorie">
                        <p></p>
                    </div>


                    <div class="mt-4">
                        <label for="image">Image</label>
                        <input type="hidden" id="image_id" name="image_id" value="">
                        <div id="image" class="dropzone dz-clickable">
                            <div class="dz-message needsclick">
                                <br>Drop files here or click to upload.<br><br>
                            </div>
                        </div>
                    </div>


                    <div class="mt-4">
                        <label for="showHome" class="text-sm font-medium text-gray-700">Affichage</label>
                        <select class="mt-0.5 w-full rounded border-gray-300 shadow-sm sm:text-sm" id="showHome" name="showHome">
                            <option value="Oui">Oui</option>
                            <option value="Non">Non</option>
                        </select>
                    </div>
                    <div class="mt-4">
                        <label for="status" class="text-sm font-medium text-gray-700">Statut</label>
                        <select class="mt-0.5 w-full rounded border-gray-300 shadow-sm sm:text-sm" id="status" name="status">
                            <option value="1">Activé</option>
                            <option value="0">desactivé</option>
                        </select>
                    </div>
                    <div class="mt-4 rounded-sm">
                        <button class="bg-orange-500 text-white px-3 py-2 hover:bg-orange-600" type="submit">Sauvegardez</button>
                    </div>
                </form>
            </div>
            <!-- end card-body -->
        </div>
        <!-- end card-->
    </div>
@endsection

@section('backendJs')
    <script>

        $('#categoryForm').submit(function(e) {
            e.preventDefault();
            let element = $(this);
            $("button[type=submit]").prop('desabled', true);

            $.ajax({
                url: '{{ route("admin.categorie.store") }}',
                type: 'POST',
                data: element.serializeArray(),
                dataType: 'json',
                success: function (response) {
                    $("button[type=submit]").prop('desabled', false);

                    if(response['status'] == true){

                        window.location.href="{{ route('admin.categorie') }}";

                        $('#name')
                            .removeClass('is-invalid')
                            .sibling('p')
                            .removeClass('invalid-feedback')
                            .html('');

                        $('#slug')
                            .removeClass('is-invalid')
                            .siblings('p')
                            .removeClass('invalid-feedback')
                            .html('');

                    } else {

                        let errors = response['errors'];

                        // NAME
                        if (errors['name']) {
                            $('#name').addClass('is-invalid')
                                .siblings('p')
                                .addClass('invalid-feedback').html(errors['name']);
                        } else {
                            $('#name').removeClass('is-invalid')
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

        $('#name').change(function() {
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

    </script>
@endsection
