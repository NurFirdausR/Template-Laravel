@extends('layouts.app')
@section('title', 'Data Kelurahan')

@section('content')
<x-card>
    <x-slot name="header" class="bg-white border-bottom-0 d-flex justify-content-between">
        <h5 class="card-title mt-3 mb-3">Tabel Kelurahan</h5>
        @canany(['create data kelurahan'])
        <button type="button" class="btn btn-primary" onclick="addForm('{{ route('kelurahan.store') }}', 'Tambah Kelurahan')">
            Tambah Kelurahan
            <i class="fa-solid fa-plus"></i>
        </button>
        @endcanany
    </x-slot>

    <div class="row">
        <div class="col-lg-4">
            <x-select-wilayah :isInline="false" listType="provinsi" label="Provinsi" value="" name="filter_provinsi" id="filter_provinsi" targetId="#filter_kabupaten" :labelRequired="true"></x-select-wilayah>
        </div>

        <div class="col-lg-4">
            <x-select-wilayah :isInline="false" listType="kabupaten" label="Kabupaten" value="" name="filter_kabupaten" id="filter_kabupaten" targetId="#filter_kecamatan" :labelRequired="true"></x-select-wilayah>
        </div>

        <div class="col-lg-4">
            <x-select-wilayah :isInline="false" listType="kecamatan" label="Kecamatan" value="" name="filter_kecamatan" id="filter_kecamatan" targetId="" :labelRequired="true"></x-select-wilayah>
        </div>
    </div>

    <x-table class="expandable-table table-responsive">
        <x-slot name="thead">
            <th width="5%">#</th>
            <th>Nama Negara</th>
            <th>Nama Provinsi</th>
            <th>Nama Kabupaten</th>
            <th>Nama Kecamatan</th>
            <th>Nama Kelurahan</th>
            <th width="15%">Aksi</th>
        </x-slot>
    </x-table>
</x-card>

@include('kelurahan.form')
@endsection

@push('js')
<script>
    let table;

    $(function () {
        table = $('.table').DataTable({
            processing: true,
            autoWidth: false,
            ajax: {
                url: '{{ route('kelurahan.data') }}',
                data: function (d) {
                    d.provinsi_id = $('[name=filter_provinsi]').val();
                    d.kabupaten_id = $('[name=filter_kabupaten]').val();
                    d.kecamatan_id = $('[name=filter_kecamatan]').val();
                }
            },
            columns: [
                {data: 'DT_RowIndex', searchable: false, sortable: false},
                {data: 'nama_negara', searchable: false},
                {data: 'nama_provinsi', searchable: false},
                {data: 'nama_kabupaten', searchable: false},
                {data: 'nama_kecamatan', searchable: false},
                {data: 'nama_kelurahan'},
                {data: 'action', searchable: false, sortable: false},
            ]
        });

        $('[name=filter_kecamatan]').on('change', function () {
            table.ajax.reload();
        });
    });
</script>
@endpush
