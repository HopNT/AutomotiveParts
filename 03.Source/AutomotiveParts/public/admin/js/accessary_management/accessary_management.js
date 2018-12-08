$(document).ready(function () {
    loadTableAccessary();

    $('#form-accessary #accessary_link').select2({
        tags: true,
        tokenSeparators: [',', ' '],
        placeholder: 'Nhập mã phụ tùng/tên phụ tùng...',
        allowClear: true,
        dropdownCss: {display: 'none'},
        multiple: true
    });

    $('#form-accessary #car_used').select2({
        ajax: {
            url: '/admin/car/searchByText',
            dataType: 'json',
            data: function (params) {
                let query = {
                    query: params.term
                }
                return query;
            },
            processResults: function (data) {
                return {
                    results: data.items
                };
            },
            cache: false
        },
        placeholder: 'Nhập mã xe / tên xe...',
        allowClear: true,
        multiple: true
    });

    $('#form-accessary #parts').select2({
        ajax: {
            url: '/admin/parts/searchByText',
            dataType: 'json',
            data: function (params) {
                let query = {
                    query: params.term
                }
                return query;
            },
            processResults: function (data) {
                return {
                    results: data.items
                };
            },
            cache: false
        },
        placeholder: 'Nhập tên bộ phận xe...',
        allowClear: true,
        multiple: true
    });

    onloadPhoto('form-accessary', 'photo_top');
    onloadPhoto('form-accessary', 'photo_bottom');
    onloadPhoto('form-accessary', 'photo_left');
    onloadPhoto('form-accessary', 'photo_right');
    onloadPhoto('form-accessary', 'photo_inner');
    onloadPhoto('form-accessary', 'photo_outer');

    CKEDITOR.replace('description');

    $('body').on('input', '#form-accessary input[name="price"]', function (e) {
        e.target.value = e.target.value.replace(/[^0-9]/g, '');
    });

    // Check all row
    $('body').on('click', '#tbl_accessary #check_all', function (e) {
        if ($(this).is(':checked', true)) {
            $("#tbl_accessary .checkbox").prop('checked', true);
        } else {
            $("#tbl_accessary .checkbox").prop('checked', false);
        }
    });

    // Check one row
    $('body').on('click', '#tbl_accessary .checkbox', function () {
        if ($('#tbl_accessary .checkbox:checked').length == $('#tbl_accessary .checkbox').length) {
            $('#tbl_accessary #check_all').prop('checked', true);
        } else {
            $('#tbl_accessary #check_all').prop('checked', false);
        }
    });

    // Onload catalog car by btn_save_accessarycar_brand_id
    $('body').on('change', '#form-accessary #car_brand_id', function () {
        let carBrandId = $('#form-accessary #car_brand_id').val();
        loadCatalogByCarBrand(carBrandId, 'form-accessary', 'select-catalog-car', 'catalog_car_id', 'catalog_car_id');
        // let catalogCarId = $('#form-accessary #catalog_car_id').val();
        loadCarByCatalog(null, 'form-accessary', 'select-car', 'car_id', 'car_id');
    });

    // Onload car by catalog_car_id
    $('body').on('change', '#form-accessary #catalog_car_id', function () {
        let catalogCarId = $('#form-accessary #catalog_car_id').val();
        loadCarByCatalog(catalogCarId, 'form-accessary', 'select-car', 'car_id', 'car_id');
    });

    // Save or update accessary
    $('body').on('click', '#btn_save_accessary', function () {
        let type = $('#form-accessary').attr('method');
        let url = $('#form-accessary').attr('action');
        let accessaryId = $('#form-accessary input[name="accessary_id"]').val();
        if ($('#form-accessary input[name="prioritize"]').is(":checked")) {
            $('#form-accessary input[name="prioritize"]').val(1);
        } else {
            $('#form-accessary input[name="prioritize"]').val(0);
        }
        $('#form-accessary #description').val(CKEDITOR.instances.description.getData());

        var formData = new FormData($('#form-accessary')[0]);
        formData.append('prioritize', $('#form-accessary input[name="prioritize"]').val());

        var accessaryList = $('#form-accessary #accessary_link').tagsinput('items');
        for (var i = 0; i < accessaryList.length; i++) {
            formData.append('accessary_link[' + i + ']', accessaryList[i]);
        }

        var carUsed = $('#form-accessary #car_used').tagsinput('items');
        for (var i = 0; i < carUsed.length; i++) {
            formData.append('car_used[' + i + ']', carUsed[i]);
        }

        formData.append('photo_top_check', $("#form-accessary #photo_top_image_preview").attr("data-content"));
        formData.append('photo_bottom_check', $("#form-accessary #photo_bottom_image_preview").attr("data-content"));
        formData.append('photo_left_check', $("#form-accessary #photo_left_image_preview").attr("data-content"));
        formData.append('photo_right_check', $("#form-accessary #photo_right_image_preview").attr("data-content"));
        formData.append('photo_inner_check', $("#form-accessary #photo_inner_image_preview").attr("data-content"));
        formData.append('photo_outer_check', $("#form-accessary #photo_outer_image_preview").attr("data-content"));

        $.ajax({
            type: type,
            url: url,
            data: formData,
            contentType: false,
            processData: false,
            success: function (result) {
                if (result.error) {
                    $.each(result.errors, function (key, value) {
                        $("#form-accessary #" + key + "_error").html(value);
                    });
                } else if (result.system_error) {
                    $('#modal_add_update_accessary #message_error').html(result.message_error);
                    $('#modal_add_update_accessary #alert_error').slideDown();
                    $("#modal_add_update_accessary #alert_error").fadeTo(10000, 500).slideUp(500, function () {
                        $("#modal_add_update_accessary #alert_error").slideUp(500);
                        $('#modal_add_update_accessary #message_error').html('');
                    });
                } else if (!result.error) {
                    // $('#modal_add_update_accessary').modal('hide');
                    setTimeout(function () {
                        if (accessaryId != null && accessaryId != '') {
                            showMessage('Cập nhật thành công', 'success');
                        } else {
                            showMessage('Thêm mới thành công', 'success');
                        }
                        // $('#accessary').html(result.html);
                        // loadTableAccessary();
                        window.location.href = '/admin/accessary-management';
                    }, 1000);
                }
            },
            error: function (error) {
                $('#modal_add_update_accessary #message_error').html('Có lỗi xảy, vui lòng liên hệ với quản trị hệ thống! ' + error.responseJSON.message);
                $('#modal_add_update_accessary #alert_error').slideDown();
                $("#modal_add_update_accessary #alert_error").fadeTo(10000, 500).slideUp(500, function () {
                    $("#modal_add_update_accessary #alert_error").slideUp(500);
                    $('#modal_add_update_accessary #message_error').html('');
                });
            }
        });
    });

    // Delete one row parts
    $('body').on('click', '#btn_delete_accessary', function () {
        let url = $(this).attr('href');
        swal({
            title: "Bạn có chắc chắn muốn xóa?",
            text: "",
            type: "warning",
            showCancelButton: true,
            confirmButtonText: "Đồng ý!",
            cancelButtonText: "Hủy bỏ!",
            closeOnConfirm: true,
            closeOnCancel: true
        }, function (isConfirm) {
            if (isConfirm) {
                $.ajax({
                    type: 'GET',
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    url: url,
                    success: function (rs) {
                        if (rs.error) {
                            swal('Có lỗi xảy ra, vui lòng liên hệ với quản trị hệ thống!', rs.message, 'error');
                        } else {
                            swal("Xóa thành công!", "", "success");
                            setTimeout(function () {
                                $('#accessary').html(rs.html);
                                loadTableAccessary();
                            }, 1000);
                        }
                    },
                    error: function (error) {
                        swal('Có lỗi xảy ra, vui lòng liên hệ với quản trị hệ thống!', error.responseJSON.message, 'error');
                    }
                });
            }
        });
    });

    // Delete multi row parts
    $('body').on('click', '#btn_delete_multi_accessary', function () {
        let idsArr = [];
        $("#tbl_accessary .checkbox:checked").each(function () {
            idsArr.push($(this).attr('data-id'));
        });

        if (idsArr.length <= 0) {
            swal("Vui lòng chọn ít nhất một bản ghi!", "", "error");
        } else {
            swal({
                title: "Bạn có chắc chắn muốn xóa?",
                text: "",
                type: "warning",
                showCancelButton: true,
                confirmButtonText: "Đồng ý!",
                cancelButtonText: "Hủy bỏ!",
                closeOnConfirm: true,
                closeOnCancel: true
            }, function (isConfirm) {
                if (isConfirm) {
                    $.ajax({
                        type: 'GET',
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        url: '/admin/accessary/delete',
                        data: {'ids': idsArr},
                        success: function (rs) {
                            if (rs.error) {
                                swal('Có lỗi xảy ra, vui lòng liên hệ với quản trị hệ thống!', rs.message, 'error');
                            } else {
                                swal("Xóa thành công!", "", "success");
                                setTimeout(function () {
                                    $('#accessary').html(rs.html);
                                    loadTableAccessary();
                                }, 1000);
                            }
                        },
                        error: function (error) {
                            swal('Có lỗi xảy ra, vui lòng liên hệ với quản trị hệ thống!', error.responseJSON.message, 'error');
                        }
                    });
                }
            });
        }
    });

    // View car used
    $('body').on('click', '#btn_view_car', function () {
        $('#modal_view_used_car').modal();
        let url = $(this).attr('href');
        $.ajax({
            type: 'GET',
            url: url,
            success: function (result) {
                if (result.data) {
                    let content = '<table class="table table-responsive-md table-hover table-bordered" style="width: 100%;"' +
                        '                        id="tbl_car_use">' +
                        '                    <thead>' +
                        '                        <tr>' +
                        '                            <th class="text-center">#</th>' +
                        '                            <th class="text-center">Hãng xe</th>' +
                        '                            <th class="text-center">Dòng xe</th>' +
                        '                            <th class="text-center">Mẫu xe</th>' +
                        '                            <th class="text-center">Năm sản xuất</th>' +
                        '                        </tr>' +
                        '                    </thead>' +
                        '                    <tbody id="data">';
                    $.each(result.data, function (index, item) {
                        content += '<tr>';
                        content += '<td class="text-center">' + (index + 1) + '</td>'
                        content += '<td>' + item.carBrandName + '</td>'
                        content += '<td>' + item.catalogCarName + '</td>'
                        content += '<td>' + item.name + '</td>'
                        content += '<td>' + item.year + '</td>'
                        content += '</tr>';
                    });
                    content += '</tbody></table>';
                    $('#modal_view_used_car #data').html(content);
                    loadTableCarUsed();
                }
            }
        })
    });

    $("#modal_import_accessary").on("hidden.bs.modal", function(){
        $(this).find('form').trigger('reset');
    });

    // Open Import
    $('body').on('click', '#btn_import', function () {
        $('#modal_import_accessary').modal();
    });

    // Import
    $('body').on('click', '#btn_process_import', function () {
        let method = $('#form_data').attr('method');
        let url = $('#form_data').attr('action');
        let files = $('#form_data :file')[0].files;
        var formData = new FormData();
        for (let i = 0; i < files.length; i++) {
            formData.append('files[' + i + ']', files[i]);
        }
        $.ajax({
            type: method,
            url: url,
            data: formData,
            contentType: false,
            processData: false,
            success: function (result) {
                if (result.system_error) {
                    $('#modal_import_accessary #message_error').html(result.system_error);
                    $('#modal_import_accessary #alert_error').slideDown();
                    $("#modal_import_accessary #alert_error").fadeTo(10000, 500).slideUp(500, function () {
                        $("#modal_import_accessary #alert_error").slideUp(500);
                        $('#modal_import_accessary #message_error').html('');
                    });
                } else {
                    $('#modal_import_accessary').modal('hide');
                    setTimeout(function () {
                        showMessage('Import ' + result.count + ' dòng thành công', 'success');
                        $('#accessary').html(result.html);
                        loadTableAccessary();
                    }, 1000);
                }
            }
        });
    });

    $('body').on('change', ':file', function() {
        var input = $(this),
            numFiles = input.get(0).files ? input.get(0).files.length : 1,
            label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
        input.trigger('fileselect', [numFiles, label]);
    });

    // We can watch for our custom `fileselect` event like this
    $('body').ready( function() {
        $(':file').on('fileselect', function (event, numFiles, label) {

            var input = $(this).parents('.input-group').find(':text'),
                log = numFiles > 1 ? numFiles + ' tệp tin được chọn' : label;

            if (input.length) {
                input.val(log);
            } else {
                if (log) alert(log);
            }

        });
    });

});

// function resetFormAccessary() {
//     $('#form-accessary #accessary_id').val("");
//     $('#form-accessary #trademark_id').val("");
//     $('#form-accessary #nation_id').val("");
//     $('#form-accessary #type').val("");
//     $('#form-accessary #code').val("");
//     $('#form-accessary #name_vi').val("");
//     $('#form-accessary #name_en').val("");
//     $('#form-accessary #acronym_name').val("");
//     $('#form-accessary #unsigned_name').val("");
//     resetPhoto('form-accessary', 'photo_top');
//     resetPhoto('form-accessary', 'photo_bottom');
//     resetPhoto('form-accessary', 'photo_left');
//     resetPhoto('form-accessary', 'photo_right');
//     resetPhoto('form-accessary', 'photo_inner');
//     resetPhoto('form-accessary', 'photo_outer');
//     $('#form-accessary #accessary_link').html("");
//     $('#form-accessary #code_error').html("");
//     $('#form-accessary #name_vi_error').html("");
//     $('#form-accessary input[name="prioritize"]').prop('checked', false);
//     $('#form-accessary input[name="code"]').prop('disabled', false);
//     $('#form-accessary #status').css('display', 'none');
//     $('#form-accessary select[name="status"]').val("");
//     $('#form-accessary input[name="price"]').val("");
//     if (CKEDITOR.instances['description']) {
//         CKEDITOR.instances['description'].destroy();
//     }
//
//     onloadPhoto('form-accessary', 'photo_top');
//     onloadPhoto('form-accessary', 'photo_bottom');
//     onloadPhoto('form-accessary', 'photo_left');
//     onloadPhoto('form-accessary', 'photo_right');
//     onloadPhoto('form-accessary', 'photo_inner');
//     onloadPhoto('form-accessary', 'photo_outer');
//
//     CKEDITOR.replace('description');
// }

function loadTableAccessary() {
    $('#tbl_accessary').DataTable({
        columnDefs: [
            {
                targets: [0, 1, 3, 4, 5],
                orderable: false
            }
        ],
        order: [2, 'asc']
    });
}

function loadTableCarUsed() {
    $('#tbl_car_use').DataTable({
        // columnDefs: [
        //     {
        //         targets: [0, 1, 3, 4, 5],
        //         orderable: false
        //     }
        // ],
        // order: [2, 'asc']
        searching: false
    });
}

function onloadPhoto(form, inputName) {
    var closebtn = $('<button/>', {
        type: "button",
        text: 'x',
        id: 'close_' + inputName + '_preview',
        style: 'font-size: initial;',
    });
    closebtn.attr("class", "close pull-right");
    $('#' + form + ' #' + inputName + '_image_preview').popover({
        trigger: 'hover',
        html: true,
        title: "<strong>Xem trước</strong>" + $(closebtn)[0].outerHTML,
        content: "Không có ảnh xem trước",
        placement: 'bottom'
    });

    $('body').on('click', '#close_' + inputName + '_preview', function () {
        $('#' + form + ' #' + inputName + '_image_preview').popover('hide');
        $('#' + form + ' #' + inputName + '_image_preview').hover(
            function () {
                $('#' + form + ' #' + inputName + '_image_preview').popover('show');
            },
            function () {
                $('#' + form + ' #' + inputName + '_image_preview').popover('hide');
            }
        )
    });

    $('body').on('click', '#' + form + ' #' + inputName + '_image_preview_clear', function () {
        $('#' + form + ' #' + inputName + '_image_preview').attr("data-content", "").popover('hide');
        $('#' + form + ' #' + inputName + '_image_preview_filename').val("");
        $('#' + form + ' #' + inputName + '_image_preview_clear').hide();
        $('#' + form + ' .image-preview-input input[name="' + inputName + '"]').val("");
        $("#" + form + " #" + inputName + "_image_preview_input_title").text("Duyệt");
    });

    $('body').on('change', '#' + form + ' .image-preview-input input[name="' + inputName + '"]', function () {
        var img = $('<img/>', {
            id: inputName,
            width: 250,
            height: 200
        });
        var file = this.files[0];
        var reader = new FileReader();
        // Set preview image into the popover data-content
        reader.onload = function (e) {
            $("#" + form + " #" + inputName + "_image_preview_input_title").text("Thay đổi");
            $("#" + form + " #" + inputName + "_image_preview_clear").show();
            $("#" + form + " #" + inputName + "_image_preview_filename").val(file.name);
            img.attr('src', e.target.result);
            $("#" + form + " #" + inputName + "_image_preview").attr("data-content", $(img)[0].outerHTML).popover("hide");
        }
        reader.readAsDataURL(file);
    });
}

// function resetPhoto(form, inputName) {
//     $('#' + form + ' #' + inputName + '_image_preview').attr("data-content", "").popover('hide');
//     $('#' + form + ' #' + inputName + '_image_preview_filename').val("");
//     $('#' + form + ' #' + inputName + '_image_preview_clear').hide();
//     $('#' + form + ' .image-preview-input input[name="' + inputName + '"]').val("");
//     $("#" + form + " #" + inputName + "_image_preview_input_title").text("Duyệt");
//     var closebtn = $('<button/>', {
//         type: "button",
//         text: 'x',
//         id: 'close_' + inputName + '_preview',
//         style: 'font-size: initial;',
//     });
//     closebtn.attr("class", "close pull-right");
//     $('#' + form + ' #' + inputName + '_image_preview').popover({
//         trigger: 'hover',
//         html: true,
//         title: "<strong>Xem trước</strong>" + $(closebtn)[0].outerHTML,
//         content: "Không có ảnh xem trước",
//         placement: 'bottom'
//     });
// }
