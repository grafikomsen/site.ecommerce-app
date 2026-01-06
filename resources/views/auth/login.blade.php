
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>

        <meta charset="utf-8" />
        <title>Log In | Tapeli - Responsive Admin Dashboard Template</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc."/>
        <meta name="author" content="Zoyothemes"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">

        <!-- App css -->
        <link href="{{ asset('admin/assets/css/app.min.css') }}" rel="stylesheet" type="text/css" id="app-style" />

        <!-- Icons -->
        <link href="{{ asset('admin/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />

    </head>

    <body class="bg-white">
        <!-- Begin page -->
        <div class="account-page">
            <div class="p-0 container-fluid">
                <div class="row align-items-center g-0">
                    <div class="col-xl-5">
                        <div class="row">
                            <div class="mx-auto col-md-7">
                                <div class="p-4 mb-0 border-0 p-md-5 p-lg-0">
                                    <div class="p-0 mb-4">
                                        <a href="index.html" class="auth-logo">
                                            <img src="{{ asset('admin/assets/images/logo-dark.png') }}" alt="logo-dark" class="mx-auto" height="28" />
                                        </a>
                                    </div>

                                    <div class="pt-0">
                                        <form class="my-4" method="POST" action="{{ route('login') }}">
                                            @csrf

                                            <div class="mb-3 form-group">
                                                <label for="email" class="form-label">Email address</label>
                                                <input class="form-control" type="email" id="email" name="email" :value="old('email')" placeholder="Enter your email">
                                                @error('email')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <div class="mb-3 form-group">
                                                <label for="password" class="form-label">Password</label>
                                                <input class="form-control" type="password" id="password" name="password" placeholder="Enter your password">
                                                @error('password')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <div class="mb-3 form-group d-flex">
                                                <div class="col-sm-6">
                                                    <div class="form-check">
                                                        <input  id="remember_me" type="checkbox" class="form-check-input" name="remember" checked>
                                                        <label class="form-check-label" for="remember_me">Souviens-toi de moi</label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 text-end">
                                                    @if (Route::has('password.request'))
                                                        <a class='text-muted fs-14' href="{{ route('password.request') }}">
                                                            Mot de passe oublié ?
                                                        </a>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="mb-0 form-group row">
                                                <div class="col-12">
                                                    <div class="d-grid">
                                                        <button class="btn btn-primary" type="submit"> Se connecter </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>

                                        <div class="mb-4 text-center text-muted">
                                            <p class="mb-0">Vous n avez pas de compte ? <a class='text-primary ms-2 fw-medium' href="{{ route('register') }}">Inscrivez-vous</a></p>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-7">
                        <div class="p-4 account-page-bg p-md-5">
                            <div class="text-center">
                                <h3 class="mb-3 text-dark pera-title">Quick, Effective, and Productive With Tapeli Admin Dashboard</h3>
                                <div class="auth-image">
                                    <img src="{{ asset('admin/assets/images/authentication.svg') }}" class="mx-auto img-fluid"  alt="images">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- END wrapper -->

        <!-- Vendor -->
        <script src="{{ asset('admin/assets/libs/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('admin/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('admin/assets/libs/simplebar/simplebar.min.js') }}"></script>
        <script src="{{ asset('admin/assets/libs/node-waves/waves.min.js') }}"></script>
        <script src="{{ asset('admin/assets/libs/waypoints/lib/jquery.waypoints.min.js') }}"></script>
        <script src="{{ asset('admin/assets/libs/jquery.counterup/jquery.counterup.min.js') }}"></script>
        <script src="{{ asset('admin/assets/libs/feather-icons/feather.min.js') }}"></script>

        <!-- App js-->
        <script src="{{ asset('admin/assets/js/app.js') }}"></script>

    </body>
</html>
