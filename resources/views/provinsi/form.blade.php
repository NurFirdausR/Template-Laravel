<x-modal size="modal-md">
    <x-slot name="title"></x-slot>
    @method('post')

    <x-form-input label="Nama Provinsi" value="" type="text" name="nama_provinsi" id="nama_provinsi" class="nama_provinsi" list-option="" :label-required="true"></x-form-input>

    <x-slot name="footer">
        <button class="btn btn-light" type="button" data-dismiss="modal">Batal</button>
        <button class="btn btn-primary"
            onclick="submitForm(this.form, this)">Save</button>
    </x-slot>
</x-modal>
