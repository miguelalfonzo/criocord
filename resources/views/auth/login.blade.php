<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>{{ config('app.name') }} - Panel Administrativo</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Template Administrativo desarrollado para CRIOCORD" name="description" />
        <meta content="Criocord" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="imagenes/favicon.ico">


        <!-- Select  Boostrap css -->
        <link href="assets/libs/bootstrap-select/bootstrap-select.min.css" rel="stylesheet" type="text/css" />

        <!-- App css -->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/app.min.css" rel="stylesheet" type="text/css" />

    </head>

    <body class="authentication-bg  " style='background-image: url("imagenes/fondo_login.jpg");'>

        <div class="account-pages mt-5 mb-1 " >
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5" >
                        <div class="card rounded">

                            <div class="card-body p-4">
                                
                                <div class="text-center w-75 m-auto">
                                    <a target="_blank" href="https://www.ictc-peru.com/">
                                        
                                        <span><img src="imagenes/criocord_logo.png" alt="" height="28"></span>
                                    </a>
                                    <a target="_blank" href="https://www.ictc-peru.com/">
                                        
                                        <span><img src="imagenes/lazo_de_vida_logo.png" alt="" height="25"></span>
                                    </a>
                                    <p class="text-muted mb-4 mt-3">Ingresa tu correo y contraseña para acceder al panel administrativo</p>
                                </div>

                               {{--  <h5 class="auth-title">Acceso</h5> --}}

                                <form method="POST" action="{{ route('login') }}">

                                    @csrf

                                    <div class="form-group mb-3">
                                        <label for="email">Email</label>
                                        <input class="form-control @error('email') is-invalid @enderror" id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                         @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="password">Password</label>
                                         <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="cia">Compania</label>
                                         <select id="cia" name="cia" class="selectpicker" data-style="btn-purple">
                                                <option value="001" selected="true">Criocord</option>
                                                <option value="002">Lazo de Vida</option>
                                                
                                            </select>

                                        
                                    </div>

                                    {{-- <div class="form-group mb-3">
                                        <div class="custom-control custom-checkbox checkbox-info">
                                            <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}  class="custom-control-input" >
                                            <label class="custom-control-label" for="checkbox-signin">Recordar</label>
                                        </div>
                                    </div>
 --}}
                                    <div class="form-group mb-0 text-center">
                                        <button class="btn btn-success btn-block" type="submit"><i class="icon-login mr-2"></i> Acceder </button>
                                    </div>

                                </form>

                                <div class="text-center">
                                    <h5 class="mt-3 text-muted">Nuestras Redes</h5>
                                    <ul class="social-list list-inline mt-3 mb-0">
                                        <li class="list-inline-item">
                                            <a href="javascript: void(0);" class="social-list-item border-primary text-primary"><i class="mdi mdi-facebook"></i></a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="javascript: void(0);" class="social-list-item border-danger text-danger"><i class="mdi mdi-google"></i></a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="javascript: void(0);" class="social-list-item border-info text-info"><i class="mdi mdi-twitter"></i></a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="javascript: void(0);" class="social-list-item border-secondary text-secondary"><i class="mdi mdi-github-circle"></i></a>
                                        </li>
                                    </ul>
                                </div>

                            </div> <!-- end card-body -->
                        </div>
                        <!-- end card -->

                        <div class="row mt-3">
                            <div class="col-12 text-center">

                                 @if (Route::has('password.request'))
                                   <p> <a href="{{ route('password.request') }}" class="text-white ml-1">Olvidé mi contraseña</a></p>
                                @endif

                                
                               
                            </div> <!-- end col -->
                        </div>
                        <!-- end row -->

                    </div> <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end page -->


        <footer class="footer footer-alt text-white">
            2021 &copy; {{ config('app.name') }} - <a href="http://cayro.com.pe/" target="_blank" class="text-white">Desarrollado por CAYRO SOLUCIONES</a> 
        </footer>

        <!-- Vendor js -->
        <script src="assets/js/vendor.min.js"></script>

        <!-- Select  Boostrap js -->
        <script src="assets/libs/bootstrap-select/bootstrap-select.min.js"></script>

        <!-- App js -->
        <script src="assets/js/app.min.js"></script>
        
    </body>
</html>