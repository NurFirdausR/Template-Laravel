<x-modal size="modal-md">
    <x-slot name="title"></x-slot>
    @method('post')

    <x-select-wilayah :isInline="false" listType="provinsi" label="Provinsi" value="" name="provinsi_id" id="provinsi_id" targetId="#kabupaten_id" :labelRequired="true"></x-select-wilayah>

    <x-select-wilayah :isInline="false" listType="kabupaten" label="Kabupaten" value="" name="kabupaten_id" id="kabupaten_id" targetId="#kecamatan_id" :labelRequired="true"></x-select-wilayah>

    <x-select-wilayah :isInline="false" listType="kecamatan" label="Kecamatan" value="" name="kecamatan_id" id="kecamatan_id" targetId="" :labelRequired="true"></x-select-wilayah>

    <x-form-input label="Nama Kelurahan" value="" type="text" name="nama_kelurahan" id="nama_kelurahan" class="nama_kelurahan" list-option="" :label-required="true"></x-form-input>

    <x-slot name="footer">
        <button class="btn btn-light" type="button" data-dismiss="modal">Batal</button>
        <button class="btn btn-primary"
            onclick="submitForm(this.form, this)">Save</button>
    </x-slot>
</x-modal>
