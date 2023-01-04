/**
 * Get Provinsi
 */
 function getProvinsi(provinsi_id = null) {
    return $.get(`${wilayah_url}/provinsi`)
        .done((response) => {
            let content = `
                <option value="">Pilih salah satu</option>
            `;
            response.data.forEach(item => {
                content += `
                    <option value="${item.id}">${item.nama_provinsi}</option>
                `;
            });
            $('[name=provinsi_id]').empty();
            $('[name=provinsi_id]')
                .append(content)
                .trigger('change');

            if (provinsi_id != null) {
                $('[name=provinsi_id]')
                    .val(provinsi_id)
                    .trigger('change');
            }
        })
        .fail((errors) => {
            showAlert(errors.responseJSON.message);
        });
}

/**
 * Get Kabupaten
 */
function getKabupaten(provinsi_id, kabupaten_id = null) {
    return $.get(`${wilayah_url}/kabupaten?provinsi_id=${provinsi_id}`)
        .done((response) => {
            let content = `
                <option value="">Pilih salah satu</option>
            `;
            response.data.forEach(item => {
                content += `
                    <option value="${item.id}">${item.nama_kabupaten}</option>
                `;
            });
            $('[name=kabupaten_id]').empty();
            $('[name=kabupaten_id]')
                .append(content)
                .trigger('change');

            if (kabupaten_id != null) {
                $('[name=kabupaten_id]')
                    .val(kabupaten_id)
                    .trigger('change');
            }
        })
        .fail((errors) => {
            showAlert(errors.responseJSON.message);
        });
}

/**
 * Get Kecamatan
 */
function getKecamatan(kabupaten_id, kecamatan_id = null) {
    return $.get(`${wilayah_url}/kecamatan?kabupaten_id=${kabupaten_id}`)
        .done((response) => {
            let content = `
                <option value="">Pilih salah satu</option>
            `;
            response.data.forEach(item => {
                content += `
                    <option value="${item.id}">${item.nama_kecamatan}</option>
                `;
            });
            $('[name=kecamatan_id]').empty();
            $('[name=kecamatan_id]')
                .append(content)
                .trigger('change');

            if (kecamatan_id != null) {
                $('[name=kecamatan_id]')
                    .val(kecamatan_id)
                    .trigger('change');
            }
        })
        .fail((errors) => {
            showAlert(errors.responseJSON.message);
        });
}

/**
 * Get Kelurahan
 */
function getKelurahan(kecamatan_id, kelurahan_id = null) {
    return $.get(`${wilayah_url}/kelurahan?kecamatan_id=${kecamatan_id}`)
        .done((response) => {
            let content = `
                <option value="">Pilih salah satu</option>
            `;
            response.data.forEach(item => {
                content += `
                    <option value="${item.id}">${item.nama_kelurahan}</option>
                `;
            });
            $('[name=kelurahan_id]').empty();
            $('[name=kelurahan_id]')
                .append(content)
                .trigger('change');

            if (kelurahan_id != null) {
                $('[name=kelurahan_id]')
                    .val(kelurahan_id)
                    .trigger('change');
            }
        })
        .fail((errors) => {
            showAlert(errors.responseJSON.message);
        });
}

function triggerWilayah(data) {
        $('[name=provinsi_id]').off('change');
        $('[name=kabupaten_id]').off('change');
        $('[name=kecamatan_id]').off('change');
        $('[name=jenis_lembaga_id]').trigger('change');

        getProvinsi(data.provinsi_id)
            .done(() => {
                getKabupaten(data.provinsi_id, data.kabupaten_id)
                    .done(() => {
                        getKecamatan(data.kabupaten_id, data.kecamatan_id)
                            .done(() => {
                                    getKelurahan(data.kecamatan_id, data.kelurahan_id);

                                    $('[name=provinsi_id]').on('change', function () {
                                        getKabupaten(this.value);
                                    });
                                    $('[name=kabupaten_id]').on('change', function () {
                                        getKecamatan(this.value);
                                    });
                                    $('[name=kecamatan_id]').on('change', function () {
                                        getKelurahan(this.value);
                                    });
                            });
                    });
            });
    }