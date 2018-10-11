function loadTableNation() {
    $('#tbl_nation').DataTable({
        columnDefs: [
            {
                targets: [0, 2, 3, 4],
                orderable: false
            }
        ],
        order: [[1, 'asc']]
    });
}

function resetNationForm() {
    $('#form-nation input[name="nation_id"]').val("");
    $('#form-nation input[name="code"]').val("");
    $('#form-nation #code_error').html("");
    $('#form-nation input[name="name_vi"]').val("");
    $('#form-nation input[name="name_en"]').val("");
    $('#form-nation textarea[name="description"]').val("");
    $('#form-nation #status').css('display', 'none');
    $('#form-nation select[name="status"]').val("");
}

$(document).ready(function () {
    loadTableNation();

    // Check all row
    $('body').on('click', '#tbl_nation #check_all', function (e) {
        if ($(this).is(':checked', true)) {
            $("#tbl_nation .checkbox").prop('checked', true);
        } else {
            $("#tbl_nation .checkbox").prop('checked', false);
        }
    });

    // Check one row
    $('body').on('click', '#tbl_nation .checkbox', function () {
        if ($('#tbl_nation .checkbox:checked').length == $('#tbl_nation .checkbox').length) {
            $('#tbl_nation #check_all').prop('checked', true);
        } else {
            $('#tbl_nation #check_all').prop('checked', false);
        }
    });

    // Open modal add new nation
    $('body').on('click', '#btn_add_new_nation', function () {
        resetNationForm();
        $('#modal_add_update_nation #title-add').css('display', 'block');
        $('#modal_add_update_nation #title-update').css('display', 'none');
        $('#modal_add_update_nation').modal();
    });

    // Open modal update nation
    $('body').on('click', '#btn_update_nation', function () {
        resetNationForm();
        $('#modal_add_update_nation #title-add').css('display', 'none');
        $('#modal_add_update_nation #title-update').css('display', 'block');
        let url = $(this).attr('href');
        $.ajax({
            type: 'GET',
            url: url,
            success: function (result) {
                let nation = result.data;
                $("#form-nation input[name='nation_id']").val(nation['nation_id']);
                $("#form-nation input[name='code']").val(nation['code']);
                $("#form-nation input[name='name_vi']").val(nation['name_vi']);
                $("#form-nation input[name='name_en']").val(nation['name_en']);
                $("#form-nation textarea[name='description']").val(nation['description']);
                if (nation.status == 0) {
                    $('#form-nation #status').css('display', '');
                    $('#form-nation select[name="status"]').val(nation.status);
                }
                $('#modal_add_update_nation').modal();
            }
        });
    });

    // Save or update nation
    $('body').on('click', '#btn_save_nation', function () {
        $('#code_error').html("");
        let type = $('#form-nation').attr('method');
        let url = $('#form-nation').attr('action');
        let nationId = $('#form-nation input[name="nation_id"]').val();
        $.ajax({
            type: type,
            url: url,
            data: $('#form-nation').serialize(),
            success: function (result) {
                if (result.error) {
                    $.each(result.errors, function (key, value) {
                        $("#form-nation #" + key + "_error").html(value);
                    });
                } else if (result.system_error) {
                    $('#modal_add_update_nation #message_error').html(result.message_error);
                    $('#modal_add_update_nation #alert_error').slideDown();
                    $("#modal_add_update_nation #alert_error").fadeTo(2000, 500).slideUp(500, function(){
                        $("#modal_add_update_nation #alert_error").slideUp(500);
                        $('#modal_add_update_nation #message_error').html('');
                    });
                } else if (!result.error) {
                    $('#modal_add_update_nation').modal('hide');
                    setTimeout(function () {
                        if (nationId != null && nationId != '') {
                            showMessage('Cập nhật thành công', 'success');
                        } else {
                            showMessage('Thêm mới thành công', 'success');
                        }
                        $('#nation').html(result.html);
                        loadTableNation();
                    }, 1000);
                }
            },
            error: function (error) {
                $('#modal_add_update_nation #message_error').html('Có lỗi xảy, vui lòng liên hệ với quản trị hệ thống! ' + error.responseJSON.message);
                $('#modal_add_update_nation #alert_error').slideDown();
                $("#modal_add_update_nation #alert_error").fadeTo(2000, 500).slideUp(500, function(){
                    $("#modal_add_update_nation #alert_error").slideUp(500);
                    $('#modal_add_update_nation #message_error').html('');
                });
            }
        });
    });

    // Delete one row nation
    $('body').on('click', '#btn_delete_nation', function () {
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
                                $('#nation').html(rs.html);
                                loadTableNation();
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
    $('body').on('click', '#btn_delete_multi_nation', function () {
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
                        url: '/admin/nation/delete',
                        data: {'ids': idsArr},
                        success: function (rs) {
                            if (rs.error) {
                                swal('Có lỗi xảy ra, vui lòng liên hệ với quản trị hệ thống!', rs.message, 'error');
                            } else {
                                swal("Xóa thành công!", "", "success");
                                setTimeout(function () {
                                    $('#nation').html(rs.html);
                                    loadTableNation();
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
