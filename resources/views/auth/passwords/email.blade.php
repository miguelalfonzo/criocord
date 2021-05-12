<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>{{ config('app.name') }} - Recuperar Cuenta</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
         <meta content="Template Administrativo desarrollado para CRIOCORD" name="description" />
        <meta content="Criocord" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{asset('imagenes/favicon.ico')}}">

        <!-- App css -->

        <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/css/app.min.css')}}" rel="stylesheet" type="text/css" />

    </head>

    <body class="authentication-bg "  style='background-image: url("../imagenes/fondo_login.jpg");'>

        <div class="account-pages mt-5 mb-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card">

                            <div class="card-body p-4">
                                
                                <div class="text-center w-75 m-auto">
                                     <a target="_blank" href="https://www.ictc-peru.com/">
                                        
                                        <span><img src="{{asset('imagenes/criocord_logo.png')}}" alt="" height="28"></span>
                                    </a>
                                    <a target="_blank" href="https://www.ictc-peru.com/">
                                        
                                        <span><img src="{{asset('imagenes/lazo_de_vida_logo.png')}}" alt="" height="25"></span>
                                    </a>
                                    <p class="text-muted mb-4 mt-3">Ingresa tu correo y te mandaremos un email para la recuperación de cuenta</p>
                                </div>

                                <h5 class="auth-title">Recuperar Cuenta</h5>

                                @if (session('status'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('status') }}
                                    </div>
                                @endif

                                <form method="POST" action="{{ route('password.email') }}">
                                    @csrf

                                    <div class="form-group mb-3">
                                        <label for="email">Email</label>
                                         <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                         @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group mb-0 text-center">
                                        <button class="btn btn-success btn-block" type="submit"> Restablecer Password </button>
                                    </div>

                                </form>    

                            </div> <!-- end card-body -->
                        </div>
                        <!-- end card -->

                        <div class="row mt-3">
                            <div class="col-12 text-center">
                                <p class="text-white">Regresar al <a href="{{url('/login')}}" class="text-muted ml-1"><b class="font-weight-semibold text-dark">Login</b></a></p>
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

        <script src="{{asset('assets/js/vendor.min.js')}}"></script>

        <!-- App js -->
        <script src="{{asset('assets/js/app.min.js')}}"></script>
        
    </body>
</html>