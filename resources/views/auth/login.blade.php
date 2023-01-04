<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Madrasah Izop</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="{{ asset('front/img/logo-kemenag.svg') }}" rel="icon">

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('front/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('front/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('front/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('front/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('front/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('front/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
    <link href="{{ asset('front/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{ asset('front/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('front/css/login.css') }}" rel="stylesheet">
</head>

<body>
    <div class="bg-login">
    </div>

    <div class="d-flex justify-content-center align-items-center" style="height: 91vh;">
            <div class="container">
                <div class="card shadow-lg login-card" style="border: none">
                    <div class="card-body card-login">
                        <form class="mt-4 pt-5 pb-2" method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="text-center mb-4">
                                <img src="{{ asset('front/img/logo-izop.svg') }}"
                                    class="me-2 img-fluid" style="height: 100%;">
                                <img src="{{ asset('front/img/logo-meqr.svg') }}"
                                    class="me-2 img-fluid" style="height: 100%;">
                            </div>
                            <h2 class="text-center mb-2 text-login">APLIKASI IZIN OPERASIONAL PENDIRIAN MADRASAH</h2>

                            <div class="input-group mb-3 {{ $errors->has('email') ? 'has-validation' : '' }}">
                                <span class="input-group-text" style="background: white; border-right: none" id="inputGroup-sizing-default"><i class='bx bx-user' style='color:#6370e7'></i></span>
                                <input style="border-left: none" type="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" placeholder="Email" name="email" value="{{ old('email') }}" id="email" required autofocus>
                                @if($errors->has('email'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('email') }}
                                    </div>
                                @endif
                            </div>


                            <div class="input-group mb-3 {{ $errors->has('password') ? 'has-validation' : '' }}">
                                <span class="input-group-text" style="background: white; border-right: none" id="inputGroup-sizing-default"><i class='bx bx-lock' style='color:#6370e7'></i></span>
                                <input style="border-left: none" type="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" placeholder="Password" name="password" id="password" required autocomplete="current-password">
                                @if($errors->has('password'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('password') }}
                                    </div>
                                @endif
                            </div>


                            <div class="d-grid mb-3">
                                <button class="btn btn-success" type="submit">Login</button>
                            </div>
                            <p class="small"><a class="text-primary text-white" href="#">Lupa Password?</a></p>
                        </form>
                        <hr style="border: 1px solid white">
                        <div>
                            <p class="small mb-0  text-center">Tidak Punya Akun? <a href="{{ route('register') }}" style="color: #FFE141">Buat Akun</a></p>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    <footer class="footer py-3 fixed-bottom d-flex w-100 align-content-center bg-light" style="background-color: #F5F5F5">
        <div class="container-fluid">
            <div class="row align-content-center d-sm-flex justify-content-center justify-content-sm-between mb-0 mt-3">
                <div class="col text-center">
                    <span class="text-muted d-inline-block text-sm-center">Copyright {{ Date('Y') }} ©Kementerian Agama Republik Indonesia All rights reserved.</span>
                </div>
            </div>
        </div>
    </footer>

    <!-- Vendor JS Files -->
    <script src="{{ asset('front/vendor/purecounter/purecounter_vanilla.js') }}"></script>
    <script src="{{ asset('front/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('front/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('front/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('front/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('front/vendor/php-email-form/validate.js') }}"></script>

    <!-- Template Main JS File -->
    <script src="{{ asset('front/js/main.js') }}"></script>

</body>

</html>
