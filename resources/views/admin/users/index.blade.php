@extends('layouts.app')
@section('title', 'Data User')

@section('content')
<x-card>
    <div class="row">
        @if (auth()->user()->role == 'kanwil')
            <div class="col pr-lg-2 m-1">
                <x-card class="text-center bg-f2f2f2 cursor-pointer" data-role="">
                    <div class="d-flex align-items-center justify-content-center">
                        <strong class="fs-30 mb-2 text-black">{{ format_uang($countAllUsersByRoles) }}</strong>
                        <p class="d-inline-block ml-2">Total User</p>
                    </div>
                </x-card>
            </div>
        @else
            <div class="col pr-lg-2 m-1">
                <x-card class="text-center bg-f2f2f2 cursor-pointer" data-role="">
                    <div class="d-flex align-items-center justify-content-center">
                        <strong class="fs-30 mb-2 text-black">{{ format_uang($countAllUsersByRoles) }}</strong>
                        <p class="d-inline-block ml-2">Total User</p>
                    </div>
                </x-card>
            </div>

            @foreach ($usersByRoles as $role)
            <div class="col pr-lg-2 m-1">
                <x-card class="text-center bg-f2f2f2 cursor-pointer" data-role="{{ $role->name }}">
                    <div class="d-flex align-items-center justify-content-center">
                        <strong class="fs-30 mb-2 text-{{ auth()->user()->getRoleColor($role->name) }}">{{ format_uang($role->users_count) }}</strong>
                        <p class="d-inline-block ml-2 text-capitalize">{{ $role->name }}</p>
                    </div>
                </x-card>
            </div>
            @endforeach
        @endif
    </div>
</x-card>

<x-card class="mt-3">
    <x-slot name="header" class="bg-white border-bottom-0 d-flex justify-content-between">
        <h5 class="card-title mt-3 mb-3">Data User</h5>
        <button class="btn btn-primary" onclick="addForm('{{ route(auth()->user()->role.'.user.store') }}', 'Add User')">
            Add User
            <i class="fa-solid fa-plus"></i>
        </button>
    </x-slot>

    <x-table class="expandable-table table-responsive">
        <x-slot name="thead">
            <th width="5%">#</th>
            <th>Nama User</th>
            <th>Email</th>
            <th>Peranan User</th>
            <th width="15%">Aksi</th>
        </x-slot>
    </x-table>
</x-card>

@include('admin.users.form')
@endsection

@push('js')
<script>
    let table;

    $("#provinsi-input").hide();
    $("#kabupaten-input").hide();

    $(function () {
        table = $('.table').DataTable({
            processing: true,
            autoWidth: false,
            ajax: {
                url: '{{ route(auth()->user()->role.'.user.data') }}',
            },
            columns: [
                {data: 'DT_RowIndex', searchable: false, sortable: false},
                {data: 'name'},
                {data: 'email', searchable: false},
                {data: 'role', searchable: false},
                {data: 'action', searchable: false, sortable: false},
            ]
        });

        $('[data-role]').on('click', function () {
            table.ajax.url(`{{ route(auth()->user()->role.'.user.data') }}?role=${this.dataset.role}`).load()
        })

    });
</script>
@endpush
