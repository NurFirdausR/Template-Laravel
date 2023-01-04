<x-modal size="modal-sm" id="modal-import">
    <x-slot name="title"></x-slot>
    <div class="alert alert-info">
        Download format excel <a href="{{ $link }}" target="_blank">di sini</a>
    </div>
    @method('post')
    <div class="form-group">
        <label for="status">File Excel</label>
        <input type="file" class="form-control" id="file" name="file" required>
    </div>

    <x-slot name="footer">
        <button class="btn btn-light btn-sm" type="button" data-dismiss="modal">Batal</button>
        <button class="btn btn-primary btn-sm"
            onclick="submitForm(this.form, this)">Import</button>
    </x-slot>
</x-modal>