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

    $('body').on('input', '#form-accessary input[name="price"]', function (e) {
        e.target.value = e.target.value.replace(/[^0-9]/g,'');
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

    // Open modal add new acccessary
    $('body').on('click', '#btn_add_new_accessary', function () {
        resetFormAccessary();
        loadTrademark('form-accessary', 'select-trademark', 'trademark_id', 'trademark_id');
        loadNation('form-accessary', 'select-nation', 'nation_id', 'nation_id');
        $('#form-accessary #accessary_link').select2({
            // ajax: {
            //     url: '/admin/accessary/searchByTextLimited',
            //     dataType: 'json',
            //     data: function (params) {
            //         let query = {
            //             query: params.term
            //         }
            //         return query;
            //     },
            //     processResults: function (data) {
            //         return {
            //             results: data.items
            //         };
            //     },
            //     cache: false
            // },
            // placeholder: 'Nhập mã phụ tùng/tên phụ tùng...',
            // allowClear: true,
            // multiple: true
            tags: true,
            tokenSeparators: [',', ' '],
            placeholder: 'Nhập mã phụ tùng/tên phụ tùng...',
            allowClear: true,
            dropdownCss: {display:'none'},
            multiple: true
        });
        // $('#form-accessary #accessary_link').tagsinput({
        //     delimiterRegex: /[ ;,]+/,
        //     allowDuplicates: false,
        //     onTagExists: function(item, $tag) {
        //         $tag.hide().fadeIn();
        //     }
        // });
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
        //     ajax: {
        //         url: '/admin/accessary/searchByTextLimited',
        //         dataType: 'json',
        //         data: function (params) {
        //             let query = {
        //                 query: params.term
        //             }
        //             return query;
        //         },
        //         processResults: function (data) {
        //             return {
        //                 results: data.items
        //             };
        //         },
        //         cache: false
        //     },
        //     placeholder: 'Nhập mã phụ tùng/tên phụ tùng...',
        //     allowClear: true,
        //     multiple: true
            tags: true,
            tokenSeparators: [',', ' '],
            placeholder: 'Nhập mã phụ tùng/tên phụ tùng...',
            allowClear: true,
            dropdownCss: {display:'none'},
            multiple: true
        });
        // $('#form-accessary #accessary_link').tagsinput({
        //     delimiterRegex: /[ ;,]+/,
        //     allowDuplicates: false,
        //     onTagExists: function(item, $tag) {
        //         $tag.hide().fadeIn();
        //     }
        // });
        $('#modal_add_update_accessary #title-add').css('display', 'none');
        $('#modal_add_update_accessary #title-update').css('display', 'block');
        $('#modal_add_update_accessary').modal();
        let url = $(this).attr('href');
        $.ajax({
            type: 'GET',
            url: url,
            success: function (result) {
                $('#form-accessary input[name="code"]').prop('disabled', true);
                $('#form-accessary input[name="accessary_id"]').val(result.data.accessary_id);
                $('#form-accessary select[name="trademark_id"]').val(result.data.trademark_id);
                $('#form-accessary select[name="nation_id"]').val(result.data.nation_id);
                $('#form-accessary select[name="type"]').val(result.data.type);
                $('#form-accessary input[name="code"]').val(result.data.code);
                $('#form-accessary input[name="name_vi"]').val(result.data.name_vi);
                $('#form-accessary input[name="name_en"]').val(result.data.name_en);
                $('#form-accessary input[name="acronym_name"]').val(result.data.acronym_name);
                $('#form-accessary input[name="unsigned_name"]').val(result.data.unsigned_name);
                $('#form-accessary input[name="price"]').val(result.data.price);
                if (result.data.prioritize === 1) {
                    $('#form-accessary input[name="prioritize"]').prop('checked', true);
                }
                if (result.data.status === 0) {
                    $('#form-accessary #status').css('display', '');
                    $('#form-accessary select[name="status"]').val(result.data.status);
                }
                CKEDITOR.instances.description.setData(result.data.description);

                if (result.list != undefined && result.list.length > 0) {
                    $.each(result.list, function (index, item) {
                        let option = "<option value='" + item.code + "' selected='selected'>" + item.code + "</option>";
                        $('#form-accessary #accessary_link').append(option);
                    });
                    $('#form-accessary #accessary_link').trigger('change');
                    // var codeList = '';
                    // $.each(result.list, function (index, item) {
                    //     codeList += item.code;
                    //     codeList += ',';
                    // });
                    // $('#form-accessary #accessary_link').tagsinput('add', codeList, {preventPost: true});
                }

                if (result.data.photo_top != undefined && result.data.photo_top != null && result.data.photo_top != '') {
                    var img = $('<img/>', {
                        id: 'photo_top',
                        width: 250,
                        height: 200
                    });
                    $("#form-accessary #photo_top_image_preview_input_title").text("Thay đổi");
                    $("#form-accessary #photo_top_image_preview_clear").show();
                    $("#form-accessary #photo_top_image_preview_filename").val(result.data.photo_top_name);
                    img.attr('src', publicPath + '/' + result.data.photo_top);
                    $("#form-accessary #photo_top_image_preview").attr("data-content", $(img)[0].outerHTML).popover("hide");
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
                    img.attr('src', publicPath + '/' + result.data.photo_bottom);
                    $("#form-accessary #photo_bottom_image_preview").attr("data-content", $(img)[0].outerHTML).popover("hide");
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
                    img.attr('src', publicPath + '/' + result.data.photo_left);
                    $("#form-accessary #photo_left_image_preview").attr("data-content", $(img)[0].outerHTML).popover("hide");
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
                    img.attr('src', publicPath + '/' + result.data.photo_right);
                    $("#form-accessary #photo_right_image_preview").attr("data-content", $(img)[0].outerHTML).popover("hide");
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
                    img.attr('src', publicPath + '/' + result.data.photo_top);
                    $("#form-accessary #photo_inner_image_preview").attr("data-content", $(img)[0].outerHTML).popover("hide");
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
                    img.attr('src', publicPath + '/' + result.data.photo_outer);
                    $("#form-accessary #photo_outer_image_preview").attr("data-content", $(img)[0].outerHTML).popover("hide");
                }

            }
        });
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
        console.log($("#form-accessary #photo_top_image_preview").attr("data-content"));

        var formData = new FormData($('#form-accessary')[0]);
        formData.append('prioritize', $('#form-accessary input[name="prioritize"]').val());

        var accessaryList = $('#form-accessary #accessary_link').tagsinput('items');
        for (var i = 0; i < accessaryList.length; i++) {
            formData.append('accessary_link[' + i + ']', accessaryList[i]);
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

    $('body').on('click', '#btn_view_car', function () {
        $('#modal_view_used_car').modal();
    });

});

function resetFormAccessary() {
    $('#form-accessary #accessary_id').val("");
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
    $('#form-accessary #accessary_link').html("");
    $('#form-accessary #code_error').html("");
    $('#form-accessary #name_vi_error').html("");
    $('#form-accessary input[name="prioritize"]').prop('checked', false);
    $('#form-accessary input[name="code"]').prop('disabled', false);
    $('#form-accessary #status').css('display', 'none');
    $('#form-accessary select[name="status"]').val("");
    $('#form-accessary input[name="price"]').val("");
    if (CKEDITOR.instances['description']) {
        CKEDITOR.instances['description'].destroy();    
    }
    
    onloadPhoto('form-accessary', 'photo_top');
    onloadPhoto('form-accessary', 'photo_bottom');
    onloadPhoto('form-accessary', 'photo_left');
    onloadPhoto('form-accessary', 'photo_right');
    onloadPhoto('form-accessary', 'photo_inner');
    onloadPhoto('form-accessary', 'photo_outer');

    CKEDITOR.replace('description');
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
        trigger: 'hover',
        html: true,
        title: "<strong>Xem trước</strong>" + $(closebtn)[0].outerHTML,
        content: "Không có ảnh xem trước",
        placement: 'bottom'
    });
}
