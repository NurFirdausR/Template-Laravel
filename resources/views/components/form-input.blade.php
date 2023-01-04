@php
    $a = ['value', 'id', 'name', 'class'];
    $attr = $attributes->filter(fn ($value, $key) => !in_array($key, $a));
@endphp
@if ($type == 'text')
    <div class="form-group">
        <label for="{{ $id }}">
            {{ $label }}
            @if ($labelRequired)
            <span class="text-danger">*</span>
            @endif
        </label>
        <input type="text" value="{{ $value }}" class="form-control @error($name) is-invalid @enderror {{ $class }}" id="{{ $id }}" name="{{ $name }}" {{ $attr }}>
        {{ $slot }}
        @error($name)
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
@elseif($type == 'textarea')
    <div class="form-group">
        <label for="{{ $id }}">
            {{ $label }}
            @if ($labelRequired)
            <span class="text-danger">*</span>
            @endif
        </label>
        <textarea class="form-control {{ $class }}" name="{{ $name }}" rows="6" {{ $attr }}>{{ $value }}</textarea>
        {{ $slot }}
        @error($name)
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
@elseif($type == 'date')
    <div class="form-group">
        <label for="{{ $id }}">
            {{ $label }}
            @if ($labelRequired)
            <span class="text-danger">*</span>
            @endif
        </label>
        <input type="date" value="{{ $value }}" class="form-control @error($name) is-invalid @enderror {{ $class }}" id="{{ $id }}" name="{{ $name }}" {{ $attr }}>
        {{ $slot }}
        @error($name)
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
@elseif($type == 'email')
    <div class="form-group">
        <label for="{{ $id }}">
            {{ $label }}
            @if ($labelRequired)
            <span class="text-danger">*</span>
            @endif
        </label>
        <input type="email" value="{{ $value }}" class="form-control @error($name) is-invalid @enderror {{ $class }}" id="{{ $id }}" name="{{ $name }}" {{ $attr }}>
        {{ $slot }}
        @error($name)
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
@elseif($type == 'number')
    <div class="form-group">
        <label for="{{ $id }}">
            {{ $label }}
            @if ($labelRequired)
            <span class="text-danger">*</span>
            @endif
        </label>
        <input type="number" value="{{ $value }}" class="form-control @error($name) is-invalid @enderror {{ $class }}" id="{{ $id }}" name="{{ $name }}" {{ $attr }}>
        {{ $slot }}
        @error($name)
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
@elseif($type == 'password')
    <div class="form-group">
        <label for="{{ $id }}">
            {{ $label }}
            @if ($labelRequired)
            <span class="text-danger">*</span>
            @endif
        </label>
        <input type="password" value="{{ $value }}" class="form-control @error($name) is-invalid @enderror {{ $class }}" id="{{ $id }}" name="{{ $name }}" {{ $attr }}>
        {{ $slot }}
        @error($name)
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
@elseif($type == 'select')
    <div class="form-group">
        <label for="{{ $id }}">
            {{ $label }}
            @if ($labelRequired)
            <span class="text-danger">*</span>
            @endif
        </label>
        <select class="form-control @error($name) is-invalid @enderror {{ $class }}" name="{{ $name }}" id="{{ $id }}" {{ $attr }}>
            @foreach ($listOption as $key => $val)
            <option value="{{ $key }}" @selected($value == $key)>{{ $val }}</option>
            @endforeach
        </select>
        {{ $slot }}
        @error($name)
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
@elseif($type == 'checkbox')
    <div class="form-group">
        <label for="">
            {{ $label }}
            @if ($labelRequired)
                <span class="text-danger">*</span>
            @endif
        </label>
        @php
            $index = 0;
        @endphp
        <br>
        @foreach ($listOption as $key => $item)
            <div class="custom-control custom-checkbox d-inline-block {{ $index > 0 ? 'ml-3' : '' }} ">
                <input type="checkbox" class="custom-control-input {{ $class }}" id="custom-checkbox{{ $index }}" name="{{ $name }}" value="{{ $key }}" @checked($value) {{ $attr }}>
                <label class="custom-control-label text-capitalize" for="custom-checkbox{{ $index }}">{{ $item }}</label>
            </div>
            @php $index++ @endphp
        @endforeach
        {{ $slot }}
        @error($name)
            <div class="invalid-feedback d-block">
                {{ $message }}
            </div>
        @enderror
    </div>
@elseif($type == 'radio')
    <div class="form-group">
        <label for="">
            {{ $label }}
            @if ($labelRequired)
                <span class="text-danger">*</span>
            @endif
        </label>
        @php
            $index = 0;
        @endphp
        <br>
        @foreach ($listOption as $key => $item)
            <div class="custom-control custom-radio d-inline-block {{ $index > 0 ? 'ml-3' : '' }} ">
                <input type="radio" class="custom-control-input {{ $class }}" id="custom-checkbox{{ $index }}" name="{{ $name }}" value="{{ $key }}" @checked($value) {{ $attr }}>
                <label class="custom-control-label text-capitalize" for="custom-checkbox{{ $index }}">{{ $item }}</label>
            </div>
            @php $index++ @endphp
        @endforeach
        {{ $slot }}
        @error($name)
            <div class="invalid-feedback d-block">
                {{ $message }}
            </div>
        @enderror
    </div>
@elseif($type == 'upload_image')
    <div class="form-group">
        <label for="{{ $id }}">
            {{ $label }}
            @if ($labelRequired)
                <span class="text-danger">*</span>
            @endif
        </label>
        <br>
        <img src="{{ $value != '' ? $value : 'https://via.placeholder.com/200/15b3b2/FFFFFF?text=image' }}" class="img-thumbnail preview-{{ $name }} {{ $class }}" style="max-height: 200px" alt="">
        <div class="custom-file mt-2">
            <input type="file" class="form-control" name="{{ $name }}" accept=".jpg,.png,.jpeg"
                class="custom-file-input @error($name) is-invalid @enderror"
                id="{{ $id }}"
                onchange="preview('.preview-{{ $name }}', this.files[0])"
                {{ $attr }}>
            {{ $slot }}
            @error($name)
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
@elseif($type == 'upload_file')
    <div class="form-group">
        <label for="{{ $id }}">
            {{ $label }}
            @if ($labelRequired)
                <span class="text-danger">*</span>
            @endif
        </label>
        <br>
        <div class="custom-file mt-2">
            <input type="file" class="form-control" name="{{ $name }}"
                class="custom-file-input @error($name) is-invalid @enderror"
                id="{{ $id }}"
                {{ $attr }}>
            {{ $slot }}
            @error($name)
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        @if ($value != '')
            <a href="{{ $value }}" class="btn btn-primary" target="_blank">Lihat</a>
        @endif
    </div>
@elseif($type == 'time')
    <div class="form-group">
        <label for="{{ $id }}">
            {{ $label }}
            @if ($labelRequired)
            <span class="text-danger">*</span>
            @endif
        </label>
        <input type="time" value="{{ $value }}" class="form-control @error($name) is-invalid @enderror {{ $class }}" id="{{ $id }}" name="{{ $name }}" {{ $attr }}>
        {{ $slot }}
        @error($name)
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
@else
<p>tidak ada</p>
@endif
