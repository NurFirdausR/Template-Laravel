<div class="row">
    <div class="col-12">
        <div class="form-group">
            <x-form-input label="Kata sandi saat ini" value="{{ old('current_password') }}" type="password" name="current_password" id="current_password" class="current_password" list-option="" :label-required="false"></x-form-input>
        </div>
    </div>

    <div class="col-12">
        <div class="form-group">
            <x-form-input label="Kata sandi baru" value="{{ old('password') }}" type="password" name="password" id="password" class="password" list-option="" :label-required="false"></x-form-input>
        </div>
    </div>

    <div class="col-12">
        <div class="form-group">
            <x-form-input label="Konfirmasi kata sandi baru" value="{{ old('password_confirmation') }}" type="password" name="password_confirmation" id="password_confirmation" class="password_confirmation" list-option="" :label-required="false"></x-form-input>
        </div>
    </div>

    <div class="col-12">
        <div class="form-group">
            <label class="has-float-label">
                {!! htmlFormSnippet() !!}
            </label>
        </div>
    </div>
</div>

<div class="row mt-3">
    <div class="col">
        <button onclick="submitForm(this.form, this)" class="btn btn-primary">Simpan</button>
    </div>
</div>
