@extends('layouts.app')
@section('title', 'Dashboard')

@section('content')
    <div class="row">
        <div class="col-md-12" style='padding-bottom: 20px;'>
            <x-card>
                <x-slot name="header" class="bg-white border-bottom-0">
                    <h5 class="card-title mt-3 mb-3">Dashboard</h5>
                    <h6>Izin Operasional Pendirian Raudhatul Athfal dan Madrasah</h6>
                </x-slot>

                @php
                    $card = [
                        ['label' => 'Lembaga Aktif', 'icon' => 'fa-solid fa-building-columns', 'jumlah' => 520, 'color' => '#FF6976'],
                        ['label' => 'Permohonan Perizinan', 'icon' => 'fa-solid fa-file-circle-check', 'jumlah' => 520, 'color' => '#19A2FC'],
                        ['label' => 'Belum Selesai', 'icon' => 'fa-solid fa-file-circle-xmark', 'jumlah' => 520, 'color' => '#74CDFF'],
                        ['label' => 'Verifikasi Dokumen', 'icon' => 'fa-solid fa-file-circle-check', 'jumlah' => 520, 'color' => '#83B3C0'],
                        ['label' => 'Verifikasi Lapangan', 'icon' => 'fa-solid fa-file-circle-check', 'jumlah' => 520, 'color' => '#FF9066'],
                        ['label' => 'Rekomendasi Kanwil', 'icon' => 'fa-solid fa-file-circle-check', 'jumlah' => 520, 'color' => '#FFC107'],
                        ['label' => 'Penerimaan Dokumen', 'icon' => 'fa-solid fa-file-circle-check', 'jumlah' => 520, 'color' => '#20A072'],
                        ['label' => 'Rapat Pertimbangan', 'icon' => 'fa-solid fa-file-circle-check', 'jumlah' => 520, 'color' => '#FCA017'],
                        ['label' => 'Operasional', 'icon' => 'fa-solid fa-file-circle-check', 'jumlah' => 520, 'color' => '#364640']
                    ];
                @endphp
                <div class="row">
                    @foreach ($card as $item)
                    <div class="col-lg-3 col-md-6 my-2 stretch-card transparent">
                        <x-card class="shadow bg-white rounded">
                            <div>
                                <i class="{{$item['icon']}} fa-2xl" style="padding: 45px 0 0 0; float: left; color: {{$item['color']}}"></i>
                                <div style="padding-top: 15px;">
                                    <p class="text-right" style="font-weight: 500">{{$item['label']}}</p>
                                    <strong class="d-block fs-30 text-right" style="color: {{$item['color']}}">{{$item['jumlah']}}</strong>
                                </div>
                            </div>
                        </x-card>
                    </div>
                    @endforeach
                </div>
            </x-card>
        </div>

        <div class="col-md-7" style="padding: 5px; text-align: center;">
            <x-card>
                <x-slot name="header" class="bg-white border-bottom-0">
                    <h5 class="card-title mt-3 mb-3">Jumlah Lembaga Aktif di Seluruh Indonesia</h5>
                    <h6>Izin Operasional Pendirian Raudhatul Athfal dan Madrasah</h6>
                </x-slot>

                <div class="row">
                    <div class="col-lg-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <!-- <h4 class="card-title">Bar Chart</h4> -->
                                <div class="flot-chart-container">
                                    <div id="column-chart" class="flot-chart"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </x-card>
        </div>

        <div class="col-md-5">
            <x-card>
                <x-slot name="header" class="bg-white border-bottom-0" style="text-align: center;">
                    <h5 class="card-title mt-3 mb-3">Presentase</h5>
                    <h6>Izin Operasional Pendirian Raudhatul Athfal dan Madrasah</h6>
                </x-slot>

                <div class="row">
                    <div class="col-lg-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <!-- <h4 class="card-title">Pie chart</h4> -->
                                <div class="flot-chart-container">
                                    <div id="pie-chart" class="flot-chart"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </x-card>
        </div>
    </div>
@endsection
