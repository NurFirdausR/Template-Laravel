@extends('layouts.app')
@section('title', 'Dashboard')

@section('content')
<div class="row">
    <div class="col-md-5">
        <x-card>
            <x-slot name="header" class="bg-white border-bottom-0">
                <h5 class="card-title mt-3 mb-3">List daftar dokumen yang sudah dibuat</h5>
            </x-slot>

            <a class="btn btn-primary btn-sm float-right" href="#">More</a>
        </x-card>
    </div>

    <div class="col-md-7">
        <x-card>
            <div class="row">
                <div class="col-md-3 pr-lg-2 stretch-card transparent">
                    <x-card class="text-white bg-red">
                        <div class="mb-4">
                            <button class="btn btn-icon btn-danger border-0" style="background: rgba(224, 224, 224, 0.21)">
                                <i class="ti-user"></i>
                            </button>
                        </div>
                        <strong class="d-block fs-30 mb-2 text-right"></strong>
                        <p class="text-right">Jumlah User</p>
                    </x-card>
                </div>
                <div class="col-md-3 pl-lg-3 mt-3 mt-lg-0 stretch-card transparent">
                    <x-card class="text-white bg-red">
                        <div class="mb-4">
                            <button class="btn btn-icon btn-danger border-0" style="background: rgba(224, 224, 224, 0.21)">
                                <i class="ti-user"></i>
                            </button>
                        </div>
                        <strong class="d-block fs-30 mb-2 text-right"></strong>
                        <p class="text-right">Jumlah Grup User</p>
                    </x-card>
                </div>
                <div class="col-md-3 pl-lg-3 mt-3 mt-lg-0 stretch-card transparent">
                    <x-card class="text-white bg-red">
                        <div class="mb-4">
                            <button class="btn btn-icon btn-danger border-0" style="background: rgba(224, 224, 224, 0.21)">
                                <i class="ti-user"></i>
                            </button>
                        </div>
                        <strong class="d-block fs-30 mb-2 text-right"></strong>
                        <p class="text-right">Jumlah Divisi</p>
                    </x-card>
                </div>
                <div class="col-md-3 pl-lg-3 mt-3 mt-lg-0 stretch-card transparent">
                    <x-card class="text-white bg-red">
                        <div class="mb-4">
                            <button class="btn btn-icon btn-danger border-0" style="background: rgba(224, 224, 224, 0.21)">
                                <i class="ti-file"></i>
                            </button>
                        </div>
                        <strong class="d-block fs-30 mb-2 text-right"></strong>
                        <p class="text-right">Jumlah Template</p>
                    </x-card>
                </div>
            </div>
        </x-card>

        <x-card class="mt-3">
            <div class="row">
                <div class="col-lg-3 col-md-6 pr-lg-2">
                    <x-card class="text-center bg-f2f2f2">
                        <div class="d-inline-block p-2 rounded-circle shadow-sm mb-4 bg-white">
                            <button class="btn btn-icon btn-rounded bg-white" style="border: 3px dashed var(--accent-blue);">
                                <i class="ti-file text-blue"></i>
                            </button>
                        </div>
                        <strong class="d-block fs-30 mb-2 text-blue"></strong>
                        <p style="white-space: nowrap">Jumlah Project</p>
                    </x-card>
                </div>
                <div class="col-lg-3 col-md-6 mt-lg-0 mt-3 pr-lg-2">
                    <x-card class="text-center bg-f2f2f2">
                        <div class="d-inline-block p-2 rounded-circle shadow-sm mb-4 bg-white">
                            <button class="btn btn-icon btn-rounded bg-white" style="border: 3px dashed var(--accent-orange);">
                                <i class="ti-file text-orange"></i>
                            </button>
                        </div>
                        <strong class="d-block fs-30 mb-2 text-orange"></strong>
                        <p style="white-space: nowrap">Project Baru</p>
                    </x-card>
                </div>
                <div class="col-lg-3 col-md-6 mt-lg-0 mt-3 pr-lg-2">
                    <x-card class="text-center bg-f2f2f2">
                        <div class="d-inline-block p-2 rounded-circle shadow-sm mb-4 bg-white">
                            <button class="btn btn-icon btn-rounded bg-white" style="border: 3px dashed var(--accent-red);">
                                <i class="ti-file text-red"></i>
                            </button>
                        </div>
                        <strong class="d-block fs-30 mb-2 text-red"></strong>
                        <p style="white-space: nowrap">Project Revisi</p>
                    </x-card>
                </div>
                <div class="col-lg-3 col-md-6 mt-lg-0 mt-3">
                    <x-card class="text-center bg-f2f2f2">
                        <div class="d-inline-block p-2 rounded-circle shadow-sm mb-4 bg-white">
                            <button class="btn btn-icon btn-rounded bg-white" style="border: 3px dashed var(--accent-green);">
                                <i class="ti-file text-green"></i>
                            </button>
                        </div>
                        <strong class="d-block fs-30 mb-2 text-green"></strong>
                        <p style="white-space: nowrap">Project selesai</p>
                    </x-card>
                </div>
            </div>
        </x-card>
    </div>
</div>
@endsection
