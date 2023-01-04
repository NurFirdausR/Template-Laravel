<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Icons -->
    <link rel="shortcut icon" href="{{ asset('front/img/logo-kemenag.svg') }}" />
    <link rel="stylesheet" href="{{ asset('skydash/vendors/feather/feather.css') }}">
    <link rel="stylesheet" href="{{ asset('skydash/vendors/ti-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('skydash/vendors/simple-line-icons/css/simple-line-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('skydash/vendors/css/vendor.bundle.base.css') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

    <!-- Datatables -->
    <link rel="stylesheet" href="{{ asset('skydash/vendors/datatables.net-bs4/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('skydash/js/select.dataTables.min.css') }}">

    <!-- IziToast -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/css/iziToast.min.css">

    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('skydash/vendors/select2/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('skydash/vendors/select2-bootstrap-theme/select2-bootstrap.min.css') }}">

    <!-- Datepicker -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" integrity="sha512-mSYUmp1HYZDFaVKK//63EcZq4iFWFjxSL+Z3T/aCt4IO9Cejm03q3NKKYN6pFQzY0SBOr8h+eCIAZHPXcpZaNw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Summernote -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">

    <!-- Main css -->
    <link rel="stylesheet" href="{{ asset('skydash/css/vertical-layout-light/style.css') }}">

    <!-- Custom style / layouts -->
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">

    {{-- <link href="https://code.jquery.com/ui/1.11.3/themes/smoothness/jquery-ui.css" /> --}}

    {!! ReCaptcha::htmlScriptTagJsApi() !!}

    @stack('css')
</head>

<body>
    <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->
        @include('layouts.partials.header')
        <!-- partial -->

        <div class="container-fluid page-body-wrapper">

            <!-- partial:partials/_sidebar.html -->
            @include('layouts.partials.sidebar')


            <!-- partial -->

            <div class="main-panel">
                <div class="content-wrapper">
                    @yield('content')
                </div>

                <!-- content-wrapper ends -->
                <!-- partial:partials/_footer.html -->
                @include('layouts.partials.footer')
                <!-- partial -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->

    <!-- Vendor JS -->
    <script src="{{ asset('skydash/vendors/js/vendor.bundle.base.js') }}"></script>

    <!-- Cart JS -->
    <script src="{{ asset('skydash/vendors/chart.js/Chart.min.js') }}"></script>

    <!-- Datatables -->
    <script src="{{ asset('skydash/vendors/datatables.net/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('skydash/vendors/datatables.net-bs4/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ asset('skydash/js/dataTables.select.min.js') }}"></script>

    <!-- IziToast -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/js/iziToast.min.js"></script>

    <!-- Select2 -->
    <script src="{{ asset('skydash/vendors/select2/select2.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/js/bootstrap-select.min.js" integrity="sha512-yDlE7vpGDP7o2eftkCiPZ+yuUyEcaBwoJoIhdXv71KZWugFqEphIS3PU60lEkFaz8RxaVsMpSvQxMBaKVwA5xg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- Datepicker -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- Summertnote -->
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

    <!-- End plugin js for all page -->
    <script src="{{ asset('skydash/js/off-canvas.js') }}"></script>
    <script src="{{ asset('skydash/js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('skydash/js/template.js') }}"></script>
    <!-- endinject -->

    {{-- <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script> --}}

    <!-- Custom js spesific app -->
    <script src="{{ asset('js/custom.js') }}"></script>
    <script src="{{ asset('js/modal-crud.js') }}"></script>

    <!-- Flot Chart -->
    <script src="{{ asset('skydash/vendors/flot/jquery.flot.js') }}"></script>
    <script src="{{ asset('skydash/vendors/flot/jquery.flot.resize.js') }}"></script>
    <script src="{{ asset('skydash/vendors/flot/jquery.flot.categories.js') }}"></script>
    <script src="{{ asset('skydash/vendors/flot/jquery.flot.fillbetween.js') }}"></script>
    <script src="{{ asset('skydash/vendors/flot/jquery.flot.stack.js') }}"></script>
    <script src="{{ asset('skydash/vendors/flot/jquery.flot.pie.js') }}"></script>
    <script src="{{ asset('skydash/js/flot-chart.js') }}"></script>

    @stack('js')

    @yield('css_form_dinamis')

    @yield('js_form_dinamis')
    @yield('js_select_wilayah')

    <script>
    @if (session()->has('success_msg')) showAlert("{{ session('success_msg') }}", 'success')
    @elseif(session()->has('error_msg')) showAlert("{{ session('error_msg') }}", 'error')
    @elseif(session()->has('warning_msg')) showAlert("{{ session('warning_msg') }}", 'warning')
    @endif
    </script>
</body>

</html>
