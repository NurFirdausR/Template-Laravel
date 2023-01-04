<x-modal size="modal-md">
    <x-slot name="title"></x-slot>
    @method('post')

    <x-select-wilayah :isInline="false" listType="provinsi" label="Provinsi" value="" name="provinsi_id" id="provinsi_id" targetId="" :labelRequired="true"></x-select-wilayah>

    <x-form-input label="Nama Kabupaten" value="" type="text" name="nama_kabupaten" id="nama_kabupaten" class="nama_kabupaten" list-option="" :label-required="true"></x-form-input>

    <x-slot name="footer">
        <button class="btn btn-light" type="button" data-dismiss="modal">Batal</button>
        <button class="btn btn-primary"
            onclick="submitForm(this.form, this)">Save</button>
    </x-slot>
</x-modal>
