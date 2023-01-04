@php
    $a = ['value', 'id', 'name', 'class', 'data-value', 'data-target-id'];
    $attr = $attributes->filter(fn ($value, $key) => !in_array($key, $a));
@endphp
@if ($isInline)
    <div class="form-group row">
        <label for="{{ $id }}" class="col-lg-3">
            {{ $label }}
            @if ($labelRequired)
            <span class="text-danger">*</span>
            @endif
        </label>

        <div class="col-lg-9">
            <select class="form-control @error($name) is-invalid @enderror select2 select-wilayah-{{ $listType }}" name="{{ $name }}" id="{{ $id }}" {{ $value !== "" ? 'data-value='.$value.'' : '' }} data-target-id="{{ $targetId }}" {{ $attr }}>
                <option value="" selected>Pilih {{ $label }}</option>
            </select>
            {{ $slot }}
            @error($name)
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>
@else
    <div class="form-group">
        <label for="{{ $id }}">
            {{ $label }}
            @if ($labelRequired)
            <span class="text-danger">*</span>
            @endif
        </label>
        <select class="form-control @error($name) is-invalid @enderror select2 select-wilayah-{{ $listType }}" name="{{ $name }}" id="{{ $id }}" {{ $value !== "" ? 'data-value='.$value.'' : '' }} data-target-id="{{ $targetId }}" {{ $attr }}>
            <option value="" selected>Pilih {{ $label }}</option>
        </select>
        {{ $slot }}
        @error($name)
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
@endif

@section('js_select_wilayah')

<script>

    //OPTION PROVINSI
    $.get(`{{ url('provinsi/list') }}`)
        .done((response) => {
            let content = `<option value="" >Pilih Provinsi</option>`;
            let value = $('.select-wilayah-provinsi').data('value');

            if (value !== '') {
                response.forEach(item => {
                    content += `
                        <option value="${item.id}" ${item.id == value ? ' selected' : ''}>${item.nama_provinsi}</option>
                    `;
                });

                $('.select-wilayah-provinsi').empty();
                if ($('.select-wilayah-provinsi').is(':disabled')) {
                    $('.select-wilayah-provinsi').append(content).prop("disabled",false).trigger('change').prop("disabled",true);
                }else{
                    $('.select-wilayah-provinsi').append(content).trigger('change');
                }
            }else{
                response.forEach(item => {
                    content += `
                        <option value="${item.id}">${item.nama_provinsi}</option>
                    `;
                });

                $('.select-wilayah-provinsi').empty();
                if ($('.select-wilayah-provinsi').is(':disabled')) {
                    $('.select-wilayah-provinsi').append(content).prop("disabled",false).trigger('change').prop("disabled",true);
                }else{
                    $('.select-wilayah-provinsi').append(content).trigger('change');
                }
            }

        })
        .fail((errors) => {
            showAlert(errors.responseJSON.message);
        });

        //OPTION KABUPATEN
        $('.select-wilayah-provinsi').on('change', function (e) {

            let value = $('.select-wilayah-kabupaten').data('value');
            let content = `<option value="">Pilih Kabupaten</option>`;
            let target = $(this).data('target-id');
            let thisVal = $(this).val();

            if (this.value.length < 1) {
                $(target).empty();
                if ($(`${target}`).is(':disabled')) {
                    $(`${target}`).append(content).prop("disabled",false).trigger('change').prop("disabled",true);
                }else{
                    $(`${target}`).append(content).trigger('change');
                }
                return false;
            }

            $.get(`{{ url('provinsi') }}/${thisVal}/kabupaten/list`)
                .done((response) => {
                    let value = $('.select-wilayah-kabupaten').data('value');
                    let content = `<option value="">Pilih Kabupaten</option>`;
                    if (value !== '') {
                        response.forEach(item => {
                            content += `
                                <option value="${item.id}" ${item.id == value ? ' selected' : ''} >${item.nama_kabupaten}</option>
                            `;
                        });

                        $(target).empty();
                        if ($(`${target}`).is(':disabled')) {
                            $(`${target}`).append(content).prop("disabled",false).trigger('change').prop("disabled",true);
                        }else{
                            $(`${target}`).append(content).trigger('change');
                        }
                    }else{
                        response.forEach(item => {
                            content += `
                                <option value="${item.id}">${item.nama_kabupaten}</option>
                            `;
                        });

                        $(target).empty();
                        if ($(`${target}`).is(':disabled')) {
                            $(`${target}`).append(content).prop("disabled",false).trigger('change').prop("disabled",true);
                        }else{
                            $(`${target}`).append(content).trigger('change');
                        }
                    }

                })
                .fail((errors) => {
                    showAlert(errors.responseJSON.message);
                });

            e.stopImmediatePropagation();
        });

        //OPTION KECAMATAN
        $('.select-wilayah-kabupaten').on('change', function (e) {

            let value = $('.select-wilayah-kecamatan').data('value');
            let content = `<option value="">Pilih Kecamatan</option>`;
            let target = $(this).data('target-id');
            let thisVal = $(this).val();

            if (this.value.length < 1) {
                $(target).empty();
                if ($(`${target}`).is(':disabled')) {
                    $(`${target}`).append(content).prop("disabled",false).trigger('change').prop("disabled",true);
                }else{
                    $(`${target}`).append(content).trigger('change');
                }
                return;
            }

            $.get(`{{ url('kabupaten') }}/${thisVal}/kecamatan/list`)
                .done((response) => {
                    let value = $('.select-wilayah-kecamatan').data('value');
                    let content = `<option value="">Pilih Kecamatan</option>`;
                    if (value !== '') {
                        response.forEach(item => {
                            content += `
                                <option value="${item.id}" ${item.id == value ? ' selected' : ''} >${item.nama_kecamatan}</option>
                            `;
                        });

                        $(target).empty();
                        if ($(`${target}`).is(':disabled')) {
                            $(`${target}`).append(content).prop("disabled",false).trigger('change').prop("disabled",true);
                        }else{
                            $(`${target}`).append(content).trigger('change');
                        }
                    }else{
                        response.forEach(item => {
                            content += `
                                <option value="${item.id}">${item.nama_kecamatan}</option>
                            `;
                        });

                        $(target).empty();
                        if ($(`${target}`).is(':disabled')) {
                            $(`${target}`).append(content).prop("disabled",false).trigger('change').prop("disabled",true);
                        }else{
                            $(`${target}`).append(content).trigger('change');
                        }
                    }

                })
                .fail((errors) => {
                    showAlert(errors.responseJSON.message);
                });

            e.stopImmediatePropagation();
        });

        //OPTION KELURAHAN
        $('.select-wilayah-kecamatan').on('change', function (e) {

            let value = $('.select-wilayah-kelurahan').data('value');
            let content = `<option value="">Pilih Kelurahan</option>`;
            let target = $(this).data('target-id');
            let thisVal = $(this).val();

            if (this.value.length < 1) {
                $(target).empty();
                if ($(`${target}`).is(':disabled')) {
                    $(`${target}`).append(content).prop("disabled",false).trigger('change').prop("disabled",true);
                }else{
                    $(`${target}`).append(content).trigger('change');
                }
                return;
            }

            $.get(`{{ url('kecamatan') }}/${thisVal}/kelurahan/list`)
                .done((response) => {
                    let value = $('.select-wilayah-kelurahan').data('value');
                    let content = `<option value="">Pilih Kelurahan</option>`;
                    if (value !== '') {
                        response.forEach(item => {
                            content += `
                                <option value="${item.id}" ${item.id == value ? ' selected' : ''} >${item.nama_kelurahan}</option>
                            `;
                        });

                        $(target).empty();
                        if ($(`${target}`).is(':disabled')) {
                            $(`${target}`).append(content).prop("disabled",false).trigger('change').prop("disabled",true);
                        }else{
                            $(`${target}`).append(content).trigger('change');
                        }
                    }else{
                        response.forEach(item => {
                            content += `
                                <option value="${item.id}">${item.nama_kelurahan}</option>
                            `;
                        });

                        $(target).empty();
                        if ($(`${target}`).is(':disabled')) {
                            $(`${target}`).append(content).prop("disabled",false).trigger('change').prop("disabled",true);
                        }else{
                            $(`${target}`).append(content).trigger('change');
                        }
                    }

                })
                .fail((errors) => {
                    showAlert(errors.responseJSON.message);
                });

            e.stopImmediatePropagation();
        });
</script>
@endsection
