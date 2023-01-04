@if (auth()->user()->role == 'yayasan')
<div class="row">
    <div class="col-lg-12">
        <x-form-input label="Nama Organisasi/Yayasan" value="{{ !empty(auth()->user()->yayasan->nama_organisasi) ? auth()->user()->yayasan->nama_organisasi : old('nama_organisasi') }}" type="text" name="nama_organisasi" id="nama_organisasi" class="nama_organisasi" list-option="" :label-required="true"></x-form-input>
    </div>

    <div class="col-lg-4">
        <x-form-input label="NPWP (Nomor Pokok Wajib Pajak)" value="{{ !empty(auth()->user()->yayasan->npwp) ? auth()->user()->yayasan->npwp : old('npwp') }}" type="text" name="npwp" id="npwp" class="npwp" list-option="" :label-required="true"></x-form-input>
    </div>

    <div class="col-lg-4">
        <x-form-input label="Telepon" value="{{ !empty(auth()->user()->yayasan->telepon) ? auth()->user()->yayasan->telepon : old('telepon') }}" type="number" name="telepon" id="telepon" class="telepon" list-option="" :label-required="true"></x-form-input>
    </div>

    <div class="col-lg-4">
        <x-form-input label="E-mail" value="{{ !empty(auth()->user()->yayasan->email) ? auth()->user()->yayasan->email : old('email') }}" type="text" name="email" id="email" class="email" list-option="" :label-required="true"></x-form-input>
    </div>

    <div class="col-lg-4">
        <x-form-input label="Nama Notaris Pembuat Akta" value="{{ !empty(auth()->user()->yayasan->notaris_nama) ? auth()->user()->yayasan->notaris_nama : old('notaris_nama') }}" type="text" name="notaris_nama" id="notaris_nama" class="notaris_nama" list-option="" :label-required="true"></x-form-input>
    </div>

    <div class="col-lg-4">
        <x-form-input label="Nomor Akta" value="{{ !empty(auth()->user()->yayasan->notaris_nomor_akta) ? auth()->user()->yayasan->notaris_nomor_akta : old('notaris_nomor_akta') }}" type="text" name="notaris_nomor_akta" id="notaris_nomor_akta" class="notaris_nomor_akta" list-option="" :label-required="true"></x-form-input>
    </div>

    <div class="col-lg-4">
        <x-form-input label="Tanggal Pengesahan Notaris" value="{{ !empty(auth()->user()->yayasan->notaris_tanggal_pengesahan) ? auth()->user()->yayasan->notaris_tanggal_pengesahan : old('notaris_tanggal_pengesahan') }}" type="date" name="notaris_tanggal_pengesahan" id="notaris_tanggal_pengesahan" class="notaris_tanggal_pengesahan" list-option="" :label-required="true"></x-form-input>
    </div>

    <div class="col-lg-6">
        <x-form-input label="Nomor SK Menkumham" value="{{ !empty(auth()->user()->yayasan->menkumham_nomor_sk) ? auth()->user()->yayasan->menkumham_nomor_sk : old('menkumham_nomor_sk') }}" type="text" name="menkumham_nomor_sk" id="menkumham_nomor_sk" class="menkumham_nomor_sk" list-option="" :label-required="true"></x-form-input>
    </div>

    <div class="col-lg-6">
        <x-form-input label="Tanggal Penerbitan SK Menkumham" value="{{ !empty(auth()->user()->yayasan->menkumham_tanggal_sk) ? auth()->user()->yayasan->menkumham_tanggal_sk : old('menkumham_tanggal_sk') }}" type="date" name="menkumham_tanggal_sk" id="menkumham_tanggal_sk" class="menkumham_tanggal_sk" list-option="" :label-required="true"></x-form-input>
    </div>

    <div class="col-lg-4">
        <x-form-input label="Nomor Rekening Bank" value="{{ !empty(auth()->user()->yayasan->bank_nomor_rekening) ? auth()->user()->yayasan->bank_nomor_rekening : old('bank_nomor_rekening') }}" type="text" name="bank_nomor_rekening" id="bank_nomor_rekening" class="bank_nomor_rekening" list-option="" :label-required="true"></x-form-input>
    </div>

    <div class="col-lg-4">
        <x-select-list :isInlinie="false" label="Nama Bank dari Rekening Organisasi/Yayasan" value="{{ !empty(auth()->user()->yayasan->bank_id) ? auth()->user()->yayasan->bank_id : old('bank_id') }}" name="bank_id" id="bank_id" :labelRequired="true" :url="url('bank/list')"></x-select-list>
    </div>

    <div class="col-lg-4">
        <x-form-input label="Atas Nama Rekening" value="{{ !empty(auth()->user()->yayasan->bank_atas_nama) ? auth()->user()->yayasan->bank_atas_nama : old('bank_atas_nama') }}" type="text" name="bank_atas_nama" id="bank_atas_nama" class="bank_atas_nama" list-option="" :label-required="true"></x-form-input>
    </div>

    <div class="col-lg-3">
        <x-select-wilayah :isInline="false" listType="provinsi" label="Provinsi" value="{{ !empty(auth()->user()->yayasan->provinsi_id) ? auth()->user()->yayasan->provinsi_id : old('provinsi_id') }}" name="provinsi_id" id="provinsi_id" targetId="#kabupaten_id" :labelRequired="true"></x-select-wilayah>
    </div>

    <div class="col-lg-3">
        <x-select-wilayah :isInline="false" listType="kabupaten" label="Kabupaten" value="{{ !empty(auth()->user()->yayasan->kabupaten_id) ? auth()->user()->yayasan->kabupaten_id : old('kabupaten_id') }}" name="kabupaten_id" id="kabupaten_id" targetId="#kecamatan_id" :labelRequired="true"></x-select-wilayah>
    </div>

    <div class="col-lg-3">
        <x-select-wilayah :isInline="false" listType="kecamatan" label="Kecamatan" value="{{ !empty(auth()->user()->yayasan->kecamatan_id) ? auth()->user()->yayasan->kecamatan_id : old('kecamatan_id') }}" name="kecamatan_id" id="kecamatan_id" targetId="#kelurahan_id" :labelRequired="true"></x-select-wilayah>
    </div>

    <div class="col-lg-3">
        <x-select-wilayah :isInline="false" listType="kelurahan" label="Kelurahan" value="{{ !empty(auth()->user()->yayasan->kelurahan_id) ? auth()->user()->yayasan->kelurahan_id : old('kelurahan_id') }}" name="kelurahan_id" id="kelurahan_id" targetId="" :labelRequired="true"></x-select-wilayah>
    </div>

    <div class="col-lg-12">
        <x-form-input label="Alamat" value="{{ !empty(auth()->user()->yayasan->alamat) ? auth()->user()->yayasan->alamat : old('alamat') }}" type="textarea" name="alamat" id="alamat" class="alamat" list-option="" :label-required="true"></x-form-input>
    </div>

    <div class="col-lg-6">
        <x-form-input label="Kode Pos" value="{{ !empty(auth()->user()->yayasan->kode_pos) ? auth()->user()->yayasan->kode_pos : old('kode_pos') }}" type="text" name="kode_pos" id="kode_pos" class="kode_pos" list-option="" :label-required="true"></x-form-input>
    </div>

    <div class="col-lg-6">
        <x-form-input label="Website" value="{{ !empty(auth()->user()->yayasan->website) ? auth()->user()->yayasan->website : old('website') }}" type="text" name="website" id="website" class="website" list-option="" :label-required="true"></x-form-input>
    </div>
</div>
@else
<div class="row">
    @php
        $namaKantor = '';
        switch (auth()->user()->role) {
            case 'kabko':
                $namaKantor = strtoupper('Kantor Wilayah Kementerian Agama '. auth()->user()->kabupaten->nama_kabupaten);
                break;

            case 'kanwil':
                $namaKantor = strtoupper('Kantor Wilayah Kementerian Agama Provinsi '. auth()->user()->provinsi->nama_provinsi);
                break;

            default:
                $namaKantor = strtoupper('Kantor Kementerian Agama Pusat');
                break;
        }
    @endphp
    <div class="col-12">
        <x-form-input label="Nama Kantor" value="{{ !empty(auth()->user()->kantor->nama) ? auth()->user()->kantor->nama : $namaKantor }}" type="text" name="nama" id="nama" class="nama" list-option="" :label-required="true"></x-form-input>
    </div>

    <div class="col-12">
        <x-form-input label="Alamat" value="{{ !empty(auth()->user()->kantor->alamat) ? auth()->user()->kantor->alamat : old('alamat') }}" type="textarea" name="alamat" id="alamat" class="alamat" list-option="" :label-required="true"></x-form-input>
    </div>

    <div class="col-4">
        <x-form-input label="Prefix" value="{{ !empty(auth()->user()->kantor->prefix) ? auth()->user()->kantor->prefix : old('prefix') }}" type="text" name="prefix" id="prefix" class="prefix" list-option="" :label-required="true"></x-form-input>
    </div>

    <div class="col-4">
        <x-form-input label="Telepon" value="{{ !empty(auth()->user()->kantor->telepon) ? auth()->user()->kantor->telepon : old('telepon') }}" type="number" name="telepon" id="telepon" class="telepon" list-option="" :label-required="true"></x-form-input>
    </div>

    <div class="col-4">
        <x-form-input label="Fax" value="{{ !empty(auth()->user()->kantor->fax) ? auth()->user()->kantor->fax : old('fax') }}" type="text" name="fax" id="fax" class="fax" list-option="" :label-required="true"></x-form-input>
    </div>

    <div class="col-6">
        <x-form-input label="Email" value="{{ !empty(auth()->user()->kantor->email) ? auth()->user()->kantor->email : old('email') }}" type="email" name="email" id="email" class="email" list-option="" :label-required="true"></x-form-input>
    </div>

    <div class="col-6">
        <x-form-input label="Website" value="{{ !empty(auth()->user()->kantor->website) ? auth()->user()->kantor->website : old('website') }}" type="text" name="website" id="website" class="website" list-option="" :label-required="true"></x-form-input>
    </div>

    <div class="col-4">
        <x-form-input label="Nama Kepala" value="{{ !empty(auth()->user()->kantor->nama_kepala) ? auth()->user()->kantor->nama_kepala : old('nama_kepala') }}" type="text" name="nama_kepala" id="nama_kepala" class="nama_kepala" list-option="" :label-required="true"></x-form-input>
    </div>

    <div class="col-4">
        <x-form-input label="NIP Kepala" value="{{ !empty(auth()->user()->kantor->nip_kepala) ? auth()->user()->kantor->nip_kepala : old('nip_kepala') }}" type="number" name="nip_kepala" id="nip_kepala" class="nip_kepala" list-option="" :label-required="true"></x-form-input>
    </div>

    <div class="col-4">
        <x-form-input label="Jabatan" value="{{ !empty(auth()->user()->kantor->jabatan) ? auth()->user()->kantor->jabatan : old('jabatan') }}" type="text" name="jabatan" id="jabatan" class="jabatan" list-option="" :label-required="true"></x-form-input>
    </div>

    <div class="col-6">
        <x-form-input label="Nama Kepala Bidang (bila ada)" value="{{ !empty(auth()->user()->kantor->nama_kepala_bidang) ? auth()->user()->kantor->nama_kepala_bidang : old('nama_kepala_bidang') }}" type="text" name="nama_kepala_bidang" id="nama_kepala_bidang" class="nama_kepala_bidang" list-option="" :label-required="false"></x-form-input>
    </div>

    <div class="col-6">
        <x-form-input label="NIP Kepala Bidang (bila ada)" value="{{ !empty(auth()->user()->kantor->nip_kepala_bidang) ? auth()->user()->kantor->nip_kepala_bidang : old('nip_kepala_bidang') }}" type="number" name="nip_kepala_bidang" id="nip_kepala_bidang" class="nip_kepala_bidang" list-option="" :label-required="false"></x-form-input>
    </div>

    <div class="col-4">
        <x-form-input label="Nama Kasi" value="{{ !empty(auth()->user()->kantor->nama_kasi) ? auth()->user()->kantor->nama_kasi : old('nama_kasi') }}" type="text" name="nama_kasi" id="nama_kasi" class="nama_kasi" list-option="" :label-required="true"></x-form-input>
    </div>

    <div class="col-4">
        <x-form-input label="NIP Kasi" value="{{ !empty(auth()->user()->kantor->nip_kasi) ? auth()->user()->kantor->nip_kasi : old('nip_kasi') }}" type="number" name="nip_kasi" id="nip_kasi" class="nip_kasi" list-option="" :label-required="true"></x-form-input>
    </div>

    <div class="col-4">
        <x-form-input label="Jabatan Kasi" value="{{ !empty(auth()->user()->kantor->jabatan_kasi) ? auth()->user()->kantor->jabatan_kasi : old('jabatan_kasi') }}" type="text" name="jabatan_kasi" id="jabatan_kasi" class="jabatan_kasi" list-option="" :label-required="true"></x-form-input>
    </div>
</div>
@endif

<div class="row mt-3">
    <div class="col">
        <button onclick="submitForm(this.form, this)" class="btn btn-primary">Simpan</button>
    </div>
</div>
