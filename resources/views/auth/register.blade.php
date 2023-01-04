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
    <link href="{{ asset('front/css/register.css') }}" rel="stylesheet">
</head>

<body>
    <div class="bg-login">
    </div>

    <div class="d-flex justify-content-center align-items-center" style="height: 91vh;">
            <div class="container">
                <div class="card shadow-lg login-card" style="border: none">
                    <div class="card-body card-login">
                        <form class="py-4" method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="text-center mb-4">
                                <img src="{{ asset('front/img/logo-izop.svg') }}"
                                    class="me-2 img-fluid" style="height: 100%;">
                                <img src="{{ asset('front/img/logo-meqr.svg') }}"
                                    class="me-2 img-fluid" style="height: 100%;">
                            </div>
                            <h2 class="text-center mb-4 text-login">PENDAFTARAN AKUN APLIKASI IZIN OPERASIONAL PENDIRIAN MADRASAH</h2>

                            <div class="row my-3">
                                <div class="col-lg-4">
                                    <x-form-input label="Nama Organisasi/Yayasan" value="{{ old('nama_organisasi') }}" type="text" name="nama_organisasi" id="nama_organisasi" class="nama_organisasi" list-option="" :label-required="true"></x-form-input>
                                </div>
                                <div class="col-lg-4">
                                    <x-form-input label="E-mail" value="{{ old('email') }}" type="text" name="email" id="email" class="email" list-option="" :label-required="true"></x-form-input>
                                </div>
                                <div class="col-lg-4">
                                    <x-form-input label="Telepon" value="{{ old('telepon') }}" type="number" name="telepon" id="telepon" class="telepon" list-option="" :label-required="true"></x-form-input>
                                </div>
                            </div>

                            <div class="row my-3">
                                <div class="col-lg-3">
                                    <x-select-wilayah :isInline="false" listType="provinsi" label="Provinsi" value="{{ old('provinsi_id') }}" name="provinsi_id" id="provinsi_id" targetId="#kabupaten_id" :labelRequired="true"></x-select-wilayah>
                                </div>
                                <div class="col-lg-3">
                                    <x-select-wilayah :isInline="false" listType="kabupaten" label="Kabupaten" value="{{ old('kabupaten_id') }}" name="kabupaten_id" id="kabupaten_id" targetId="#kecamatan_id" :labelRequired="true"></x-select-wilayah>
                                </div>
                                <div class="col-lg-3">
                                    <x-select-wilayah :isInline="false" listType="kecamatan" label="Kecamatan" value="{{ old('kecamatan_id') }}" name="kecamatan_id" id="kecamatan_id" targetId="#kelurahan_id" :labelRequired="true"></x-select-wilayah>
                                </div>
                                <div class="col-lg-3">
                                    <x-select-wilayah :isInline="false" listType="kelurahan" label="Kelurahan" value="{{ old('kelurahan_id') }}" name="kelurahan_id" id="kelurahan_id" targetId="" :labelRequired="true"></x-select-wilayah>
                                </div>
                            </div>

                            <div class="row my-3">
                                <div class="col-lg-3">
                                    <x-form-input label="Kata sandi" value="{{ old('password') }}" type="password" name="password" id="password" class="password" list-option="" :label-required="true"></x-form-input>
                                    <span class="text-danger text-small">* minimal 8 karakter</span>
                                </div>
                                <div class="col-lg-3">
                                    <x-form-input label="Konfirmasi kata sandi" value="{{ old('password_confirmation') }}" type="password" name="password_confirmation" id="password_confirmation" class="password_confirmation" list-option="" :label-required="true"></x-form-input>
                                </div>
                            </div>

                            <div class="row my-3">
                                <div class="col-lg-12">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="kotak_centang" name="kotak_centang" value="1" {{ old('kotak_centang') == 1 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="kotak_centang">
                                            Saya menyatakan bahwa semua data yang saya isi adalah benar dan dapat saya pertanggung jawabkan, Saya juga setuju jika data yang saya isi tidak sesuai maka akun saya akan diblokir dan pendaftaran dibatalkan
                                        </label>
                                    </div>
                                    @error('kotak_centang')
                                        <div class="invalid-feedback d-block">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <button class="btn btn-success float-end" type="submit">Buat Akun</button>
                                    <a href="{{ route('login') }}" class="btn text-white btn-warning float-end me-2">Login</a>
                                </div>
                            </div>
                        </form>
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

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

    <!-- Template Main JS File -->
    <script src="{{ asset('front/js/main.js') }}"></script>

    @yield('js_select_wilayah')
</body>

</html>
