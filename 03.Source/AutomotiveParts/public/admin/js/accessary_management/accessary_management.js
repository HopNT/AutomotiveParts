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

$(document).ready(function () {
    loadTableAccessary();

    $('.modal').on('hidden.bs.modal', function(){
        $(this).find('form')[0].reset();
    });

    onloadPhoto('form-accessary', 'photo_top');
    onloadPhoto('form-accessary', 'photo_bottom');
    onloadPhoto('form-accessary', 'photo_left');
    onloadPhoto('form-accessary', 'photo_right');
    onloadPhoto('form-accessary', 'photo_inner');
    onloadPhoto('form-accessary', 'photo_outer');

    $(function() {
        CKEDITOR.replace('description');
    });

    // Open modal add new acccessary
    $('body').on('click', '#btn_add_new_accessary', function () {
        resetFormAccessary();
        loadTrademark('form-accessary', 'select-trademark', 'trademark_id', 'trademark_id');
        loadNation('form-accessary', 'select-nation', 'nation_id', 'nation_id');
        $('#form-accessary #accessary_link').select2({
            ajax: {
                url: '/admin/accessary/searchByTextLimited',
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
            placeholder: 'Nhập mã phụ tùng/tên phụ tùng...',
            allowClear: true,
            multiple: true
        });
        $('#modal_add_update_accessary #title-add').css('display', 'block');
        $('#modal_add_update_accessary #title-update').css('display', 'none');
        $('#modal_add_update_accessary').modal();
    });

    // Open modal update accessary
    $('body').on('click', '#btn_update_accessary', function () {
        resetFormAccessary();
        loadTrademark('form-accessary', 'select-trademark', 'trademark_id', 'trademark_id');
        loadNation('form-accessary', 'select-nation', 'nation_id', 'nation_id');
        $('#form-accessary #accessary_link').select2({
            ajax: {
                url: '/admin/accessary/searchByTextLimited',
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
            placeholder: 'Nhập mã phụ tùng/tên phụ tùng...',
            allowClear: true,
            multiple: true
        });
        $('#modal_add_update_accessary #title-add').css('display', 'none');
        $('#modal_add_update_accessary #title-update').css('display', 'block');
        $('#modal_add_update_accessary').modal();
        let url = $(this).attr('href');
        $.ajax({
            type: 'GET',
            url: url,
            success: function (result) {
                // $("#form-parts input[name='parts_id']").val(result.data.parts_id);
                // $("#form-parts select[name='catalog_parts_id']").val(result.data.catalog_parts_id);
                // $("#form-parts input[name='code']").val(result.data.code);
                // $("#form-parts input[name='name']").val(result.data.name);
                // $("#form-parts input[name='width']").val(result.data.width);
                // $("#form-parts input[name='height']").val(result.data.height);
                // $("#form-parts input[name='number_of_tooth']").val(result.data.number_of_tooth);
                // $("#form-parts input[name='inner_diameter']").val(result.data.inner_diameter);
                // $("#form-parts input[name='outer_diameter']").val(result.data.outer_diameter);
                // $("#form-parts input[name='torque']").val(result.data.torque);
                // $("#form-parts input[name='life_cycle']").val(result.data.life_cycle);
                // $("#form-parts input[name='weight']").val(result.data.weight);
                // $("#form-parts input[name='liquor']").val(result.data.liquor);
                // $("#form-parts textarea[name='description']").val(result.data.description);
                //
                if (result.list != undefined && result.list.length > 0) {
                    $.each(result.list, function (index, item) {
                        let option = "<option value='" + item.accessary_id + "' selected='selected'>" + (item.code + " - " + item.name_vi) + "</option>";
                        $('#form-accessary #accessary_link').append(option);
                    });
                    $('#form-accessary #accessary_link').trigger('change');
                }

                if (result.data.photo_top != undefined && result.data.photo_top != null && result.data.photo_top != '') {
                    console.log(result.data.photo_top);
                    var img = $('<img/>', {
                        id: 'photo_top',
                        width: 250,
                        height: 200
                    });
                    $("#form-accessary #photo_top_image_preview_input_title").text("Thay đổi");
                    $("#form-accessary #photo_top_image_preview_clear").show();
                    $("#form-accessary #photo_top_image_preview_filename").val(result.data.photo_top_name);
                    img.attr('src', result.data.photo_top);
                    $("#form-accessary #photo_top_image_preview").attr("data-content", $(img)[0].outerHTML).popover("show");
                }

                if (result.data.photo_bottom != undefined && result.data.photo_bottom != null && result.data.photo_bottom != '') {
                    var img = $('<img/>', {
                        id: 'photo_bottom',
                        width: 250,
                        height: 200
                    });
                    $("#form-accessary #photo_bottom_image_preview_input_title").text("Thay đổi");
                    $("#form-accessary #photo_bottom_image_preview_clear").show();
                    $("#form-accessary #photo_bottom_image_preview_filename").val(result.data.photo_bottom_name);
                    img.attr('src', result.data.photo_bottom);
                    $("#form-accessary #photo_bottom_image_preview").attr("data-content", $(img)[0].outerHTML).popover("show");
                }

                if (result.data.photo_left != undefined && result.data.photo_left != null && result.data.photo_left != '') {
                    var img = $('<img/>', {
                        id: 'photo_left',
                        width: 250,
                        height: 200
                    });
                    $("#form-accessary #photo_left_image_preview_input_title").text("Thay đổi");
                    $("#form-accessary #photo_left_image_preview_clear").show();
                    $("#form-accessary #photo_left_image_preview_filename").val(result.data.photo_left_name);
                    img.attr('src', result.data.photo_left);
                    $("#form-accessary #photo_left_image_preview").attr("data-content", $(img)[0].outerHTML).popover("show");
                }

                if (result.data.photo_right != undefined && result.data.photo_right != null && result.data.photo_right != '') {
                    var img = $('<img/>', {
                        id: 'photo_right',
                        width: 250,
                        height: 200
                    });
                    $("#form-accessary #photo_right_image_preview_input_title").text("Thay đổi");
                    $("#form-accessary #photo_right_image_preview_clear").show();
                    $("#form-accessary #photo_right_image_preview_filename").val(result.data.photo_right_name);
                    img.attr('src', result.data.photo_right);
                    $("#form-accessary #photo_right_image_preview").attr("data-content", $(img)[0].outerHTML).popover("show");
                }

                if (result.data.photo_inner != undefined && result.data.photo_inner != null && result.data.photo_inner != '') {
                    var img = $('<img/>', {
                        id: 'photo_inner',
                        width: 250,
                        height: 200
                    });
                    $("#form-accessary #photo_inner_image_preview_input_title").text("Thay đổi");
                    $("#form-accessary #photo_inner_image_preview_clear").show();
                    $("#form-accessary #photo_inner_image_preview_filename").val(result.data.photo_inner_name);
                    img.attr('src', result.data.photo_top);
                    $("#form-accessary #photo_inner_image_preview").attr("data-content", $(img)[0].outerHTML).popover("show");
                }

                if (result.data.photo_outer != undefined && result.data.photo_outer != null && result.data.photo_outer != '') {
                    var img = $('<img/>', {
                        id: 'photo_outer',
                        width: 250,
                        height: 200
                    });
                    $("#form-accessary #photo_outer_image_preview_input_title").text("Thay đổi");
                    $("#form-accessary #photo_outer_image_preview_clear").show();
                    $("#form-accessary #photo_outer_image_preview_filename").val(result.data.photo_outer_name);
                    img.attr('src', result.data.photo_outer);
                    $("#form-accessary #photo_outer_image_preview").attr("data-content", $(img)[0].outerHTML).popover("show");
                }

            }
        });
    });

    // Save or update accessary
    $('body').on('click', '#btn_save_accessary', function () {
        $('#form-accessary #code_error').html("");
        $('#form-accessary #name_vi_error').html("");
        let type = $('#form-accessary').attr('method');
        let url = $('#form-accessary').attr('action');
        let accessaryId = $('#form-accessary input[name="accessary_id"]').val();
        if ($('#form-accessary input[name="prioritize"]').is(":checked")) {
            $('#form-accessary input[name="prioritize"]').val(1);
        }
        $('#form-accessary #description').val(CKEDITOR.instances.description.getData());
        $.ajax({
            type: type,
            url: url,
            data: new FormData($('#form-accessary')[0]),
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
                    $("#modal_add_update_accessary #alert_error").fadeTo(2000, 500).slideUp(500, function () {
                        $("#modal_add_update_accessary #alert_error").slideUp(500);
                        $('#modal_add_update_accessary #message_error').html('');
                    });
                } else if (!result.error) {
                    $('#modal_add_update_accessary').modal('hide');
                    setTimeout(function () {
                        if (accessaryId != null && accessaryId != '') {
                            showMessage('Cập nhật thành công', 'success');
                        } else {
                            showMessage('Thêm mới thành công', 'success');
                        }
                        $('#accessary').html(result.html);
                        loadTableAccessary();
                    }, 1000);
                }
            },
            error: function (error) {
                $('#modal_add_update_accessary #message_error').html('Có lỗi xảy, vui lòng liên hệ với quản trị hệ thống! ' + error.responseJSON.message);
                $('#modal_add_update_accessary #alert_error').slideDown();
                $("#modal_add_update_accessary #alert_error").fadeTo(2000, 500).slideUp(500, function () {
                    $("#modal_add_update_accessary #alert_error").slideUp(500);
                    $('#modal_add_update_accessary #message_error').html('');
                });
            }
        });
    });

});

function resetFormAccessary() {
    $('#form-accessary #temp_price_id').val("");
    $('#form-accessary #trademark_id').val("");
    $('#form-accessary #nation_id').val("");
    $('#form-accessary #type').val("");
    $('#form-accessary #code').val("");
    $('#form-accessary #name_vi').val("");
    $('#form-accessary #name_en').val("");
    $('#form-accessary #acronym_name').val("");
    $('#form-accessary #unsigned_name').val("");
    resetPhoto('form-accessary', 'photo_top');
    resetPhoto('form-accessary', 'photo_bottom');
    resetPhoto('form-accessary', 'photo_left');
    resetPhoto('form-accessary', 'photo_right');
    resetPhoto('form-accessary', 'photo_inner');
    resetPhoto('form-accessary', 'photo_outer');
    $('#form-accessary #code_error').html("");
    $('#form-accessary #name_vi_error').html("");
    $('#form-accessary #accessary_link').html("");
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
        trigger: 'manual',
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
            $("#" + form + " #" + inputName + "_image_preview").attr("data-content", $(img)[0].outerHTML).popover("show");
        }
        reader.readAsDataURL(file);
    });
}

function resetPhoto(form, inputName) {
    $('#' + form + ' #' + inputName + '_image_preview').attr("data-content", "").popover('hide');
    $('#' + form + ' #' + inputName + '_image_preview_filename').val("");
    $('#' + form + ' #' + inputName + '_image_preview_clear').hide();
    $('#' + form + ' .image-preview-input input[name="' + inputName + '"]').val("");
    $("#" + form + " #" + inputName + "_image_preview_input_title").text("Duyệt");
    var closebtn = $('<button/>', {
        type: "button",
        text: 'x',
        id: 'close_' + inputName + '_preview',
        style: 'font-size: initial;',
    });
    closebtn.attr("class", "close pull-right");
    $('#' + form + ' #' + inputName + '_image_preview').popover({
        trigger: 'manual',
        html: true,
        title: "<strong>Xem trước</strong>" + $(closebtn)[0].outerHTML,
        content: "Không có ảnh xem trước",
        placement: 'bottom'
    });
}
