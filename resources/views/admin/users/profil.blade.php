@extends('layouts.app')
@section('title', 'Profil')

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="row">
        <div class="col-lg-12">
            <x-card>
                <x-slot name="header" class="bg-white border-bottom-0">
                    <ul class="nav nav-pills" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                                aria-controls="profile" aria-selected="true">Detail Profil</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="ganti-password-tab" data-toggle="tab" href="#ganti-password"
                                role="tab" aria-controls="ganti-password" aria-selected="true">Ganti Password</a>
                        </li>
                    </ul>
                </x-slot>

                <div class="tab-content border-0" id="myTabContent">
                    <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <form action="{{ route('user.update_profil') }}" id="profile-form" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            @include('admin.users.profil.profil')
                        </form>
                    </div>
                    <div class="tab-pane fade" id="ganti-password" role="tabpanel" aria-labelledby="ganti-password-tab">
                        <form action="{{ route('user.update_password') }}" id="ganti-password-form" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            @include('admin.users.profil.ganti_password')
                        </form>
                    </div>
                </div>
            </x-card>
        </div>
    </div>
@endsection

@push('js')
    <script type="text/javascript"></script>
@endpush
