@section('css_form_dinamis');
<style type="text/css">
    #klik {
        border-left: 5px solid #15b3b2;
        border-radius: 10px;
    }

    #form-dinamis-sidebar {
        background-color: transparent;
        position: absolute;
        right: -20px;
        color: inherit;
        padding: 15px 20px 20px 20px;
    }

    @media (max-width: 1199px) {
        #form-dinamis-sidebar {
            right: 0;
            border-color: #9fa4a7;
            border-image: none;
            border-style: solid;
            border-width: 1px;
        }
    }
</style>
@endsection

<div class="row" id="form-dinamis">
    <div class="col-lg-12">
        <div style="background-color: transparent;">
            <div class="add">

            </div>

            <div id="form-dinamis-sidebar">
                <button type="button" class="btn btn-sm btn-primary tambah-form"><i class="fa fa-plus-square"></i> Simpan dan Tambah</button>
            </div>
        </div>
    </div>
</div>
@section('js_form_dinamis')
    <script>
        $(window).scroll(function() {
            var form_dinamis = $('body #form-dinamis');
            var form_dinamis_sidebar = $('body #form-dinamis-sidebar');

            var scroll = $(window).scrollTop();
            var form_dinamis_sidebar_position = form_dinamis_sidebar.position();
            var form_dinamis_position = form_dinamis.position();
            var form_dinamis_sidebar_height = form_dinamis_sidebar.height();
            var width = $(window).width();
            var height = $(window).height();

            // console.log('scroolY : '+ scroll);
            // console.log('form_dinamis_sidebar_position : '+ form_dinamis_sidebar_position.top);
            // console.log('form_dinamis_position : '+ form_dinamis_position.top);
            // console.log('form_dinamis_height : '+ form_dinamis_sidebar_height);
            // console.log('height : '+ height);
            // console.log('width : '+ width);
            // console.log($('body .header').height() + $('body .page-header').height());

            if (width < 1200) {
                clearTimeout($.data(this, 'scrollTimer'));
                $.data(this, 'scrollTimer', setTimeout(function() {
                    if ((scroll - form_dinamis_position.top) >= form_dinamis_position.top) {
                        if ((scroll - form_dinamis_position.top) >= (form_dinamis_sidebar_position.top) ) {
                            form_dinamis_sidebar.animate({ "top" : `${(scroll - form_dinamis_position.top + 100)}px` }, "slow");
                        }else{
                            form_dinamis_sidebar.animate({ "top" : `${(scroll - form_dinamis_position.top + 100)}px` }, "slow");
                        }
                    }else{
                        form_dinamis_sidebar.animate({ "top" : `${form_dinamis_position.top}px` }, "slow");
                    }
                }, 500));
            }else{
                clearTimeout($.data(this, 'scrollTimer'));
                $.data(this, 'scrollTimer', setTimeout(function() {
                    if (scroll >= form_dinamis_position.top) {
                        if (scroll >= (form_dinamis_sidebar_position.top) ) {
                            form_dinamis_sidebar.animate({ "top" : `${(scroll  - form_dinamis_position.top)}px` }, "slow");
                        }else{
                            form_dinamis_sidebar.animate({ "top" : `${(scroll  - form_dinamis_position.top)}px` }, "slow");
                        }
                    }else{
                        form_dinamis_sidebar.animate({ "top" : `0` }, "slow");
                    }
                }, 500));
            }

        });

        var click = 0;
        var id = undefined;
        var list_type = [];
        var key = '{{ $key }}';

        var paramsForm = [];
        @foreach ($params as $k => $item )
            paramsForm['{{ $k }}'] = '{{ $item }}';
        @endforeach
        paramsForm['nama_persyaratan'] = '{{ $key }}';

        get_list();

        $(document).on('click', '.tambah-form', function (e) {
            let data = new FormData();
            if (id == undefined) {
                var file_type = [];
                var cboxes = $(`.file-type-${click}`);
                var len = cboxes.length;
                for (var i=0; i < len; i++) {
                    if(cboxes[i].checked) {
                        file_type.push(cboxes[i].value);
                    }
                }
                    data.append('_token', '{{ csrf_token() }}');
                    data.append('label_name', $(`#value-label-${click}`).val());
                    data.append('field_name', convertToSlug($(`#value-label-${click}`).val()));
                    data.append('type', $(`#pilih-type-${click}`).val());
                    data.append('list_type', JSON.stringify(list_type));
                    if ($(`#pilih-type-${click}`).val() == 'file') {
                        data.append('file_type', JSON.stringify(file_type));
                        data.append('file_template', $(`#file-template-${click}`)[0].files[0]);
                        data.append('max_size', $(`#file-size-${click}`).val());
                    }
                    data.append('is_publish', $(`#hide-${click}`).is(":checked") ? 1 : 0);
                    data.append('is_required', $(`#required-${click}`).is(":checked") ? 1 : 0);
            } else {
                    data.append('_token', '{{ csrf_token() }}');
                    data.append('label_name', '');
                    data.append('field_name', convertToSlug(''));
                    data.append('type', '');
                    data.append('list_type', JSON.stringify([]));
                    data.append('file_type', JSON.stringify([]));
                    data.append('file_template', '');
                    data.append('max_size', 0);
                    data.append('is_publish', 0);
                    data.append('is_required', 0);
            }

            data.append('nama_persyaratan', '{{ $key }}');

            @foreach ($params as $k => $item )
                data.append('{{ $k }}', '{{ $item }}');
            @endforeach

            $.ajax({
                type: "POST",
                url: "{{ route('form_dinamis.store_form') }}",
                data: data,
                dataType: "JSON",
                mimeType: 'multipart/form-data',
                processData: false,
                contentType: false,
                success: function (response) {
                    var data =  response.data;

                    // $(`#save-label-${click}`).show();
                    // $(`#delete-${click}`).show();

                    //show template after store
                    if ($(`#show-template-${click}`).length) {
                        $(`#show-template-${click}`).attr('href', data.full_url_template);
                    }else{
                        $(`#file-template-${click}`).after(`<a href="${data.full_url_template}" target="_blank" id="show-template-${click}">lihat file</a><br>`);
                    }

                    $(`.add .form-group`).eq(click).attr('data-id', data.id);
                    $(`.add .form-group`).eq(click).removeClass('unsortable');
                    $(`.add .form-group`).removeAttr('id');

                    click = click + 1;
                    form_tambah(click);
                    $(`.add .form-group`).last().attr('id', 'klik');

                    klik_position_top = $('#klik').position().top;
                    $('#form-dinamis-sidebar').animate({'top' : `${klik_position_top}`});
                    $('html').animate({
                        scrollTop: klik_position_top + $('body #form-dinamis').position().top
                    });

                    $(`#save-label-${click}`).hide();
                    $(`#delete-${click}`).hide();

                    id = $(`.add .form-group`).eq(click).data('id');

                    showAlert(response.message, 'success');
                },
                error: function (err) {
                    if (err.status == 422) {
                        var e = showErorValidation(err.responseJSON.errors);
                        alert(e);
                    }else{
                        alert(err.responseJSON.message);
                    }
                }
            });

            e.stopImmediatePropagation();
        });

        // saat klik form
        $(document).on('click', `.add .form-group`, function(e) {

            $(`#save-label-${click}`).hide();
            $(`#delete-${click}`).hide();
            $(`#form-type-${click} .btn_option`).hide();

            $(`.add .form-group`).removeAttr('id');
            $(this).attr('id', 'klik');

            var form_klik = document.getElementById('klik');

            click =  indexInClass(form_klik);
            id = $(`.add .form-group`).eq(click).data('id');

            if (id != undefined) {
                $(`#save-label-${click}`).show();
                $(`#delete-${click}`).show();
                $(`#form-type-${click} .btn_option`).show();
            }else{
                $(`#form-type-${click} .btn_option`).show();
            }

            var klik_position_top = $('#klik').position().top;
            $('#form-dinamis-sidebar').animate({'top' : `${klik_position_top}`});

            e.stopImmediatePropagation();

            $(document).on('change', `#pilih-type-${click}`, function (e) {
                $(`#form-type-${click}`).html('');
                var val = $(this).val();
                list_type = [];
                type_file = [];
                $(`#form-type-${click}`).html(c_form_type(click, val, list_type, type_file, 0, ''));

                if (id != undefined) {
                    update_form({
                        '_token' : '{{ csrf_token() }}',
                        'type' : val,
                    }, id)
                }
                e.stopImmediatePropagation();
            });

            $(document).on('click', `#save-label-${click}`, function (e) {
                if (id != undefined) {
                    update_form({
                        '_token' : '{{ csrf_token() }}',
                        'label_name' : $(`#value-label-${click}`).val(),
                        'field_name' : convertToSlug($(`#value-label-${click}`).val()),
                        'max_size' : $(`#value-max-size-${click}`).val(),
                    }, id);
                }
                e.stopImmediatePropagation();
            });

            $(document).on('change', `#file-size-${click}`, function (e) {

                if (id != undefined) {
                    update_form({
                        '_token' : '{{ csrf_token() }}',
                        'max_size' : $(this).val(),
                    }, id)
                }
                e.stopImmediatePropagation();
            });

            $(document).on('change', `.file-type-${click}`, function (e) {

                var val = [];
                var cboxes = $(`.file-type-${click}`);
                var len = cboxes.length;
                for (var i=0; i < len; i++) {
                    if(cboxes[i].checked) {
                        val.push(cboxes[i].value);
                    }
                }

                if (id != undefined) {
                    update_form({
                        '_token' : '{{ csrf_token() }}',
                        'file_type' : JSON.stringify(val),
                    }, id)
                }
                e.stopImmediatePropagation();
            });

            $(document).on('change', `#file-template-${click}`, function (e) {
                if (id != undefined) {
                    update_form({
                        '_token' : '{{ csrf_token() }}',
                        'file_template' : $(this)[0].files[0],
                    },
                    id,
                    function(res) {
                        if ($(`#show-template-${click}`).length) {
                            $(`#show-template-${click}`).attr('href', res.data.full_url_template);
                        }else{
                            $(`#file-template-${click}`).after(`<a href="${res.data.full_url_template}" target="_blank" id="show-template-${click}">lihat file</a><br>`);
                        }
                    }
                    );

                }

                e.stopImmediatePropagation();
            });

            $(document).on('click', `#delete-${click}`,function (e) {

                if(confirm('Apakah Yakin ini menghapus ini?') == true) {
                    if (id != undefined) {
                        var url = "{{ route('form_dinamis.destroy_form', ['id' => 'ID']) }}";
                        var urlFix2 = url.replace('ID', id);

                        $.ajax({
                            type: "DELETE",
                            url: urlFix2,
                            data: {
                                '_token' : '{{ csrf_token() }}'
                            },
                            dataType: "JSON",
                            success: function (response) {
                                // $(`.add .form-group`)[click].remove();
                                get_list();
                                if (response.data.jml_data == 0) {
                                    form_tambah(click);
                                }

                                showAlert(response.message, 'success');
                            },
                            error: function (err) {
                                // console.log(err);
                                showAlert(response.message, 'danger');
                                $(`.add`).html('');
                                get_list();
                            }
                        });
                    }
                }else{
                    console.log('hapus gagal');
                }

                e.stopImmediatePropagation();
            });

            $(document).on('change', `#hide-${click}`, function (e) {

                if (id != undefined) {
                    update_form({
                        '_token' : '{{ csrf_token() }}',
                        'is_publish' : $(this).is(":checked") ? 1 : 0,
                    }, id)
                }
                e.stopImmediatePropagation();
            });

            $(document).on('change', `#required-${click}`, function (e) {

                if (id != undefined) {
                    update_form({
                        '_token' : '{{ csrf_token() }}',
                        'is_required' : $(this).is(":checked") ? 1 : 0,
                    }, id)
                }
                e.stopImmediatePropagation();
            });

        });

        function get_list() {
            var url = "{{ route('form_dinamis.get_form') }}";

            //mengambil data form yg sudah di input
            $.ajax({
                type: "GET",
                url: url,
                dataType: "JSON",
                data: Object.assign({}, paramsForm),
                success: function (response) {
                    $(`.add`).html('');
                    var data = response.data;
                    //cek data
                    if (data.length > 0) {
                        click = data.length ;
                        //loop form edit
                        $.map(data, function (v, i) {
                            list_type = JSON.parse(v.list_type) ?? [];
                            fileType = JSON.parse(v.file_type) ?? [];

                            $(`.add`).append(c_form_group(i, v.type, v.label_name, v.field_name, list_type, fileType, v.max_size, v.full_url_template, v.is_publish == 1 ? true : false, v.is_required == 1 ? true : false ) );

                            $(`.add .form-group`).eq(i).attr('data-id', v.id);
                            // if (i == 0) {
                            //     id = v.id;
                            // }

                            $(`#save-label-${i}`).hide();
                            $(`#delete-${i}`).hide();
                            $(`#form-type-${i} .btn_option`).hide();
                        });

                        form_tambah(click);

                    }else{
                        form_tambah(click);
                    }

                },
                error: function (err) {
                    console.log(err);
                    alert('Terjadi Kesalahan');
                }
            });
        }

        function form_tambah(index) {
            //form tambah
            $(`.add`).append(c_form_group(index, ''));
            $(`.add .form-group`).eq(index).addClass('unsortable');
            $(`#save-label-${index}`).hide();
            $(`#delete-${index}`).hide();
        }

        function c_form_group(index = 0, type = '', label = '', name = '', data_option = [], type_file = [], file_size = 0, file_template = '', hide = false, required = false)
        {
            return `
            <div class="form-group">
                <div class="row">
                    <div class="col-lg-10">
                        <section class="card shadow">
                            <div class="ch"></div>
                            <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <input type="text" class="form-control label_name" value="${label}" placeholder="Label" id="value-label-${index}" style="width: 75%; display: inline-block">
                                            <button type="button" class="btn btn-sm btn-primary" id="save-label-${index}"><i class="fa fa-save"></i></button>
                                        </div>
                                        <div class="col-lg-6" id="form-list-${index}">
                                            ${type_form(index, type)}
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-lg-12" id="form-type-${index}">
                                            ${c_form_type(index, type, data_option, type_file, file_size, file_template)}
                                        </div>
                                    </div>

                                    <hr>

                                    <div class="row">
                                        <div class="col-lg-12 text-right">
                                            <button type="button" class="btn btn-sm btn-danger" id="delete-${index}"><i class="fa fa-trash"></i></button>
                                            &nbsp;
                                            &nbsp;
                                            &nbsp;
                                            <input type="checkbox" class="form-check-input" id="hide-${index}" ${hide ? 'checked ' : ''}>
                                            <label class="form-check-label" for="hide-${index}">Hide?</label>

                                            &nbsp;
                                            &nbsp;
                                            &nbsp;
                                            <input type="checkbox" class="form-check-input" id="required-${index}" ${required ? 'checked ' : ''}>
                                            <label class="form-check-label" for="required-${index}">Required?</label>

                                        </div>
                                    </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
            `
            ;
        }

        function type_form(index, type) {
            const list = [
                {'type' : '', 'label' : 'Pilih Tipe'},
                {'type' : 'text', 'label' : 'Jawaban singkat'},
                {'type' : 'textarea', 'label' : 'Paragraf'},
                {'type' : 'radio', 'label' : 'Pilihan ganda'},
                {'type' : 'checkbox', 'label' : 'Kotak Centang'},
                {'type' : 'select', 'label' : 'Drop-down'},
                {'type' : 'date', 'label' : 'Tanggal'},
                {'type' : 'file', 'label' : 'Upload file'},
                {'type' : 'hidden', 'label' : 'Hidden'},
            ];

            var option = '';
            list.map( (v, i) => {
                option += `<option value="${v.type}" ${type == v.type ? ' selected ' : ''}>${v.label}</option>`;
            });

            return `<select name="" id="pilih-type-${index}" class="custom-select">
                        ${option}
                    </select>`;
        }

        function c_form_type(index = 0, type = '', data_option, type_file, file_size, file_template) {
            var form = '';
            if (type == 'text') {
                form += `<input type="text" class="form-control" placeholder="Text Jawaban Singkat" readonly>`;
            }else if (type == 'textarea') {
                form += `<textarea cols="30" rows="10" class="form-control" readonly>Text Jawaban Panjang</textarea>`;
            }else if (type == 'radio') {
                form += `<div class="add-option">${list_option(true, list_type)}</div>`;
            }else if (type == 'checkbox') {
                form += `<div class="add-option">${list_option(true, list_type)}</div>`;
            }else if (type == 'select') {
                form += `<div class="add-option">${list_option(true, list_type)}</div>`;
            }else if (type == 'date') {
                form += `<input type="date" class="form-control" placeholder="Jawaban" readonly>`;
            }else if (type == 'file') {
                var typeFile = [
                    {'label' : 'PDF', 'value' : '.pdf'},
                    {'label' : 'Dokumen', 'value' : '.doc,.docm,.dotm,.docx,.dotx'},
                    {'label' : 'Gambar', 'value' : '.gif,.jpeg,.jpg,.png,.svg,.webp'}
                ];

                var checkboxTypeFile = '<label>Izinkan hanya jenis file tertentu</label> <div class="form-check" style="width: 200px;">';
                $.map(typeFile, function (v, k) {
                    checkboxTypeFile += `
                        <input class="form-check-input file-type-${index}" type="checkbox" value="${v.value}" ${(type_file || []).filter(element => element == v.value).length > 0 ? 'checked' : '' }>
                        <label class="form-check-label">
                            ${v.label}
                        </label>
                    `;
                });
                checkboxTypeFile += '</div>';

                var size = [500, 1024, 2048, 5120, 10240];
                var selectSize = `<div class="row">
                    <label for="" class="col-sm-3">Ukuran file maksimal</label>
                        <div class="col-sm-9">
                            <select name="" id="file-size-${index}" class="custom-select" >`;
                        selectSize += `<option value="">Ukuran maksimal file</option>`;
                    $.map(size, function (v, k) {
                        selectSize += `<option value="${v}" ${file_size == v ? ' selected ' : ''}>${formatFileSize(v)}</option>`;
                    });
                selectSize += '</select> </div> </div>';

                form += `
                    <div class="container">
                        ${checkboxTypeFile}
                    </div>
                    <br>

                    <p>Template</p>
                    <input type="file" class="form-control" name="" id="file-template-${index}">
                    ${file_template != '' ? `<a href="${file_template}" target="_blank" id="show-template-${index}">lihat file</a><br>` : `` }

                    <br>
                    ${selectSize}
                    <br>
                    <input type="file" class="form-control" placeholder="Jawaban" disabled >
                `;
            } else {
                form += ``;
            }
            return form;
        }

        function convertToSlug( str = '' ) {
            //replace all special characters
            str = str.replace(/[`~!@#$%^&*()_\-+=\[\]{};:'"\\|\/,.<>?\s]/g, '_')
                    .toLowerCase();

            // trim spaces at start and end of string
            str = str.replace(/^\s+|\s+$/gm,'');

            // replace space with dash/hyphen
            str = str.replace(/\s+/g, '_');
            return str;
        }

        function formatFileSize(kilobytes,decimalPoint) {
            if(kilobytes == 0) return '0 KB';
            var k = 1024,
                dm = decimalPoint || 2,
                sizes = ['KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'],
                i = Math.floor(Math.log(kilobytes) / Math.log(k));
            return parseFloat((kilobytes / Math.pow(k, i)).toFixed(dm)) + ' ' + sizes[i];
        }

        function indexInClass(node) {
            var collection = $(`.add .form-group`);
            for (var i = 0; i < collection.length; i++) {
            if (collection[i] === node)
                return i;
            }
            return -1;
        }

        function update_form(data, id, callbackResponseSuccess = () => {}) {
            var url = "{{ route('form_dinamis.update_form', ['id' => 'ID']) }}";
            var urlFix = url.replace('ID', id);

            var formData = new FormData();
            for (const [key, value] of Object.entries(data)) {
                formData.append(key, value);
            }

            $.ajax({
                type: "POST",
                url: urlFix,
                data: formData,
                dataType: "JSON",
                mimeType: 'multipart/form-data',
                processData: false,
                contentType: false,
                success: function (response) {
                    callbackResponseSuccess(response);
                    showAlert(response.message, 'success');
                },
                error: function (err) {
                    if (err.status == 422) {
                        var e = showErorValidation(err.responseJSON.errors);
                        alert(e);
                    }else{
                        alert(err.responseJSON.errors);
                    }
                }
            });
            return null;
        }

        function showErorValidation(messages = {})
        {
            var error = ''
            // console.log(Object.keys(messages).length);
            if (Object.keys(messages).length > 0) {
                Object.keys(messages).map( (k, i) => {
                    error += messages[k].toString();
                });
            }
            return error;
        }

        const btn_option = () =>  {
            return {
                add : `<button type="button" class="btn btn-sm btn-primary tambah-list"><i class="fa fa-plus-square"></i></button>`,
                delete : `<button type="button" class="btn btn-sm btn-danger delete-list"><i class="fa fa-trash"></i></button>`,
                save : `<button type="button" class="btn btn-sm btn-primary save-list"><i class="fa fa-save"></i></button>`,
            }
        }

        const input_option = (label_value, value = '', label = '') => {
            if (label_value) {
                return `<div class="input_option my-1" style="display: inline-block; width: 80%" >
                    <input type="text" name="label" value="${label}" class="form-control" placeholder="Label" style="width: 45%; display: inline-block">
                <input type="text" name="value" value="${value}" class="form-control" placeholder="Value" style="width: 45%; display: inline-block;"> </div>`;
            }else{
                return `<div class="input_option my-1" style="display: inline-block; width: 80%" >
                    <input type="text" name="label" value="${label}" class="form-control" placeholder="Label" style="width: 90%; display: inline-block">
                </div>`;
            }
        }

        function list_option(label_value = true, list_type = [])
        {
            var jml_option = list_type.length;

            var html = ``;

            if (jml_option > 0) {
                $.each(list_type, function(i, v) {
                    html += input_option(label_value, v.value, v.label);
                    html += `<div class="btn_option" style="display: inline-block;">
                                ${ jml_option - 1 === i ? btn_option().add : btn_option().save +' '+  btn_option().delete }
                            </div>`;
                });
            }else{
                html += input_option(label_value);
                html += `<div class="btn_option" style="display: inline-block;">
                            ${btn_option().add}
                        </div>`;
            }

            add_option(label_value);

            return html;
        }

        function add_option(label_value = true)
        {
            $(document).on('click', `.tambah-list`, function(e) {

                if (id != undefined) {
                    $(this).parent().find('.save-list').remove();
                    $(this).parent().find('.delete-list').remove();
                    $(this).parent().append(btn_option().save +' '+ btn_option().delete);
                }

                list_type = get_value_option(this);

                if (id != undefined) {
                    update_form({
                        '_token' : '{{ csrf_token() }}',
                        'is_publish' : 0,
                        'is_required' : 0,
                        'list_type' : JSON.stringify(list_type),
                    }, id);
                }

                $(this).parent().before().parent().before().append(list_option(label_value));
                $(this).remove();

                // console.log(list_type);

                e.stopImmediatePropagation();
            });

            $(document).on('click', `.save-list`, function(e) {

                list_type = get_value_option(this);

                if (id != undefined) {
                    update_form({
                        '_token' : '{{ csrf_token() }}',
                        'is_publish' : 0,
                        'is_required' : 0,
                        'list_type' : JSON.stringify(list_type),
                    }, id);
                }

                // console.log(list_type);

                e.stopImmediatePropagation();
            });

            $(document).on('click', `.delete-list`, function(e) {
                var add_option = $(this).parent().before().parent().before();
                var this_class = $(this).parent();
                var this_index = add_option.find('.btn_option').index(this_class);

                list_type = get_value_option(this,this_index);

                add_option.find('.input_option').eq(this_index).remove();
                this_class.remove();

                if (id != undefined) {
                    update_form({
                        '_token' : '{{ csrf_token() }}',
                        'is_publish' : 0,
                        'is_required' : 0,
                        'list_type' : JSON.stringify(list_type),
                    }, id);
                }

                // console.log(list_type);

                if (list_type.length == 0) {
                    $(this).parent().before().parent().before().append(list_option(label_value));
                }

                e.stopImmediatePropagation();
            });
        }

        function get_value_option(e, delete_index = null)
        {
            var form_list_option = $(e).parent().before().parent().before().find('.input_option');
            // console.log(form_list_option.length);
            var data = [];
            for (let i = 0; i < form_list_option.length; i++) {

                if (delete_index != null) {
                    if (i != delete_index) {
                        var label = form_list_option.find('input[name=label]').eq(i).val() ?? '';
                        var value = form_list_option.find('input[name=value]').eq(i).val() ?? '';
                        if (label != '' || value != '') {
                            data.push({ 'label' : label, 'value' : value });
                        }
                    }
                }else{
                    var label = form_list_option.find('input[name=label]').eq(i).val() ?? '';
                    var value = form_list_option.find('input[name=value]').eq(i).val() ?? '';

                    if (label != '' || value != '') {
                        data.push({ 'label' : label, 'value' : value });
                    }
                }
            }

            return data;
        }

    </script>
@endsection
