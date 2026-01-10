@extends('admin.app.app')
@section('content')
    <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
        <div class="flex-grow-1">
            <h4 class="m-0 fs-18 fw-semibold">Création de la catégorie</h4>
        </div>

        <div class="text-end">
            <ol class="py-0 m-0 breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.categorie') }}">Catégorie</a></li>
                <li class="breadcrumb-item active">Création de la catégorie</li>
            </ol>
        </div>
    </div>

    <!-- Form Validation -->
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                            <h5 class="mb-0 card-title">Browser Defaults</h5>
                        </div>
                        <div class="col-md-6">
                            <a class="btn btn-danger btn-sm float-end" href="{{ route('admin.categorie') }}">Retour</a>
                        </div>
                    </div>
                </div><!-- end card header -->

                <div class="card-body">
                    <form name="categoryForm" id="categoryForm" class="row g-3">
                        <div class="col-md-6">
                            <label for="name" class="form-label">Category</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Nom de la catégorie">
                            <p></p>
                        </div>
                        <div class="col-md-6">
                            <label for="slug" class="form-label">Slug</label>
                            <input type="text" class="form-control" id="slug" name="slug" placeholder="Lien de la catégorie">
                            <p></p>
                        </div>
                        <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="image">Image</label>
                                    <input type="hidden" id="image_id" name="image_id" value="">
                                    <div id="image" class="dropzone dz-clickable">
                                        <div class="dz-message needsclick">
                                            <br>Drop files here or click to upload.<br><br>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <div class="col-md-6">
                            <label for="showHome" class="form-label">Affichage</label>
                            <select class="form-select" id="showHome" name="showHome">
                                <option value="Oui">Oui</option>
                                <option value="Non">Non</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="status" class="form-label">Statut</label>
                            <select class="form-select" id="status" name="status">
                                <option value="1">Activé</option>
                                <option value="0">desactivé</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <button class="btn btn-primary" type="submit">Sauvegardez</button>
                        </div>
                    </form>
                </div> <!-- end card-body -->
            </div> <!-- end card-->
        </div> <!-- end col -->
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
