$(document).ready(function () {
    loadTableCatalogParts();

    // Check all row
    $('body').on('click', '#tbl_catalog_parts #check_all', function (e) {
        if ($(this).is(':checked', true)) {
            $("#tbl_catalog_parts .checkbox").prop('checked', true);
        } else {
            $("#tbl_catalog_parts .checkbox").prop('checked', false);
        }
    });

    // Check one row
    $('body').on('click', '#tbl_catalog_parts .checkbox', function () {
        if ($('#tbl_catalog_parts .checkbox:checked').length == $('#tbl_catalog_parts .checkbox').length) {
            $('#tbl_catalog_parts #check_all').prop('checked', true);
        } else {
            $('#tbl_catalog_parts #check_all').prop('checked', false);
        }
    });

    // Open modal add new catalog parts
    $('body').on('click', '#btn_add_new_catalog_parts', function () {
        resetCatalogPartsForm();
        $('#form-catalog-parts select[name="parent_id"]').select2({
            ajax: {
                url: '/admin/catalog-parts/searchByText',
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
            placeholder: 'Nhập tên nhóm...',
            allowClear: true,
            // multiple: true
        });
        $('#modal_add_update_catalog_parts #title-add').css('display', 'block');
        $('#modal_add_update_catalog_parts #title-update').css('display', 'none');
        $('#modal_add_update_catalog_parts').modal();
    });

    // Open modal update catalog parts
    $('body').on('click', '#btn_update_catalog_parts', function () {
        resetCatalogPartsForm();
        $('#form-catalog-parts select[name="parent_id"]').select2({
            ajax: {
                url: '/admin/catalog-parts/searchByText',
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
            placeholder: 'Nhập tên nhóm...',
            allowClear: true,
            // multiple: true
        });
        $('#modal_add_update_catalog_parts #title-add').css('display', 'none');
        $('#modal_add_update_catalog_parts #title-update').css('display', 'block');
        let url = $(this).attr('href');
        $.ajax({
            type: 'GET',
            url: url,
            success: function (result) {
                let nation = result.data;
                $("#form-catalog-parts input[name='catalog_parts_id']").val(nation['catalog_parts_id']);
                $("#form-catalog-parts input[name='code']").val(nation['code']);
                $("#form-catalog-parts input[name='name']").val(nation['name']);
                $("#form-catalog-parts textarea[name='description']").val(nation['description']);
                if (result.data.icon != undefined && result.data.icon != null && result.data.icon != '') {
                    var img = $('<img/>', {
                        id: 'photo',
                        width: 250,
                        height: 200
                    });
                    $("#form-catalog-parts #photo_image_preview_input_title").text("Thay đổi");
                    $("#form-catalog-parts #photo_image_preview_clear").show();
                    $("#form-catalog-parts #photo_image_preview_filename").val(result.data.icon_name);
                    img.attr('src', publicPath + '/' + result.data.icon);
                    $("#form-catalog-parts #photo_image_preview").attr("data-content", $(img)[0].outerHTML).popover("hide");
                }
                if (result.parent != undefined && result.parent != null) {
                    let option = "<option value='" + result.parent.catalog_parts_id + "' selected='selected'>" + result.parent.name + "</option>";
                    $('#form-catalog-parts select[name="parent_id"]').append(option);
                    $('#form-catalog-parts select[name="parent_id"]').trigger('change');
                }
                if (result.data.status == 0) {
                    $('#form-catalog-parts #status').css('display', '');
                    $('#form-catalog-parts select[name="status"]').val(result.data.status);
                }
                $('#modal_add_update_catalog_parts').modal();
            }
        });
    });

    // Save or update catalog parts
    $('body').on('click', '#btn_save_catalog_parts', function () {
        let type = $('#form-catalog-parts').attr('method');
        let url = $('#form-catalog-parts').attr('action');
        let catalogPartsId = $('#form-catalog-parts input[name="catalog_parts_id"]').val();

        var formData = new FormData($('#form-catalog-parts')[0]);

        formData.append('photo_image_check', $("#form-catalog-parts #photo_image_preview").attr("data-content"));

        $.ajax({
            type: type,
            url: url,
            data: formData,
            contentType: false,
            processData: false,
            success: function (result) {
                if (result.error) {
                    $.each(result.errors, function (key, value) {
                        $("#form-catalog-parts #" + key + "_error").html(value);
                    });
                } else if (result.system_error) {
                    $('#modal_add_update_catalog_parts #message_error').html(result.message_error);
                    $('#modal_add_update_catalog_parts #alert_error').slideDown();
                    $("#modal_add_update_catalog_parts #alert_error").fadeTo(10000, 500).slideUp(500, function(){
                        $("#modal_add_update_catalog_parts #alert_error").slideUp(500);
                        $('#modal_add_update_catalog_parts #message_error').html('');
                    });
                } else if (!result.error) {
                    $('#modal_add_update_catalog_parts').modal('hide');
                    setTimeout(function () {
                        if (catalogPartsId != null && catalogPartsId != '') {
                            showMessage('Cập nhật thành công', 'success');
                        } else {
                            showMessage('Thêm mới thành công', 'success');
                        }
                        $('#catalog_parts').html(result.html);
                        // $('#parts').html(result.parts);
                        loadTableCatalogParts();
                        // loadTableParts();
                    }, 1000);
                }
            },
            error: function (error) {
                $('#modal_add_update_catalog_parts #message_error').html('Có lỗi xảy, vui lòng liên hệ với quản trị hệ thống! ' + error.responseJSON.message);
                $('#modal_add_update_catalog_parts #alert_error').slideDown();
                $("#modal_add_update_catalog_parts #alert_error").fadeTo(10000, 500).slideUp(500, function(){
                    $("#modal_add_update_catalog_parts #alert_error").slideUp(500);
                    $('#modal_add_update_catalog_parts #message_error').html('');
                });
            }
        });
    });

    // Delete one row catalog parts
    $('body').on('click', '#btn_delete_catalog_parts', function () {
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
                                $('#catalog_parts').html(rs.catalogParts);
                                $('#parts').html(rs.parts);
                                loadTableCatalogParts();
                                loadTableParts();
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

    // Delete multi row catalog parts
    $('body').on('click', '#btn_delete_multi_catalog_parts', function () {
        let idsArr = [];
        $("#tbl_catalog_parts .checkbox:checked").each(function () {
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
                        url: '/admin/catalog-parts/delete',
                        data: {'ids': idsArr},
                        success: function (rs) {
                            if (rs.error) {
                                swal('Có lỗi xảy ra, vui lòng liên hệ với quản trị hệ thống!', rs.message, 'error');
                            } else {
                                swal("Xóa thành công!", "", "success");
                                setTimeout(function () {
                                    $('#catalog_parts').html(rs.catalogParts);
                                    $('#parts').html(rs.parts);
                                    loadTableCatalogParts();
                                    loadTableParts();
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

});
