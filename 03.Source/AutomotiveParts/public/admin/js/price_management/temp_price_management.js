$(document).ready(function () {
    loadTableTempPrice();

    // Check all row
    $('body').on('click', '#tbl_temp_price #check_all', function (e) {
        if ($(this).is(':checked', true)) {
            $("#tbl_temp_price .checkbox").prop('checked', true);
        } else {
            $("#tbl_temp_price .checkbox").prop('checked', false);
        }
    });

    // Check one row
    $('body').on('click', '#tbl_temp_price .checkbox', function () {
        if ($('#tbl_temp_price .checkbox:checked').length == $('#tbl_temp_price .checkbox').length) {
            $('#tbl_temp_price #check_all').prop('checked', true);
        } else {
            $('#tbl_temp_price #check_all').prop('checked', false);
        }
    });

    // Open modal add new temp price
    $('body').on('click', '#btn_add_new_temp_price', function () {
        resetTempPriceForm();
        loadTrademark('form-temp-price', 'select-trademark', 'trademark_id', 'trademark_id');
        loadNation('form-temp-price', 'select-nation', 'nation_id', 'nation_id');
        $('#modal_add_update_temp_price #title-add').css('display', 'block');
        $('#modal_add_update_temp_price #title-update').css('display', 'none');
        $('#modal_add_update_temp_price').modal();
    });

    // Open modal update temp price
    $('body').on('click', '#btn_update_temp_price', function () {
        resetTempPriceForm();
        loadTrademark('form-temp-price', 'select-trademark', 'trademark_id', 'trademark_id');
        loadNation('form-temp-price', 'select-nation', 'nation_id', 'nation_id');
        $('#modal_add_update_temp_price #title-add').css('display', 'none');
        $('#modal_add_update_temp_price #title-update').css('display', 'block');
        $('#modal_add_update_temp_price').modal();
        let url = $(this).attr('href');
        $.ajax({
            type: 'GET',
            url: url,
            success: function (result) {
                $('#form-temp-price input[name="temp_price_id"]').val(result.data.temp_price_id);
                $('#form-temp-price select[name="trademark_id"]').val(result.data.trademark_id);
                $('#form-temp-price select[name="nation_id"]').val(result.data.nation_id);
                $('#form-temp-price input[name="code"]').val(result.data.code);
                $('#form-temp-price input[name="name_vi"]').val(result.data.name_vi);
                $('#form-temp-price input[name="name_en"]').val(result.data.name_en);
                $('#form-temp-price input[name="acronym_name"]').val(result.data.acronym_name);
                $('#form-temp-price input[name="unsigned_name"]').val(result.data.unsigned_name);
                $('#form-temp-price input[name="quantity"]').val(result.data.quantity);
                $('#form-temp-price input[name="garage_price"]').val(result.data.garage_price);
                $('#form-temp-price input[name="retail_price"]').val(result.data.retail_price);

                if (result.data.photo_top != undefined && result.data.photo_top != null && result.data.photo_top != '') {
                    var img = $('<img/>', {
                        id: 'photo_top',
                        width: 250,
                        height: 200
                    });
                    $("#form-temp-price #photo_top_image_preview_input_title").text("Thay đổi");
                    $("#form-temp-price #photo_top_image_preview_clear").show();
                    $("#form-temp-price #photo_top_image_preview_filename").val(result.data.photo_top_name);
                    img.attr('src', result.data.photo_top);
                    $("#form-temp-price #photo_top_image_preview").attr("data-content", $(img)[0].outerHTML).popover("show");
                }

                if (result.data.photo_bottom != undefined && result.data.photo_bottom != null && result.data.photo_bottom != '') {
                    var img = $('<img/>', {
                        id: 'photo_bottom',
                        width: 250,
                        height: 200
                    });
                    $("#form-temp-price #photo_bottom_image_preview_input_title").text("Thay đổi");
                    $("#form-temp-price #photo_bottom_image_preview_clear").show();
                    $("#form-temp-price #photo_bottom_image_preview_filename").val(result.data.photo_bottom_name);
                    img.attr('src', result.data.photo_bottom);
                    $("#form-temp-price #photo_bottom_image_preview").attr("data-content", $(img)[0].outerHTML).popover("show");
                }

                if (result.data.photo_left != undefined && result.data.photo_left != null && result.data.photo_left != '') {
                    var img = $('<img/>', {
                        id: 'photo_left',
                        width: 250,
                        height: 200
                    });
                    $("#form-temp-price #photo_left_image_preview_input_title").text("Thay đổi");
                    $("#form-temp-price #photo_left_image_preview_clear").show();
                    $("#form-temp-price #photo_left_image_preview_filename").val(result.data.photo_left_name);
                    img.attr('src', result.data.photo_left);
                    $("#form-temp-price #photo_left_image_preview").attr("data-content", $(img)[0].outerHTML).popover("show");
                }

                if (result.data.photo_right != undefined && result.data.photo_right != null && result.data.photo_right != '') {
                    var img = $('<img/>', {
                        id: 'photo_right',
                        width: 250,
                        height: 200
                    });
                    $("#form-temp-price #photo_right_image_preview_input_title").text("Thay đổi");
                    $("#form-temp-price #photo_right_image_preview_clear").show();
                    $("#form-temp-price #photo_right_image_preview_filename").val(result.data.photo_right_name);
                    img.attr('src', result.data.photo_right);
                    $("#form-temp-price #photo_right_image_preview").attr("data-content", $(img)[0].outerHTML).popover("show");
                }

                if (result.data.photo_inner != undefined && result.data.photo_inner != null && result.data.photo_inner != '') {
                    var img = $('<img/>', {
                        id: 'photo_inner',
                        width: 250,
                        height: 200
                    });
                    $("#form-temp-price #photo_inner_image_preview_input_title").text("Thay đổi");
                    $("#form-temp-price #photo_inner_image_preview_clear").show();
                    $("#form-temp-price #photo_inner_image_preview_filename").val(result.data.photo_inner_name);
                    img.attr('src', result.data.photo_top);
                    $("#form-temp-price #photo_inner_image_preview").attr("data-content", $(img)[0].outerHTML).popover("show");
                }

                if (result.data.photo_outer != undefined && result.data.photo_outer != null && result.data.photo_outer != '') {
                    var img = $('<img/>', {
                        id: 'photo_outer',
                        width: 250,
                        height: 200
                    });
                    $("#form-temp-price #photo_outer_image_preview_input_title").text("Thay đổi");
                    $("#form-temp-price #photo_outer_image_preview_clear").show();
                    $("#form-temp-price #photo_outer_image_preview_filename").val(result.data.photo_outer_name);
                    img.attr('src', result.data.photo_outer);
                    $("#form-temp-price #photo_outer_image_preview").attr("data-content", $(img)[0].outerHTML).popover("show");
                }
            }
        });
    });

    // Open modal approve temp price
    $('body').on('click', '#link_approve_temp_price', function () {
        resetTempPriceForm();
        $('#modal_add_update_temp_price #title-add').css('display', 'block');
        $('#modal_add_update_temp_price #title-update').css('display', 'none');
        $('#modal_add_update_temp_price').modal();
    });

    // Save or update temp price
    $('body').on('click', '#btn_save_temp_price', function () {
        $('#form-temp-price #code_error').html("");
        $('#form-temp-price #name_vi_error').html("");
        let type = $('#form-temp-price').attr('method');
        let url = $('#form-temp-price').attr('action');
        let tempPriceId = $('#form-temp-price input[name="temp_price_id"]').val();
        $.ajax({
            type: type,
            url: url,
            data: new FormData($('#form-temp-price')[0]),
            contentType: false,
            processData: false,
            success: function (result) {
                if (result.error) {
                    $.each(result.errors, function (key, value) {
                        $("#form-temp-price #" + key + "_error").html(value);
                    });
                } else if (result.system_error) {
                    $('#modal_add_update_temp_price #message_error').html(result.message_error);
                    $('#modal_add_update_temp_price #alert_error').slideDown();
                    $("#modal_add_update_temp_price #alert_error").fadeTo(2000, 500).slideUp(500, function(){
                        $("#modal_add_update_temp_price #alert_error").slideUp(500);
                        $('#modal_add_update_temp_price #message_error').html('');
                    });
                } else if (!result.error) {
                    $('#modal_add_update_temp_price').modal('hide');
                    setTimeout(function () {
                        if (tempPriceId != null && tempPriceId != '') {
                            showMessage('Cập nhật thành công', 'success');
                        } else {
                            showMessage('Thêm mới thành công', 'success');
                        }
                        $('#temp_price').html(result.html);
                        loadTableTempPrice();
                    }, 1000);
                }
            },
            error: function (error) {
                $('#modal_add_update_temp_price #message_error').html('Có lỗi xảy, vui lòng liên hệ với quản trị hệ thống! ' + error.responseJSON.message);
                $('#modal_add_update_temp_price #alert_error').slideDown();
                $("#modal_add_update_temp_price #alert_error").fadeTo(2000, 500).slideUp(500, function(){
                    $("#modal_add_update_temp_price #alert_error").slideUp(500);
                    $('#modal_add_update_temp_price #message_error').html('');
                });
            }
        });
    });

    // Delete one row temp price
    $('body').on('click', '#btn_delete_temp_price', function () {
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
                                $('#temp_price').html(rs.html);
                                loadTableTempPrice();
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

    // Delete multi row temp price
    $('body').on('click', '#btn_delete_multi_temp_price', function () {
        let idsArr = [];
        $("#tbl_temp_price .checkbox:checked").each(function () {
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
                        url: '/admin/temp-price/delete',
                        data: {'ids': idsArr},
                        success: function (rs) {
                            if (rs.error) {
                                swal('Có lỗi xảy ra, vui lòng liên hệ với quản trị hệ thống!', rs.message, 'error');
                            } else {
                                swal("Xóa thành công!", "", "success");
                                setTimeout(function () {
                                    $('#temp_price').html(rs.html);
                                    loadTableTempPrice();
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

    onloadPhoto('form-temp-price', 'photo_top');
    onloadPhoto('form-temp-price', 'photo_bottom');
    onloadPhoto('form-temp-price', 'photo_left');
    onloadPhoto('form-temp-price', 'photo_right');
    onloadPhoto('form-temp-price', 'photo_inner');
    onloadPhoto('form-temp-price', 'photo_outer');

});

function loadTableTempPrice() {
    $('#tbl_temp_price').DataTable({
        "bSort": false
    });
}

function resetTempPriceForm() {
    $('#form-temp-price #temp_price_id').val("");
    $('#form-temp-price #trademark_id').val("");
    $('#form-temp-price #nation_id').val("");
    $('#form-temp-price #code').val("");
    $('#form-temp-price #name_vi').val("");
    $('#form-temp-price #name_en').val("");
    $('#form-temp-price #acronym_name').val("");
    $('#form-temp-price #unsigned_name').val("");
    $('#form-temp-price input[name="quantity"]').val("");
    $('#form-temp-price input[name="garage_price"]').val("");
    $('#form-temp-price input[name="retail_price"]').val("");
    resetPhoto('form-temp-price', 'photo_top');
    resetPhoto('form-temp-price', 'photo_bottom');
    resetPhoto('form-temp-price', 'photo_left');
    resetPhoto('form-temp-price', 'photo_right');
    resetPhoto('form-temp-price', 'photo_inner');
    resetPhoto('form-temp-price', 'photo_outer');
    $('#form-temp-price #code_error').html("");
    $('#form-temp-price #name_vi_error').html("");
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
