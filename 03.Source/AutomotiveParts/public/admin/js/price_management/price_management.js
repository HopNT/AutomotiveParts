function loadTablePrice() {
    $('#tbl_price').DataTable({
        "bSort": false
    });
}

function resetPriceForm() {
    $('#form-price input[name="garage_price"]').val("");
    $('#form-price input[name="retail_price"]').val("");
    $('#form-price input[name="quantity"]').val("");
    $('#form-price #accessary_id').html("");
    $('#form-price #user_id').html("");
    $('#form-price #accessary_id_error').html("");
    $('#form-price #status').css('display', 'none');
    $('#form-price select[name="status"]').val("");
}

$(document).ready(function () {

    loadTablePrice();

    $('body').on('input', '#form-price input[name="garage_price"]', function (e) {
        e.target.value = e.target.value.replace(/[^0-9]/g,'');
    });

    $('body').on('input', '#form-price input[name="retail_price"]', function (e) {
        e.target.value = e.target.value.replace(/[^0-9]/g,'');
    });

    $('body').on('input', '#form-price input[name="quantity"]', function (e) {
        e.target.value = e.target.value.replace(/[^0-9]/g,'');
    });

    // Check all row
    $('body').on('click', '#tbl_price #check_all', function (e) {
        if ($(this).is(':checked', true)) {
            $("#tbl_price .checkbox").prop('checked', true);
        } else {
            $("#tbl_price .checkbox").prop('checked', false);
        }
    });

    // Check one row
    $('body').on('click', '#tbl_price .checkbox', function () {
        if ($('#tbl_price .checkbox:checked').length == $('#tbl_price .checkbox').length) {
            $('#tbl_price #check_all').prop('checked', true);
        } else {
            $('#tbl_price #check_all').prop('checked', false);
        }
    });

    // Open modal add new price
    $('body').on('click', '#btn_add_new_price', function () {
        resetPriceForm();
        $('#form-price #user_id').select2({
            ajax: {
                url: '/admin/user/searchByText',
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
            placeholder: 'Nhập tên nhà cung cấp...'
        });
        $('#form-price #accessary_id').select2({
            ajax: {
                url: '/admin/accessary/searchByText',
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
            placeholder: 'Nhập mã phụ tùng/tên phụ tùng...'
        });
        $('#modal_add_update_price #title-add').css('display', 'block');
        $('#modal_add_update_price #title-update').css('display', 'none');
        $('#modal_add_update_price').modal();
    });

    // Open modal update price
    $('body').on('click', '#btn_update_price', function () {
        resetPriceForm();
        $('#form-price #user_id').select2({
            ajax: {
                url: '/admin/user/searchByText',
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
            placeholder: 'Nhập tên nhà cung cấp...'
        });
        $('#form-price #accessary_id').select2({
            ajax: {
                url: '/admin/accessary/searchByText',
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
            placeholder: 'Nhập mã phụ tùng/tên phụ tùng...'
        });
        $('#modal_add_update_price #title-add').css('display', 'none');
        $('#modal_add_update_price #title-update').css('display', 'block');
        $('#modal_add_update_price').modal();
        var url = $(this).attr('href');
        $.ajax({
            type: 'GET',
            url: url,
            success: function (result) {
                $('#form-price input[name="user_accessary_id"]').val(result.data.user_accessary_id);
                if (result.user != undefined && result.user != null) {
                    let option = "<option value='" + result.user.user_id + "' selected='selected'>" + result.user.name + "</option>";
                    $('#form-price #user_id').append(option);
                    $('#form-price #user_id').trigger('change');
                }
                if (result.accessary != undefined && result.accessary != null) {
                    let option = "<option value='" + result.accessary.accessary_id + "' selected='selected'>" + (result.accessary.code + " - " + result.accessary.name_vi) + "</option>";
                    $('#form-price #accessary_id').append(option);
                    $('#form-price #accessary_id').trigger('change');
                }
                $('#form-price input[name="garage_price"]').val(result.data.garage_price);
                $('#form-price input[name="retail_price"]').val(result.data.retail_price);
                $('#form-price input[name="quantity"]').val(result.data.quantity);

                if (result.data.status == 0) {
                    $('#form-price #status').css('display', '');
                    $('#form-price select[name="status"]').val(result.data.status);
                }
            }
        })
    });

    // Save or update price
    $('body').on('click', '#btn_save_price', function () {
        let type = $('#form-price').attr('method');
        let url = $('#form-price').attr('action');
        let userAccessaryId = $('#form-price input[name="user_accessary_id"]').val();
        $.ajax({
            type: type,
            url: url,
            data: $('#form-price').serialize(),
            success: function (result) {
                if (result.error) {
                    $.each(result.errors, function (key, value) {
                        $("#form-price #" + key + "_error").html(value);
                    });
                } else if (result.system_error) {
                    $('#modal_add_update_price #message_error').html(result.message_error);
                    $('#modal_add_update_price #alert_error').slideDown();
                    $("#modal_add_update_price #alert_error").fadeTo(2000, 500).slideUp(500, function () {
                        $("#modal_add_update_price #alert_error").slideUp(500);
                        $('#modal_add_update_price #message_error').html('');
                    });
                } else if (!result.error) {
                    $('#modal_add_update_price').modal('hide');
                    setTimeout(function () {
                        if (userAccessaryId != null && userAccessaryId != '') {
                            showMessage('Cập nhật thành công', 'success');
                        } else {
                            showMessage('Thêm mới thành công', 'success');
                        }
                        $('#price').html(result.html);
                        loadTablePrice();
                    }, 1000);
                }
            },
            error: function (error) {
                $('#modal_add_update_price #message_error').html('Có lỗi xảy, vui lòng liên hệ với quản trị hệ thống! ' + error.responseJSON.message);
                $('#modal_add_update_price #alert_error').slideDown();
                $("#modal_add_update_price #alert_error").fadeTo(2000, 500).slideUp(500, function () {
                    $("#modal_add_update_price #alert_error").slideUp(500);
                    $('#modal_add_update_price #message_error').html('');
                });
            }
        });
    });

    // Delete one row price
    $('body').on('click', '#btn_delete_price', function () {
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
                                $('#price').html(rs.html);
                                loadTablePrice();
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

    // Delete multi row price
    $('body').on('click', '#btn_delete_multi_price', function () {
        let idsArr = [];
        $("#tbl_price .checkbox:checked").each(function () {
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
                        url: '/admin/price/delete',
                        data: {'ids': idsArr},
                        success: function (rs) {
                            if (rs.error) {
                                swal('Có lỗi xảy ra, vui lòng liên hệ với quản trị hệ thống!', rs.message, 'error');
                            } else {
                                swal("Xóa thành công!", "", "success");
                                setTimeout(function () {
                                    $('#price').html(rs.html);
                                    loadTablePrice();
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
