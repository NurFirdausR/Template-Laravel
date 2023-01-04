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
                        
                            <h1 class="h1 my-2 text-left">Kirim Tautan Ke...</h1>
                            
                            <!-- Session Status -->
                            <x-auth-session-status class="mb-4" :status="session('status')" />
                        
                            <!-- Validation Errors -->
                            <x-auth-validation-errors class="mb-4" :errors="$errors" />
                        
                            <form method="POST" action="{{ route('password.email') }}">
                                @csrf
                        
                                <!-- Email Address -->
                                <div class="form-floating">
                                    <x-input id="email" class="form-control" type="text" name="email" :value="old('email')"
                                        required autofocus />
                                    <label for="floatingInput">Email</label>
                                </div>
                        
                                <div class="col-lg-12 mt-3">
                                    <button class="w-100 btn btn-lg btn-primary" style="border-radius: 5px"
                                        type="submit">Kirim</button>
                                </div>
                                <small>*Email akan digunakan untuk mengirimkan tautan reset password</small>
                            </form>
                        </x-auth-card>
                    </main>
                </div>
            </div>
        </div>
    </main>
@endsection