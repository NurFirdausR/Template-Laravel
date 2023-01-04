@extends('layouts.app')
@section('title', 'Data Kabupaten')

@section('content')
<x-card>
    <x-slot name="header" class="bg-white border-bottom-0 d-flex justify-content-between">
        <h5 class="card-title mt-3 mb-3">Tabel Kabupaten</h5>
        @canany(['create data kabupaten'])
        <button class="btn btn-primary" onclick="addForm('{{ route('kabupaten.store') }}', 'Tambah Kabupaten')">
            Tambah Kabupaten
            <i class="fa-solid fa-plus"></i>
        </button>
        @endcanany
    </x-slot>

    <div class="row">
        <div class="col-lg-4">
            <x-select-wilayah :isInline="false" listType="provinsi" label="Provinsi" value="" name="filter_provinsi" id="filter_provinsi" targetId="" :labelRequired="true"></x-select-wilayah>
        </div>
    </div>

    <x-table class="expandable-table table-responsive">
        <x-slot name="thead">
            <th width="5%">#</th>
            <th>Nama Provinsi</th>
            <th>Nama Kabupaten</th>
            <th width="15%">Aksi</th>
        </x-slot>
    </x-table>
</x-card>

@include('kabupaten.form')
@endsection

@push('js')
<script>
    let table;

    $(function () {
        table = $('.table').DataTable({
            processing: true,
            autoWidth: false,
            ajax: {
                url: '{{ route('kabupaten.data') }}',
                data: function (d) {
                    d.provinsi_id = $('[name=filter_provinsi]').val();
                }
            },
            columns: [
                {data: 'DT_RowIndex', searchable: false, sortable: false},
                {data: 'nama_provinsi', searchable: false},
                {data: 'nama_kabupaten'},
                {data: 'action', searchable: false, sortable: false},
            ]
        });

        $('[name=filter_provinsi]').on('change', function () {
            table.ajax.reload();
        });
    });
</script>
@endpush
