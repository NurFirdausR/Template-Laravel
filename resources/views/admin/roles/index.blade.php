@extends('layouts.app')
@section('title', 'Hak Akses Role')

@section('content')
<x-card>
    <div class="row">
        <div class="col pr-lg-2 m-1">
            <x-card class="text-center bg-f2f2f2">
                <div class="d-flex align-items-center justify-content-center">
                    <strong class="fs-30 mb-2 text-black">{{ format_uang($countAllUsersByRoles) }}</strong>
                    <p class="d-inline-block ml-2">Total User</p>
                </div>
            </x-card>
        </div>

        @foreach ($usersByRoles as $role)
        <div class="col pr-lg-2 m-1">
            <x-card class="text-center bg-f2f2f2">
                <div class="d-flex align-items-center justify-content-center">
                    <strong class="fs-30 mb-2 text-{{ auth()->user()->getRoleColor($role->name) }}">{{ format_uang($role->users_count) }}</strong>
                    <p class="d-inline-block ml-2 text-capitalize">{{ $role->name }}</p>
                </div>
            </x-card>
        </div>
        @endforeach
    </div>
</x-card>

<x-card class="mt-3">
    <div class="row">
        <div class="col">
            <h5 class="card-title">Roles</h5>
            <ul class="pl-0" style="list-style: none">
                @foreach ($usersByRoles as $role)
                    @if (request('name') == $role->name)
                    <a href="" class="text-decoration-none text-white text-capitalize">
                        <li class="border rounded mb-1 border-primary text-center py-2 font-weight-bold bg-primary">{{ $role->name }}</li>
                    </a>
                    @elseif (!request('name') && $role->name == 'admin')
                    <a href="{{ route('admin.role.index', ['name' => $role->name]) }}" class="text-decoration-none text-white text-capitalize">
                        <li class="border rounded mb-1 border-primary text-center py-2 font-weight-bold bg-primary">{{ $role->name }}</li>
                    </a>
                    @else
                    <a href="{{ route('admin.role.index', ['name' => $role->name]) }}" class="text-decoration-none text-dark text-capitalize">
                        <li class="border rounded mb-1 text-center py-2 font-weight-bold">{{ $role->name }}</li>
                    </a>
                    @endif
                @endforeach
            </ul>
        </div>
        <div class="col-lg-9">
            <x-card class="bg-f2f2f2">
                <form class="row" action="{{ route('admin.role.set_permissions', $roleName) }}" method="post">
                    @csrf
                    @php
                        $index = 1;
                    @endphp
                    @foreach ($permissions->pluck('name', 'group') as $group => $item)
                    <div class="col-lg-4 col-md-6
                    @if ($index == 2) mt-3 mt-md-0 mt-lg-0
                    @elseif ($index == 3) mt-3 mt-lg-0
                    @elseif ($index > 3) mt-3
                    @endif
                    ">
                        <x-card class="my-1">
                            <h5 class="card-title text-capitalize">
                                {{ $group }}<span class="badge badge-dark rounded-circle ml-2" style="padding: 2px 2px; line-height: 0"><i class="ti-help"></i></span>
                            </h5>

                            @foreach ($permissions->filter(fn ($permission) => $permission->group == $group) as $key => $permission)
                            <div class="form-group mb-0 d-flex justify-content-between align-items-center">
                                <label for="customCheck{{ $key }}" class="text-capitalize">{{ trim(str_replace($group, '', $permission->name)) }}</label>
                                <div class="custom-control custom-control-inline custom-checkbox mr-0">
                                    <input type="checkbox" class="custom-control-input" id="customCheck{{ $key }}"
                                        name="permissions[]"
                                        value="{{ $permission->name }}"
                                        {{ in_array($permission->name, $hasPermissions) ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="customCheck{{ $key }}"></label>
                                </div>
                            </div>
                            @endforeach
                        </x-card>
                    </div>

                    @php $index++ @endphp
                    @endforeach
                </form>
            </x-card>
        </div>
    </div>
</x-card>
@endsection

@push('js')
<script>
    $(function () {
        $('[name="permissions[]"]').on('change', function () {
            setRolePermissions(this.form);
        })
    });

    function setRolePermissions(originalForm) {
        $.post($(originalForm).attr('action'), $(originalForm).serialize())
            .done(response => {
                showAlert(response.message, 'success');
            })
            .fail(errors => {
                if (errors.status == 422) {
                    loopErrors(errors.responseJSON.errors);
                    return;
                }

                showAlert(errors.responseJSON.message, 'danger');
            });
    }
</script>
@endpush
