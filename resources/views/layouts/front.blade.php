<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>@yield('title')</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta content="" name="keywords" />
    <meta content="" name="description" />

    <!-- Favicon -->
    <link href="{{ asset('skydash/images/fav.ico') }}" rel="icon" />

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500&family=Quicksand:wght@600;700&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('skydash/vendors/ti-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('skydash/vendors/feather/feather.css') }}">
    <link rel="stylesheet" href="{{ asset('skydash/vendors/simple-line-icons/css/simple-line-icons.css') }}">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet" />

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('front/lib/animate/animate.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('front/lib/lightbox/css/lightbox.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('front/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('front/css/bootstrap.min.css') }}" rel="stylesheet" />

    <!-- Template Stylesheet -->
    <link href="{{ asset('front/css/style.css') }}" rel="stylesheet" />

    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('skydash/vendors/select2/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('skydash/vendors/select2-bootstrap-theme/select2-bootstrap.min.css') }}">

    {!! ReCaptcha::htmlScriptTagJsApi() !!}


    @stack('css')

    <style>
        .text-footer-right {
            /* font-family: 'Inter'; */
            font-style: normal;
            font-weight: 400;
            font-size: 12px;
        }

        .text-footer-left {
            /* font-family: 'Inter'; */
            font-style: normal;
            font-weight: 400;
            font-size: 12px;
            color: #6B7280;
        }

        .text-gradient {
            background: linear-gradient(270.22deg, #EA5A2D 0%, #CB174D 86.31%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            text-fill-color: transparent;

        }
    </style>
</head>

<body class="d-flex flex-column min-vh-100">
    <!-- Spinner Start -->
    <div id="spinner"
        class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- Spinner End -->

    <!-- Topbar Start -->
    {{-- <div class="container-fluid bg-light p-0 wow fadeIn" data-wow-delay="0.1s">
        <div class="row gx-0 d-none d-lg-flex">
            <div class="col-lg-7 px-5 text-start">
                <div class="h-100 d-inline-flex align-items-center py-3 me-4">
                    <small class="fa fa-map-marker-alt text-primary me-2"></small>
                    <small>123 Street, New York, USA</small>
                </div>
                <div class="h-100 d-inline-flex align-items-center py-3">
                    <small class="far fa-clock text-primary me-2"></small>
                    <small>Mon - Fri : 09.00 AM - 09.00 PM</small>
                </div>
            </div>
            <div class="col-lg-5 px-5 text-end">
                <div class="h-100 d-inline-flex align-items-center py-3 me-4">
                    <small class="fa fa-phone-alt text-primary me-2"></small>
                    <small>+012 345 6789</small>
                </div>
                <div class="h-100 d-inline-flex align-items-center">
                    <a class="btn btn-sm-square bg-white text-primary me-1" href=""><i
                            class="fab fa-facebook-f"></i></a>
                    <a class="btn btn-sm-square bg-white text-primary me-1" href=""><i
                            class="fab fa-twitter"></i></a>
                    <a class="btn btn-sm-square bg-white text-primary me-1" href=""><i
                            class="fab fa-linkedin-in"></i></a>
                    <a class="btn btn-sm-square bg-white text-primary me-0" href=""><i
                            class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
    </div> --}}
    <!-- Topbar End -->

    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg bg-white navbar-light sticky-top py-lg-0 px-4 px-lg-5 wow fadeIn"
        data-wow-delay="0.1s" style="background: linear-gradient(270.22deg, #EA5A2D 0%, #CB174D 86.31%);">
        <a href="{{ url('/') }}" class="navbar-brand p-0">
            <img class="img-fluid me-3" src="{{ asset('front/img/icon.png') }}" alt="Icon" />
            {{-- <h1 class="m-0 text-primary">Zoofari</h1> --}}
        </a>
        <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse py-4 py-lg-0" id="navbarCollapse">
            <div class="navbar-nav ms-auto">
                <a href="{{ url('/') }}#" class="nav-item nav-link">Home</a>
                <a href="{{ url('/') }}#panduan" class="nav-item nav-link">Panduan</a>
                <a href="{{ url('/') }}#bantuan" class="nav-item nav-link">Bantuan</a>
                {{-- <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Pages</a>
                    <div class="dropdown-menu rounded-0 rounded-bottom m-0">
                        <a href="#" class="dropdown-item">Our Animals</a>
                        <a href="#" class="dropdown-item">Membership</a>
                        <a href="#" class="dropdown-item">Visiting Hours</a>
                        <a href="#" class="dropdown-item">Testimonial</a>
                        <a href="#" class="dropdown-item">404 Page</a>
                    </div>
                </div> --}}
                {{-- <a href="#" class="nav-item nav-link">Contact</a> --}}
            </div>
            <a href="{{ route('login') }}" class="btn btn-outline-light px-3" style="border-radius: 5px">Login</a>
        </div>
    </nav>
    <!-- Navbar End -->

    @yield('content')

    <!-- Footer Start -->
    <div class="container-fluid footer bg-red text-light footer mt-5 wow fadeIn mt-auto" style="background: #F7F7F7;"
        data-wow-delay="0.1s">

        @stack('bantuan')

        <div class="container text-dark">
            <div class="copyright">
                <div class="row">
                    <div class="col-md-6 text-center text-footer-left text-md-start mb-3 mb-md-0">
                        &copy; 2020 PT Telkom Indonesia (Persero) Tbk. Hak Cipta Dilindungi Undang-Undang
                    </div>
                    <div class="col-md-6 text-center text-footer-right text-md-end">
                        <span style="color: #9C9C9C;">Divisi Solution Delivery & Assurance 2022</span>
                        <br>
                        <span class="text-gradient">40337@telkom.co.id</span>
                        <br>
                        <span class="text-gradient">tlkm.id/ITPPSDA</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->
    @stack('back-to-top')
    <!-- Vendor JS -->
    <script src="{{ asset('skydash/vendors/js/vendor.bundle.base.js') }}"></script>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('front/lib/wow/wow.min.js') }}"></script>
    <script src="{{ asset('front/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('front/lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('front/lib/counterup/counterup.min.js') }}"></script>
    <script src="{{ asset('front/lib/owlcarousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('front/lib/lightbox/js/lightbox.min.js') }}"></script>

    <!-- Template Javascript -->
    <script src="{{ asset('front/js/main.js') }}"></script>

    @stack('scripts')
</body>

</html>
