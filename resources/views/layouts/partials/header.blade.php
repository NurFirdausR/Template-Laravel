<nav class="navbar navbar-danger col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo mr-5" href="{{ route('dashboard') }}"><img src="{{ asset('front/img/logo-izop-white.svg') }}"
                class="mr-2" alt="logo" /></a>
        <a class="navbar-brand brand-logo-mini" href="{{ route('dashboard') }}"><img
                src="{{ asset('front/img/logo-izop-white-mini.svg') }}" alt="logo" /></a>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="icon-menu"></span>
        </button>
        <ul class="navbar-nav navbar-nav-right">
            {{-- <li class="nav-item dropdown">
                <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#"
                    data-toggle="dropdown">
                    <i class="icon-bell mx-0"></i>
                    <span class="count"></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list"
                    aria-labelledby="notificationDropdown">
                    <p class="mb-0 font-weight-normal float-left dropdown-header">Notifications</p>
                    <a href="#" class="dropdown-item preview-item">
                        <div class="preview-thumbnail">
                            <div class="preview-icon">
                                <i class="ti-info-alt mx-0"></i>
                            </div>
                        </div>
                        <div class="preview-item-content">
                            <h6 class="preview-subject font-weight-normal">lorem</h6>
                            <p class="font-weight-light small-text mb-0 text-muted">
                                28-05-2022
                            </p>
                        </div>
                    </a>
                    <a class="dropdown-item preview-item text-muted">
                        Tidak ada notifikasi
                    </a>
                    <a href="#" class="dropdown-item preview-item">
                        <div class="mx-auto">More</div>
                    </a>
                </div>
            </li> --}}
            @if (auth()->user()->role == 'kanwil' || auth()->user()->role == 'kabko' || auth()->user()->role == 'pusat')
            <li class="nav-item">
                <a href="{{ url('portals') }}">
                    <span class="navbar-text text-white">
                        <i class="fa-solid fa-house mr-2"></i>
                        Kembali ke portal
                    </span>
                </a>
            </li>
            @endif
            <li class="nav-item dropdown">
                <span class="navbar-text text-white">
                    {{ auth()->user()->name }}
                </span>
            </li>
            <li class="nav-item nav-profile d-none d-lg-flex">
                <img src="{{ auth()->user()->getPathImage() }}" alt="profile" />
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link" href="#" data-toggle="dropdown">
                    <i class="icon-ellipsis"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                    <a class="dropdown-item" href="{{ route('user.show_form_profil') }}">
                        <i class="fa-solid fa-user text-primary"></i>
                        Profil
                    </a>
                    <a class="dropdown-item" onclick="document.querySelector('.form-logout').submit()">
                        <i class="fa-solid fa-right-from-bracket text-primary"></i>
                        Logout
                    </a>

                    <form action="{{ route('logout') }}" method="post" class="d-none form-logout">
                        @csrf
                    </form>
                </div>
            </li>

        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
            data-toggle="offcanvas">
            <span class="icon-menu"></span>
        </button>
    </div>
</nav>
