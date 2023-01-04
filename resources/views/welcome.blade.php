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
</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="fixed-top d-flex align-items-center header-transparent">
        <div class="container d-flex align-items-center justify-content-between">

            <div class="logo">
                <h1>
                    <a href="index.html">
                        <span>
                            <img src="{{ asset('front/img/logo-izop.svg') }}" class="me-2 img-fluid"
                                style="height: 5vh;">
                            <img src="{{ asset('front/img/logo-meqr.svg') }}" class="me-2 img-fluid"
                                style="height: 5vh;">
                            <img src="{{ asset('front/img/logo-bsre.svg') }}" class="img-fluid" style="height: 5vh;">
                        </span>
                    </a>
                </h1>
            </div>

            <nav id="navbar" class="navbar">
                <ul>
                    <li><a class="nav-link scrollto active" href="#hero">Home</a></li>
                    <li><a class="nav-link scrollto me-4" href="#counts">Tentang Kami</a></li>
                    <li><a href="{{ route('login') }}" class="btn btn-outline-success px-4">Login</a></li>
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav><!-- .navbar -->

        </div>
    </header><!-- End Header -->

    <!-- ======= Hero Section ======= -->
    <section id="hero">

        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-7 pt-5 pt-lg-0 order-2 order-lg-1 d-flex align-items-center">
                    <div data-aos="zoom-out">
                        <h1>IZIN OPERASIONAL PENDIRIAN MADRASAH (IZOP)</h1>
                        <h2>Selamat datang di layanan Izin Operasional Pendirian Madrasah Kementerian Agama Republik
                            Indonesia</h2>
                        <div class="text-center text-lg-start">
                            <a href="{{ route('login') }}"
                                class="btn btn-warning px-4 py-2 m-4 text-white scrollto">Login</a>
                            <a href="{{ route('register') }}" class="btn btn-success px-4 py-2 scrollto">Buat Akun Baru</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 order-1 order-lg-2">
                    <img src="{{ asset('front/img/hero-img.svg') }}" style="height: 85vh;" class="img-fluid"
                        alt="">
                </div>
            </div>
        </div>

    </section>
    <!-- End Hero -->

    <main id="main">
        <!-- ======= Counts Section ======= -->
        <section id="counts" class="counts">
            <div class="container">

                <div class="card p-5" style="background: #FFFFFF; box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.25); border-radius: 10px; border: none;">
                    <h3 style="font-weight: 700; font-size: 28px; line-height: 100%;" class="text-center my-5">
                        <span class="underline underline--green">Kat</span>egori Madrasah
                    </h3>
                    <div class="row" data-aos="fade-up">
                            <h4 class="text-dark mb-3">
                                <span style="border-bottom: 4px solid black;">Mad</span>rasah
                            </h4>
                            <br>
                            <div class="row mb-5" data-aos="fade-up">
                                <div class="col-lg-4 col-md-6">
                                    <div class="card sub-card-slider p-2"
                                        style="border-radius: 12px; border: none;">
                                        <div class="card-body">
                                            <img src="" alt=""
                                                style="height: 3rem;">
                                            <h5 class="card-title my-4" style="font-weight: bold;">MADRASAH
                                            </h5>
                                            <p class="card-text text-justify">
                                                Lorem ipsum dolor, sit amet consectetur adipisicing elit. In debitis dignissimos, minus officia perspiciatis unde exercitationem quae natus, vero aperiam pariatur nisi quam necessitatibus illum neque expedita voluptatibus iure? Quos?
                                            </p>
                                            <a href="" class="mt-4 btn text-white">Lebih Lengkap <i class="bi bi-chevron-right ms-2"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>

            </div>
        </section>
        <!-- End Counts Section -->
    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <footer id="footer">
        <div class="footer-top">
            <div class="container">

                <div class="row">
                    <div class="col">
                        <div class="image my-5">
                            <img src="{{ asset('front/img/logo-kemenag-text.svg') }}" class="me-2 mb-2"style="height: 8vh;">
                            <img src="{{ asset('front/img/logo-meqr.svg') }}" class="me-2 mb-2" style="height: 8vh;">
                            <img src="{{ asset('front/img/logo-izop.svg') }}" style="height: 8vh;">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-5 col-md-6">
                        <h4>Direktorat Kurikulum, Sarana, Kelembagaan, dan Kesiswaan Madrasah</h4>
                        <p style="font-weight: 500; font-size: 14px; line-height: 20px;">
                            Gedung Kementerian Agama RI Lt. 6, <br>
                            Jalan Lapangan Banteng Barat No. 3-4 Jakarta
                        </p>
                        <p><span
                                style="font-weight: 700; font-size: 16px; line-height: 25px; color: #20A072;">0811-4740-2020</span>
                            (whatsapp only)</p>
                        <a href="mailto:helpdesk.madrasah@kemenag.go.id"
                            style="color: #3CB8DF;">helpdesk.madrasah@kemenag.go.id</a>
                    </div>

                    <div class="col-lg-3 col-md-6 footer-links">
                        <h4>Layanan Madrasah</h4>
                        <ul>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">RKAM Madrasah</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Ijin Operasional Swasta</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Ijin Operasional Negeri</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Ijin Penegrian</a></li>
                        </ul>
                    </div>

                    <div class="col-lg-4 col-md-6 footer-links">
                        <h4>Link Terkait</h4>
                        <ul>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Republik Indonesia</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Kementerian Agama RepublikIndonesia</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Direktorat Jenderal PendidikanIslam</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Direktorat KSKK</a></li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>

        <div class="container">
            <div class="copyright">
                Copyright {{ DATE('Y') }} ©Kementerian Agama Republik Indonesia All rights reserved.
            </div>
            <!-- <div class="credits">
                Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
            </div> -->
        </div>
    </footer><!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>
    <div id="preloader"></div>

    <!-- Vendor JS Files -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

    <script src="{{ asset('front/vendor/purecounter/purecounter_vanilla.js') }}"></script>
    <script src="{{ asset('front/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('front/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('front/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('front/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('front/vendor/php-email-form/validate.js') }}"></script>

    <!-- Template Main JS File -->
    <script src="{{ asset('front/js/main.js') }}"></script>

    <script>
        $(document).ready(function() {
            $( ".sub-card-slider" ).hover(
            function() {
                $(this).addClass('shadow-lg').css('cursor', 'pointer');
            }, function() {
                $(this).removeClass('shadow-lg');
            }
            );
        });
    </script>
</body>

</html>
