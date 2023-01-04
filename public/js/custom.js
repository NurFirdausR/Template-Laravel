const url = window.location.origin;

/**
 * Setup token for request ajax
 */
$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
});

/**
 * Add selected value on input file
 */
$(document).on("change", ".custom-file-input", function () {
    let filename = $(this).val().split("\\").pop();
    $(this).next(".custom-file-label").addClass("selected").html(filename);
});

/**
 * Initial select2
 */
$(".select2").select2({
    closeOnSelect: true,
    allowClear: true,
});

/**
 * Initial date and year picker
 */
$(".datepicker").datepicker({
    format: "mm-dd-yyyy",
    autoclose: true, //to close picker once year is selected
});

$(".yearpicker").datepicker({
    format: "yyyy",
    autoclose: true, //to close picker once year is selected
});

/**
 * Initial summernote
 */
$(".summernote").summernote({
    height: 300,
});

/**
 * Preview image after choose file
 *
 * @param {string|NodeList} target
 * @param {string} image
 * @return void
 */
function preview(target, image) {
    $(target).attr("src", window.URL.createObjectURL(image)).show();
}

/**
 * Clear input form
 *
 * @param {string|NodeList} selector
 * @return void
 */
function resetForm(selector) {
    $(selector)[0].reset();

    if ($(selector).find(".summernote").length != 0) {
        $(selector).find(".summernote").summernote("code", "");
    }

    var previewImage = $(selector).find(".img-thumbnail").attr("class") || "";
    if (previewImage.includes("preview-")) {
        var classPreview = previewImage
            .substr(previewImage.search("preview-"))
            .split(" ")[0];
        $(selector)
            .find(`.${classPreview}`)
            .attr(
                "src",
                "https://via.placeholder.com/200/15b3b2/FFFFFF?text=image"
            );
    }

    $(".select2").trigger("change");

    clearErrorValidationBootstrap();
}

/**
 * Hapus error validasi bootstrap
 * @return void
 */
function clearErrorValidationBootstrap() {
    $(
        ".form-control, .custom-select, [type=radio], [type=checkbox], [type=file], .select2, .note-editor"
    ).removeClass("is-invalid");
    $(".invalid-feedback").remove();
}

/**
 *
 * @param {string|NodeList} originalForm
 * @return void
 */
function loopForm(originalForm) {
    for (field in originalForm) {
        if ($(`[name=${field}]`).attr("type") != "file") {
            if ($(`[name=${field}]`).hasClass("summernote")) {
                $(`[name=${field}]`).summernote("code", originalForm[field]);
            } else if ($(`[name=${field}]`).attr("type") == "radio") {
                // radio
                $(`[name=${field}]`)
                    .filter(`[value="${originalForm[field]}"]`)
                    .prop("checked", true);
            } else if ($(`[name=${field}]`).attr("type") == "checkbox") {
                // checkbox
                $(`[name=${field}]`)
                    .filter(`[value="${originalForm[field]}"]`)
                    .prop("checked", true);
            } else {
                if (
                    $(`[name=${field}]`).length == 0 &&
                    $(`[name="${field}[]"]`).attr("multiple")
                ) {
                    // select multiple
                    $(`[name="${field}[]"]`).val(originalForm[field]);
                } else {
                    $(`[name=${field}]`).val(originalForm[field]);
                }
            }

            if ($(`[name="${field}[]"]`).length > 1) {
                // checkbox multiple
                originalForm[field].forEach((el) => {
                    $(`[name="${field}[]"]`)
                        .filter(`[value="${el}"]`)
                        .prop("checked", true);
                });
            }

            //select2
            var select2 = $(`[name="${field}"]`).hasClass("select2");
            if (select2) {
                $(`[name="${field}"]`).trigger("change");
            }

            //select2Multiple
            var select2Multiple = $(`[name="${field}[]"]`).hasClass("select2");
            if (
                typeof select2Multiple !== "undefined" &&
                select2Multiple !== false
            ) {
                $(`[name="${field}[]"]`)
                    .val(originalForm[field].split(","))
                    .change();
            }

            //select wilayah
            if ($(`[name="${field}"]`).hasClass(`select-wilayah-provinsi`)) {
                $(`[name="${field}"]`).data("value", originalForm[field]);
            }
            if ($(`[name="${field}"]`).hasClass(`select-wilayah-kabupaten`)) {
                $(`[name="${field}"]`).data("value", originalForm[field]);
            }
            if ($(`[name="${field}"]`).hasClass(`select-wilayah-kecamatan`)) {
                $(`[name="${field}"]`).data("value", originalForm[field]);
            }
            if ($(`[name="${field}"]`).hasClass(`select-wilayah-kelurahan`)) {
                $(`[name="${field}"]`).data("value", originalForm[field]);
            }
        } else {
            // $(`.preview-${field}`).attr("src", originalForm[field]).show();
            $(`.preview-${field}`)
                .attr("src", originalForm["full_url_" + field])
                .show();
        }
    }
}

/**
 * Loop errors to showing in field form
 *
 * @param {array} errors
 * @return void
 */
function loopErrors(errors) {
    $(
        ".form-control, .custom-select, [type=radio], [type=checkbox], [type=file], .select2, .note-editor"
    ).removeClass("is-invalid");
    $(".invalid-feedback").remove();

    if (errors == undefined) {
        return;
    }

    for (error in errors) {
        var s = error.split(".");
        if (s[1]) {
            $(`[name="${s[0]}[${s[1]}]"]`).addClass("is-invalid");
            if ($(`[name="${s[0]}[${s[1]}]"]`).hasClass("select2")) {
                $(
                    `<span class="error invalid-feedback">${errors[error][0]}</span>`
                ).insertAfter($(`[name="${s[0]}[${s[1]}]"]`).next());
            } else if ($(`[name="${s[0]}[${s[1]}]"]`).hasClass("summernote")) {
                $(".note-editor").addClass("is-invalid");
                $(
                    `<span class="error invalid-feedback">${errors[error][0]}</span>`
                ).insertAfter($(`[name="${s[0]}[${s[1]}]"]`).next());
            } else if (
                $(`[name="${s[0]}[${s[1]}]"]`).hasClass("custom-control-input")
            ) {
                if ($(`[name="${s[0]}[${s[1]}]"]`).length == 0) {
                    $(
                        `<span class="error invalid-feedback">${errors[error][0]}</span>`
                    ).insertAfter($(`[name=${s[0]}]`).next());
                } else {
                    $(
                        `<span class="error invalid-feedback">${errors[error][0]}</span>`
                    ).insertAfter($(`[name="${s[0]}[${s[1]}]"]`).next());
                }
            } else {
                if ($(`[name="${s[0]}[${s[1]}]"]`).length == 0) {
                    $(
                        `<span class="error invalid-feedback">${errors[error][0]}</span>`
                    ).insertAfter($(`[name="${s[0]}[${s[1]}]"]`).next());
                } else {
                    if (
                        $(`[name="${s[0]}[${s[1]}]"]`)
                            .next()
                            .hasClass("input-group-append") ||
                        $(`[name="${s[0]}[${s[1]}]"]`)
                            .next()
                            .hasClass("input-group-prepend")
                    ) {
                        $(
                            `<span class="error invalid-feedback">${errors[error][0]}</span>`
                        ).insertAfter($(`[name="${s[0]}[${s[1]}]"]`).parent());
                        $(".input-group-append .input-group-text").css(
                            "border-radius",
                            "0 4px 4px 0"
                        );
                        $(".input-group-prepend")
                            .next()
                            .css("border-radius", "0 4px 4px 0");
                    } else {
                        $(
                            `<span class="error invalid-feedback">${errors[error][0]}</span>`
                        ).insertAfter($(`[name="${s[0]}[${s[1]}]"]`));
                    }
                }
            }
        } else {
            $(`[name=${error}]`).addClass("is-invalid");

            if ($(`[name=${error}]`).hasClass("select2")) {
                $(
                    `<span class="error invalid-feedback">${errors[error][0]}</span>`
                ).insertAfter($(`[name=${error}]`).next());
            } else if ($(`[name=${error}]`).hasClass("summernote")) {
                $(".note-editor").addClass("is-invalid");
                $(
                    `<span class="error invalid-feedback">${errors[error][0]}</span>`
                ).insertAfter($(`[name=${error}]`).next());
            } else if ($(`[name=${error}]`).hasClass("custom-control-input")) {
                if ($(`[name="${error}[]"]`).length == 0) {
                    $(
                        `<span class="error invalid-feedback">${errors[error][0]}</span>`
                    ).insertAfter($(`[name=${error}]`).next());
                } else {
                    $(`[name="${error}[]"]`).addClass("is-invalid");
                    $(
                        `<span class="error invalid-feedback">${errors[error][0]}</span>`
                    ).insertAfter($(`[name="${error}[]"]`).next());
                }
            } else {
                if ($(`[name=${error}]`).length == 0) {
                    $(`[name="${error}[]"]`).addClass("is-invalid");
                    $(
                        `<span class="error invalid-feedback">${errors[error][0]}</span>`
                    ).insertAfter($(`[name="${error}[]"]`).next());
                } else {
                    if (
                        $(`[name=${error}]`)
                            .next()
                            .hasClass("input-group-append") ||
                        $(`[name=${error}]`)
                            .next()
                            .hasClass("input-group-prepend")
                    ) {
                        $(
                            `<span class="error invalid-feedback">${errors[error][0]}</span>`
                        ).insertAfter($(`[name=${error}]`).parent());
                        $(".input-group-append .input-group-text").css(
                            "border-radius",
                            "0 4px 4px 0"
                        );
                        $(".input-group-prepend")
                            .next()
                            .css("border-radius", "0 4px 4px 0");
                    } else {
                        $(
                            `<span class="error invalid-feedback">${errors[error][0]}</span>`
                        ).insertAfter($(`[name=${error}]`));
                    }
                }
            }
        }
    }
}

/**
 * Show message like alert
 *
 * @param {string} message
 * @param {string} type
 * @return void
 */
function showAlert(message, type) {
    if (type == "success") {
        iziToast.success({
            title: "Success",
            message: message,
            position: "topRight",
        });
    } else if (type == "warning") {
        iziToast.warning({
            title: "Warning",
            message: message,
            position: "topRight",
        });
    } else {
        iziToast.error({
            title: "Failed",
            message: message,
            position: "topRight",
        });
    }
}
