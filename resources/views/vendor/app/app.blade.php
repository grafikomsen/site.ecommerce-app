<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'eshop') }}</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <link rel="stylesheet" type="text/css" href="{{ asset('admin/assets/select2/css/select2.min.css') }}" />
        <link rel="stylesheet" type="text/css" href="{{ asset('admin/assets/dropzone/min/dropzone.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('frontend-assets/fontawesome/css/all.min.css') }}" />
    </head>
    <body class="font-poppins">
        <div class="grid grid-cols-1 gap-4 lg:grid-cols-[230px_1fr]">
            <div class="">
                @include('vendor.app.sideBar')
            </div>
            <div class="">
                @include('vendor.app.topBar')
                @yield('content')
            </div>
        </div>

        <!-- jquery js -->
        <script src="{{ asset('admin/assets/libs/jquery/jquery.min.js') }}"></script>

        <!-- dropzone js -->
        <script src="{{ asset('admin/assets/dropzone/min/dropzone.min.js') }}"></script>

        <!-- Select2 -->
        <script src="{{ asset('admin/assets/select2/js/select2.min.js') }}"></script>

        <script type="text/javascript">
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $(document).ready(function(){
                $(".summernote").summernote({
                    height: 200
                });
            });
        </script>

        @yield('backendJs')
    </body>
</html>
