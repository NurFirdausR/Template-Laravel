/**
 * Disabled submit form
 */
(function () {
    $(`#modal-form form`).on("submit", () => false);
})();

/**
 * Fungsi untuk menampilkan modal bootstrap
 * Set default attribute berdasarkan parameter yang dikirm
 *
 * @param {string} url
 * @param {string} title
 * @param {string} modal
 * @param {callback} func
 * @return void
 */
function addForm(url, title = "Tambah", modal = "#modal-form", func) {
    $(`${modal}`).modal("show");
    $(`${modal} .modal-title`).text(title);
    $(`${modal} form`).attr("action", url);
    $(`${modal} [name=_method]`).val("post");

    resetForm(`${modal} form`);

    if (func != undefined) {
        func();
    }
}

/**
 * Fungsi untuk menampilkan modal bootstrap
 * Set default attribute berdasarkan parameter yang dikirm
 * Form akan terisi otomatis berdasarkan data yang diload via ajax
 *
 * @param {string} url
 * @param {string} title
 * @param {string} modal
 * @param {callback} func
 * @return void
 */
function editForm(url, title = "Edit", modal = "#modal-form", func) {
    $.get(url)
        .done((response) => {
            $(`${modal}`).modal("show");
            $(`${modal} .modal-title`).text(title);
            $(`${modal} form`).attr("action", url);
            $(`${modal} [name=_method]`).val("put");

            resetForm(`${modal} form`);
            loopForm(response.data);

            if (func != undefined) {
                func(response.data);
            }
        })
        .fail((errors) => {
            alert("Tidak dapat menampilkan data");
            return;
        });
}

/**
 * Fungsi untuk simpan data kedalam database
 *
 * @param {string|NodeList} originalForm
 * @param {string} selector
 * @param {{ reload: boolean, redirectTo: string }} reload
 * @param {callback} func
 * @return void
 */
function submitForm(
    originalForm,
    selector = "",
    reload = { reload: false, redirectTo: "" },
    func
) {
    let oldValue = $(selector).html();
    $(selector)
        .html(`<i class="ti-reload fa-spin mr-2"></i> Loading...`)
        .attr("disabled", true);

    $.post({
        url: $(originalForm).attr("action"),
        data: new FormData(originalForm),
        dataType: "json",
        contentType: false,
        cache: false,
        processData: false,
    })
        .done((response) => {
            $(selector).html(oldValue).attr("disabled", false);

            $(".modal").modal("hide");
            showAlert(response.message, "success");

            if (typeof table !== "undefined") {
                table.ajax.reload();
            }

            if (reload.reload) {
                if (reload.redirectTo != "") {
                    setTimeout(() => {
                        location.href = reload.redirectTo;
                    }, 300);
                } else {
                    setTimeout(() => {
                        location.reload();
                    }, 300);
                }
            }

            if (func != undefined) {
                func(response.data);
            }
        })
        .fail((errors) => {
            $(selector).html(oldValue).attr("disabled", false);

            if (errors.status == 422) {
                loopErrors(errors.responseJSON.errors);
                return;
            }

            showAlert(errors.responseJSON.message, "danger");
        });
}

/**
 * Fungsi untuk hapus data dari database
 *
 * @param {string} url
 * @param {callback} func
 * @return void
 */
function deleteData(url, func) {
    if (confirm("Yakin data akan dihapus?")) {
        $.post(url, {
            _method: "delete",
        })
            .done((response) => {
                showAlert(response.message, "success");
                if (typeof table !== "undefined") {
                    table.ajax.reload();
                } else {
                    location.reload();
                }

                if (func != undefined) {
                    func(response.data);
                }
            })
            .fail((errors) => {
                showAlert("Tidak dapat menghapus data");
                return;
            });
    }
}
