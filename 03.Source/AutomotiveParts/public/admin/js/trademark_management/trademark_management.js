function loadTableTradeMark() {
    $('#tbl_trademark').DataTable({
        columnDefs: [
            {
                targets: [0, 2, 3, 4],
                orderable: false
            }
        ],
        order: [[1, 'asc']]
    });
}

function resetTrademarkForm() {
    $('#form-trademark input[name="trademark_id"]').val("");
    $('#form-trademark input[name="code"]').val("");
    $('#form-trademark #code_error').html("");
    $('#form-trademark input[name="name"]').val("");
    $('#form-trademark textarea[name="description"]').val("");
    $('#form-trademark #status').css('display', 'none');
    $('#form-trademark select[name="status"]').val("");
}

$(document).ready(function () {

    loadTableTradeMark();

    $('.modal').on('hidden.bs.modal', function(){
        
    });

    // Check all row
    $('body').on('click', '#tbl_trademark #check_all', function (e) {
        if ($(this).is(':checked', true)) {
            $("#tbl_trademark .checkbox").prop('checked', true);
        } else {
            $("#tbl_trademark .checkbox").prop('checked', false);
        }
    });

    // Check one row
    $('body').on('click', '#tbl_trademark .checkbox', function () {
        if ($('#tbl_trademark .checkbox:checked').length == $('#tbl_trademark .checkbox').length) {
            $('#tbl_trademark #check_all').prop('checked', true);
        } else {
            $('#tbl_trademark #check_all').prop('checked', false);
        }
    });

    // Open modal add new trademark
    $('body').on('click', '#btn_add_new_trademark', function () {
        resetTrademarkForm();
        $('#modal_add_update_trademark #title-add').css('display', 'block');
        $('#modal_add_update_trademark #title-update').css('display', 'none');
        $('#modal_add_update_trademark').modal();
    });

    // Open modal update trademark
    $('body').on('click', '#btn_update_trademark', function () {
        resetTrademarkForm();
        $('#modal_add_update_trademark #title-add').css('display', 'none');
        $('#modal_add_update_trademark #title-update').css('display', 'block');
        let url = $(this).attr('href');
        $.ajax({
            type: 'GET',
            url: url,
            success: function (result) {
                let trademark = result.data;
                $("#form-trademark input[name='trademark_id']").val(trademark['trademark_id']);
                $("#form-trademark input[name='code']").val(trademark['code']);
                $("#form-trademark input[name='name']").val(trademark['name']);
                $("#form-trademark textarea[name='description']").val(trademark['description']);
                if (trademark.status == 0) {
                    $('#form-trademark #status').css('display', '');
                    $('#form-trademark select[name="status"]').val(trademark.status);
                }
                $('#modal_add_update_trademark').modal();
            }
        });
    });

    // Save or update nation
    $('body').on('click', '#btn_save_trademark', function () {
        $('#code_error').html("");
        let type = $('#form-trademark').attr('method');
        let url = $('#form-trademark').attr('action');
        let tradeMarkId = $('#form-trademark input[name="trademark_id"]').val();
        $.ajax({
            type: type,
            url: url,
            data: $('#form-trademark').serialize(),
            success: function (result) {
                if (result.error) {
                    $.each(result.errors, function (key, value) {
                        $("#form-trademark #" + key + "_error").html(value);
                    });
                } else if (result.system_error) {
                    $('#modal_add_update_trademark #message_error').html(result.message_error);
                    $('#modal_add_update_trademark #alert_error').slideDown();
                    $("#modal_add_update_trademark #alert_error").fadeTo(2000, 500).slideUp(500, function(){
                        $("#modal_add_update_trademark #alert_error").slideUp(500);
                        $('#modal_add_update_trademark #message_error').html('');
                    });
                } else if (!result.error) {
                    $('#modal_add_update_trademark').modal('hide');
                    setTimeout(function () {
                        if (tradeMarkId != null && tradeMarkId != '') {
                            showMessage('Cập nhật thành công', 'success');
                        } else {
                            showMessage('Thêm mới thành công', 'success');
                        }
                        $('#trademark').html(result.html);
                        loadTableTradeMark();
                    }, 1000);
                }
            },
            error: function (error) {
                $('#modal_add_update_trademark #message_error').html('Có lỗi xảy, vui lòng liên hệ với quản trị hệ thống! ' + error.responseJSON.message);
                $('#modal_add_update_trademark #alert_error').slideDown();
                $("#modal_add_update_trademark #alert_error").fadeTo(2000, 500).slideUp(500, function(){
                    $("#modal_add_update_trademark #alert_error").slideUp(500);
                    $('#modal_add_update_trademark #message_error').html('');
                });
            }
        });
    });

    // Delete one row nation
    $('body').on('click', '#btn_delete_trademark', function () {
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
                                $('#trademark').html(rs.html);
                                loadTableTradeMark();
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

    // Delete multi row nation
    $('body').on('click', '#btn_delete_multi_trademark', function () {
        let idsArr = [];
        $(".checkbox:checked").each(function () {
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
                        url: '/admin/trademark/delete',
                        data: {'ids': idsArr},
                        success: function (rs) {
                            if (rs.error) {
                                swal('Có lỗi xảy ra, vui lòng liên hệ với quản trị hệ thống!', rs.message, 'error');
                            } else {
                                swal("Xóa thành công!", "", "success");
                                setTimeout(function () {
                                    $('#trademark').html(rs.html);
                                    loadTableTradeMark();
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
