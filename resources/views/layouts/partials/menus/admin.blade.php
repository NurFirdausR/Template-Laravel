<li class="nav-item @if (request()->is('admin')) active @endif">
    <a class="nav-link single-menu" href="{{ route('dashboard') }}">
        <i class="fa-solid fa-house mr-2"></i>
        <span class="menu-title">Dashboard</span>
    </a>
</li>

@php
    $manajemen_user_condition = request()->is('admin/user*') || request()->is('admin/role*');
@endphp

<li class="nav-item @if ($manajemen_user_condition) active @endif">
    <a class="nav-link" data-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
        <i class="fa-solid fa-user mr-2"></i>
        <span class="menu-title">Manajemen User</span>
        <i class="menu-arrow"></i>
    </a>
    <div class="collapse @if ($manajemen_user_condition) show @endif" id="auth">
        <ul class="nav flex-column sub-menu">
                <li class="nav-item"><a class="nav-link @if (request()->is('admin/user*')) active @endif" href="{{ route('admin.user.index') }}">Data User</a></li>
                <li class="nav-item"><a class="nav-link @if (request()->is('admin/role*')) active @endif" href="{{ route('admin.role.index') }}">Hak Akses User</a></li>
        </ul>
    </div>
</li>
