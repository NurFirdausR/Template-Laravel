<nav class="sidebar sidebar-offcanvas overflow-auto" id="sidebar">
    <ul class="nav">
        @hasrole('admin')
            @include('layouts.partials.menus.admin')
        @endhasrole

        @hasrole('guru')
            @include('layouts.partials.menus.guru')
        @endhasrole

        @hasrole('lptk')
            @include('layouts.partials.menus.lptk')
        @endhasrole

        @hasrole('dit_gtk')
            @include('layouts.partials.menus.dit_gtk')
        @endhasrole

        @php
            $data_referensi =
            request()->is('provinsi*') ||
            request()->is('kabupaten*') ||
            request()->is('kecamatan*') ||
            request()->is('kelurahan*')
        @endphp

        @canany(
            [
                'create data provinsi', 'view data provinsi', 'edit data provinsi', 'delete data provinsi',
                'create data kabupaten', 'view data kabupaten', 'edit data kabupaten', 'delete data kabupaten',
                'create data kecamatan', 'view data kecamatan', 'edit data kecamatan', 'delete data kecamatan',
                'create data kelurahan', 'view data kelurahan', 'edit data kelurahan', 'delete data kelurahan',
            ]
        )
        <li class="nav-item @if ($data_referensi) active @endif">
            <a class="nav-link" data-toggle="collapse" href="#form-elements" aria-expanded="false"
                aria-controls="form-elements">
                <i class="fa-solid fa-database mr-2"></i>
                <span class="menu-title">Data Referensi</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse @if ($data_referensi) show @endif" id="form-elements">
                <ul class="nav flex-column sub-menu">
                    @canany(['create data provinsi', 'view data provinsi', 'edit data provinsi', 'delete data provinsi'])
                        <li class="nav-item"><a class="nav-link @if (request()->is('provinsi*')) active @endif" href="{{ route('provinsi.index') }}">Data Provinsi</a></li>
                    @endcanany
                    @canany(['create data kabupaten', 'view data kabupaten', 'edit data kabupaten', 'delete data kabupaten'])
                        <li class="nav-item"><a class="nav-link @if (request()->is('kabupaten*')) active @endif" href="{{ route('kabupaten.index') }}">Data Kabupaten</a></li>
                    @endcanany
                    @canany(['create data kecamatan', 'view data kecamatan', 'edit data kecamatan', 'delete data kecamatan'])
                        <li class="nav-item"><a class="nav-link @if (request()->is('kecamatan*')) active @endif" href="{{ route('kecamatan.index') }}">Data Kecamatan</a></li>
                    @endcanany
                    @canany(['create data kelurahan', 'view data kelurahan', 'edit data kelurahan', 'delete data kelurahan'])
                        <li class="nav-item"><a class="nav-link @if (request()->is('kelurahan*')) active @endif" href="{{ route('kelurahan.index') }}">Data Kelurahan</a></li>
                    @endcanany
                </ul>
            </div>
        </li>
        @endcanany
    </ul>
</nav>
