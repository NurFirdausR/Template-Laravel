@extends('layouts.front')

@section('title', 'Telkom Digital Review 2.0')

@push('css')
    <style>
        .text-paragraph {
            /* font-family: 'Inter'; */
            font-style: normal;
            font-weight: 400;
            font-size: 14px;
            color: #6B7280;
        }
    </style>
@endpush

@section('content')
    <main style="padding: 55px 100px 55px 100px">
        <div class="container">
            <div class="row justify-content-center mt-xl-15">
                <div class="col-lg-5">
                    <main class="form-signin">
                        <x-auth-card>
                            <x-slot name="logo"></x-slot>
                        
                            <h1 class="h1 my-1 fw-normal text-left">Ketik Password Baru</h1>
                        
                            <!-- Session Status -->
                            <x-auth-session-status class="mb-4" :status="session('status')" />
                        
                            <!-- Validation Errors -->
                            <x-auth-validation-errors class="mb-4" :errors="$errors" />
                        
                            <form method="POST" action="{{ route('password.update') }}">
                                @csrf

                                <!-- Password Reset Token -->
                                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                                <!-- Password -->
                                <div class="form-floating">
                                    <x-input id="password" type="hidden" class="form-control" name="email" :value="old('email', $request->email)" required />
                                    <x-label for="password" :value="__('Masukan email')" />
                                </div>
                                <div class="input-group mb-1 form-floating">
                                    <input class="form-control  @error('password') is-invalid @enderror password border-end-0"
                                        id="password" class="block mt-1 w-full" type="password" name="password"
                                        placeholder="Password" required />
                                    <span class="input-group-text togglePassword rounded-end bg-white border-start-0"
                                        id="" @error('password') style="border: 1px solid red" @enderror>
                                        <i class="bi bi-eye" style="cursor: pointer;"></i>
                                    </span>
                                    <label for="floatingPassword">Masukan password baru</label>
                                </div>
                                <!-- Confirm Password -->
                                <div class="input-group mb-1 form-floating">
                                    <input class="form-control  @error('password') is-invalid @enderror password border-end-0"
                                        id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation"
                                        placeholder="Password" required />
                                    <span class="input-group-text togglePassword rounded-end bg-white border-start-0"
                                        id="" @error('password') style="border: 1px solid red" @enderror>
                                        <i class="bi bi-eye" style="cursor: pointer;"></i>
                                    </span>
                                    <label for="floatingPassword">Masukan ulang password baru</label>
                                </div>
                        
                                <div class="col-lg-12 mt-3">
                                    <button class="w-100 btn btn-lg btn-primary" style="border-radius: 5px"
                                        type="submit">Ubah Password</button>
                                </div>
                            </form>
                        </x-auth-card>
                    </main>
                </div>
            </div>
        </div>
    </main>
@endsection

@push('scripts')
<script>

    $(".togglePassword").click(function(e) {
        e.preventDefault();
        var type = $(this).parent().find(".password").attr("type");
        $(this).find('i').toggleClass("bi-eye bi-eye-slash");
        if (type == "password") {
            $(this).parent().find(".password").attr("type", "text");
        } else if (type == "text") {
            $(this).parent().find(".password").attr("type", "password");
        }
    });

</script>
@endpush