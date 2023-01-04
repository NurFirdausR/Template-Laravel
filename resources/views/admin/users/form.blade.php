<x-modal size="modal-md">
    <x-slot name="title"></x-slot>
    @method('post')

    <div class="row">
        <div class="col-lg-6">
            <x-form-input label="Nama User" value="" type="text" name="name" id="name" class="name" list-option="" :label-required="true"></x-form-input>
        </div>
        <div class="col-lg-6">
            <x-form-input label="Email" value="" type="text" name="email" id="email" class="email" list-option="" :label-required="true"></x-form-input>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <x-form-input label="Password" value="" type="text" name="password" id="password" class="password" list-option="" :label-required="false">
                <span class="small">Password default <b>000000</b></span>
            </x-form-input>
        </div>
    </div>

    <div class="form-group">
        <x-form-input label="Peranan" value="" type="radio" name="role" id="role" class="role" :list-option="$roles" :label-required="true"></x-form-input>
    </div>


    <x-slot name="footer">
        <button class="btn btn-light" type="button" data-dismiss="modal">Batal</button>
        <button class="btn btn-primary"
            onclick="submitForm(this.form, this)">Save</button>
    </x-slot>
</x-modal>
