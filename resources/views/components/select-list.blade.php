@php
    $a = ['value', 'id', 'name', 'class', 'data-value'];
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
            <select class="form-control @error($name) is-invalid @enderror select2 select-{{ $id }}" name="{{ $name }}" id="{{ $id }}" {{ $value !== "" ? 'data-value='.$value.'' : '' }} {{ $$attr }}>
                <option value="" disabled selected>Pilih {{ $label }}</option>
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
        <select class="form-control @error($name) is-invalid @enderror select2 select-{{ $id }}" name="{{ $name }}" id="{{ $id }}" {{ $value !== "" ? 'data-value='.$value.'' : '' }} {{ $attr }}>
            <option value="" disabled selected>Pilih {{ $label }}</option>
        </select>
        {{ $slot }}
        @error($name)
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
@endif

@push('js')
<script>
        $.get(`{{ $url }}`)
            .done((response) => {
                let content = `<option value="" >Pilih {{ $label }}</option>`;
                $.each(response, function(key, value) {
                    content += `
                        <option value="${key}">${value}</option>
                    `;
                });

                $('.select-{{ $id }}').empty();
                $('.select-{{ $id }}').append(content).trigger('change');

                let value = $('.select-{{ $id }}').data('value');
                if (value !== "") {
                    $('.select-{{ $id }}').val(value).trigger('change');
                }

            })
            .fail((errors) => {
                showAlert(errors.responseJSON.message);
            });
</script>
@endpush


