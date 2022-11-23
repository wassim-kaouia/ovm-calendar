<!doctype html>
<html lang="en">

    <head>
        
        <meta charset="utf-8" />
        <title>Login 2 | Skote - Admin & Dashboard Template</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="Themesbrand" name="author" />
        <!-- App favicon -->
        {{-- <link rel="shortcut icon" href="assets/images/favicon.ico"> --}}

        <!-- owl.carousel css -->
        <link rel="stylesheet" href="assets/libs/owl.carousel/assets/owl.carousel.min.css">

        <link rel="stylesheet" href="assets/libs/owl.carousel/assets/owl.theme.default.min.css">

        <!-- Bootstrap Css -->
        <link href="assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />

    </head>

    <body class="auth-body-bg">
        <div>
            <div class="container-fluid p-0">
                <div class="row g-0">         
                    <div class="col-xl-9">
                        <div class="auth-full-bg pt-lg-5 p-4">
                            <div class="w-100">
                                <div class="bg-overlay"></div>
                                <div class="d-flex h-100 flex-column">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end col -->
                    <div class="col-xl-3">
                        <div class="auth-full-page-content p-md-5 p-4">
                            <div class="w-100">
                                <div class="d-flex flex-column h-100">
                                    <div class="mb-4 mb-md-5">
                                        <a href="index.html" class="d-block auth-logo">
                                            <img src="{{ asset('/assets/images/logo-ovm.png') }}" alt="" height="50" class="auth-logo-dark">
                                            {{-- <img src="assets/images/logo-light.png" alt="" height="18" class="auth-logo-light"> --}}
                                        </a>
                                    </div>
                                    <div class="my-auto">
                                        <div>
                                            <h5 class="text-primary">Bonjour!</h5>
                                            <p class="text-muted">Login sur votre Calendrier</p>
                                        </div>
                                        <div class="mt-4">
                                            <form method="POST" action="{{ route('login') }}">
                                                @csrf
                                                <div class="mb-3">
                                                    <label for="email" class="form-label">Email</label>
                                                    <input type="text" class="form-control" id="email" name="email" placeholder="">
                                                    @error('email')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <div class="float-end">
                                                        @if (Route::has('password.request'))
                                                        <a class="text-muted" href="{{ route('password.request') }}">
                                                            {{ __('mot de passe oublié ?') }}
                                                        </a>
                                                        @endif
                                                    </div>
                                                    <label class="form-label">Password</label>
                                                    <div class="input-group auth-pass-inputgroup">
                                                        <input type="password" class="form-control" placeholder="Enter password" aria-label="Password" name="password" aria-describedby="password-addon">
                                                        <button class="btn btn-light " type="button" id="password-addon"><i class="mdi mdi-eye-outline"></i></button>
                                                        @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                        @enderror
                                                    </div>
                                                </div>               
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="remember-check">
                                                    <label class="form-check-label" for="remember-check">
                                                        Remember me
                                                    </label>
                                                </div>
                                                <div class="mt-3 d-grid">
                                                    <button class="btn btn-primary waves-effect waves-light" type="submit">Log In</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="mt-4 mt-md-5 text-center">
                                        <p class="mb-0">© <script>document.write(new Date().getFullYear())</script> WassCalendario <i class="mdi mdi-heart text-danger"></i> by Wassim Kaouia For OVM Aka Memory rituals LTD</p>
                                    </div>
                                </div>           
                            </div>
                        </div>
                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container-fluid -->
        </div>
        <!-- JAVASCRIPT -->
        <script src="assets/libs/jquery/jquery.min.js"></script>
        <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="assets/libs/metismenu/metisMenu.min.js"></script>
        <script src="assets/libs/simplebar/simplebar.min.js"></script>
        <script src="assets/libs/node-waves/waves.min.js"></script>
        <!-- owl.carousel js -->
        <script src="assets/libs/owl.carousel/owl.carousel.min.js"></script>
        <!-- auth-2-carousel init -->
        <script src="assets/js/pages/auth-2-carousel.init.js"></script>
        <!-- App js -->
        <script src="assets/js/app.js"></script>
    </body>
</html>

