$(document).ready(function () {
    loadTableCatalogParts();

    // Reset modal
    $('#modal_add_update_catalog_parts').on('hidden.bs.modal', function (e) {
        $(this).find('form').trigger('reset');
    });

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
        $('#modal_add_update_catalog_parts #title-add').css('display', 'block');
        $('#modal_add_update_catalog_parts #title-update').css('display', 'none');
        $('#modal_add_update_catalog_parts').modal();
    });

    // Save or update catalog parts
    $('body').on('click', '#btn_save_catalog_parts', function () {
        $('#name_error').html("");
        let type = $('#form-catalog-parts').attr('method');
        let url = $('#form-catalog-parts').attr('action');
        let catalogPartsId = $('#form-catalog-parts input[name="catalog_parts_id"]').val();
        $.ajax({
            type: type,
            url: url,
            data: $('#form-catalog-parts').serialize(),
            success: function (result) {
                if (result.error) {
                    $.each(result.errors, function (key, value) {
                        $("#form-catalog-parts #" + key + "_error").html(value);
                    });
                } else if (result.system_error) {
                    $('#modal_add_update_catalog_parts #message_error').html(result.message_error);
                    $('#modal_add_update_catalog_parts #alert_error').addClass('d-block');
                } else if (!result.error) {
                    $('#modal_add_update_catalog_parts').modal('hide');
                    setTimeout(function () {
                        if (catalogPartsId != null && catalogPartsId != '') {
                            showMessage('Cập nhật thành công', 'success');
                        } else {
                            showMessage('Thêm mới thành công', 'success');
                        }
                        $('#catalog_parts').html(result.html);
                        loadTableCatalogParts();
                    }, 1000);
                }
            },
            error: function (error) {
                $('#modal_add_update_catalog_parts #message_error').html('Có lỗi xảy, vui lòng liên hệ với quản trị hệ thống! ' + error.responseJSON.message);
                $('#modal_add_update_catalog_parts #alert_error').addClass('d-block');
            }
        });
    });

    // Open modal update catalog parts
    $('body').on('click', '#btn_update_catalog_parts', function () {
        $('#modal_add_update_catalog_parts #title-add').css('display', 'none');
        $('#modal_add_update_catalog_parts #title-update').css('display', 'block');
        let url = $(this).attr('href');
        $.ajax({
            type: 'GET',
            url: url,
            success: function (result) {
                let nation = result.data;
                $("#form-catalog-parts input[name='catalog_parts_id']").val(nation['catalog_parts_id']);
                $("#form-catalog-parts input[name='name']").val(nation['name']);
                $("#form-catalog-parts textarea[name='description']").val(nation['description']);
                $('#modal_add_update_catalog_parts').modal();
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
                                $('#catalog_parts').html(rs.html);
                                loadTableCatalogParts();
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
                                    $('#catalog_parts').html(rs.html);
                                    loadTableCatalogParts();
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
