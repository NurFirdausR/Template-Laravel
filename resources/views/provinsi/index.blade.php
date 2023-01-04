@extends('layouts.app')
@section('title', 'Data Provinsi')

@section('content')
<x-card>
    <x-slot name="header" class="bg-white border-bottom-0 d-flex justify-content-between">
        <h5 class="card-title mt-3 mb-3">Tabel Provinsi</h5>
        @canany(['create data provinsi'])
        <button class="btn btn-primary" onclick="addForm('{{ route('provinsi.store') }}', 'Tambah Provinsi')">
            Tambah Provinsi
            <i class="fa-solid fa-plus"></i>
        </button>
        @endcanany
    </x-slot>

    <x-table class="expandable-table table-responsive">
        <x-slot name="thead">
            <th width="5%">#</th>
            <th>Nama Provinsi</th>
            <th width="15%">Aksi</th>
        </x-slot>
    </x-table>
</x-card>

@include('provinsi.form')
@endsection

@push('js')
<script>
    let table;

    $(function () {
        table = $('.table').DataTable({
            processing: true,
            autoWidth: false,
            ajax: {
                url: '{{ route('provinsi.data') }}',
            },
            columns: [
                {data: 'DT_RowIndex', searchable: false, sortable: false},
                {data: 'nama_provinsi'},
                {data: 'action', searchable: false, sortable: false},
            ]
        });
    });
</script>
@endpush
