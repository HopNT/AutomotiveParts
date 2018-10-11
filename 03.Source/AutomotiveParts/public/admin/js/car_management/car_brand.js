$(document).ready(function () {

    loadTableCarBrand();

    $('.modal').on('hidden.bs.modal', function(){
        
    });

    // Check all row
    $('body').on('click', '#tbl_car_brand #check_all', function (e) {
        if ($(this).is(':checked', true)) {
            $("#tbl_car_brand .checkbox").prop('checked', true);
        } else {
            $("#tbl_car_brand .checkbox").prop('checked', false);
        }
    });

    // Check one row
    $('body').on('click', '#tbl_car_brand .checkbox', function () {
        if ($('#tbl_car_brand .checkbox:checked').length == $('#tbl_car_brand .checkbox').length) {
            $('#tbl_car_brand #check_all').prop('checked', true);
        } else {
            $('#tbl_car_brand #check_all').prop('checked', false);
        }
    });

    // Open modal add new car brand
    $('body').on('click', '#btn_add_new_car_brand', function () {
        resetCarBrandForm();
        $('#modal_add_update_car_brand #title-add').css('display', 'block');
        $('#modal_add_update_car_brand #title-update').css('display', 'none');
        $('#modal_add_update_car_brand').modal();
    });

    // Open modal update car brand
    $('body').on('click', '#btn_update_car_brand', function () {
        resetCarBrandForm();
        $('#modal_add_update_car_brand #title-add').css('display', 'none');
        $('#modal_add_update_car_brand #title-update').css('display', 'block');
        $('#modal_add_update_car_brand input[name="code_brand"]').prop('disabled', true);
        let url = $(this).attr('href');
        $.ajax({
            type: 'GET',
            url: url,
            dataType: 'JSON',
            success: function (rs) {
                let carBrand = rs.data;
                $("#form-car-brand input[name='car_brand_id']").val(carBrand['car_brand_id']);
                $("#form-car-brand input[name='code_brand']").val(carBrand['code_brand']);
                $('#nation_id').val(carBrand['nation_id']);
                $("#form-car-brand input[name='name']").val(carBrand['name']);
                $("#description").val(carBrand['description']);
                if (carBrand.status == 0) {
                    $('#form-car-brand #status').css('display', '');
                    $('#form-car-brand select[name="status"]').val(carBrand.status);
                }
                $('#modal_add_update_car_brand').modal();
            }
        });
    });

    // Save or update car brand
    $('body').on('click', '#btn_save_car_brand', function () {
        let type = $('#form-car-brand').attr('method');
        let url = $('#form-car-brand').attr('action');
        let carBrandId = $('#form-car-brand input[name="car_brand_id"]').val();
        $.ajax({
            type: type,
            url: url,
            data: $('#form-car-brand').serialize(),
            success: function (result) {
                if (result.error) {
                    $.each(result.errors, function (key, value) {
                        $("#form-car-brand input[name='" + key + "']").next().html(value);
                    });
                } else if (result.system_error) {
                    $('#modal_add_update_car_brand #message_error').html(result.message_error);
                    $('#modal_add_update_car_brand #alert_error').slideDown();
                    $("#modal_add_update_car_brand #alert_error").fadeTo(2000, 500).slideUp(500, function(){
                        $("#modal_add_update_car_brand #alert_error").slideUp(500);
                        $('#modal_add_update_car_brand #message_error').html('');
                    });
                } else if (!result.error) {
                    $('#modal_add_update_car_brand').modal('hide');
                    setTimeout(function () {
                        if (carBrandId != null && carBrandId != '') {
                            showMessage('Cập nhật thành công', 'success');
                        } else {
                            showMessage('Thêm mới thành công', 'success');
                        }
                        $('#car_brand').html(result.carBrand);
                        $('#catalog_car').html(result.catalogCar);
                        $('#car').html(result.car);
                        loadTableCarBrand();
                        loadTableCatalogCar();
                        loadTableCar();
                    }, 1000);
                }
            },
            error: function (error) {
                $('#modal_add_update_car_brand #message_error').html('Có lỗi xảy, vui lòng liên hệ với quản trị hệ thống! ' + error.responseJSON.message);
                $('#modal_add_update_car_brand #alert_error').slideDown();
                $("#modal_add_update_car_brand #alert_error").fadeTo(2000, 500).slideUp(500, function(){
                    $("#modal_add_update_car_brand #alert_error").slideUp(500);
                    $('#modal_add_update_car_brand #message_error').html('');
                });
            }
        });
    });

    // Delete one row car brand
    $('body').on('click', '#btn_delete_car_brand', function () {
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
                                $('#car_brand').html(rs.carBrand);
                                $('#catalog_car').html(rs.catalogCar);
                                $('#car').html(rs.car);
                                loadTableCarBrand();
                                loadTableCatalogCar();
                                loadTableCar();
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

    // Delete multi row car brand
    $('body').on('click', '#btn_delete_multi_car_brand', function () {
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
                    // let strIds = idsArr.join(",");
                    $.ajax({
                        type: 'GET',
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        url: '/admin/car-brand/delete',
                        data: {'ids': idsArr},
                        success: function (rs) {
                            if (rs.error) {
                                swal('Có lỗi xảy ra, vui lòng liên hệ với quản trị hệ thống!', rs.message, 'error');
                            } else {
                                swal("Xóa thành công!", "", "success");
                                setTimeout(function () {
                                    $('#car_brand').html(rs.carBrand);
                                    $('#catalog_car').html(rs.catalogCar);
                                    $('#car').html(rs.car);
                                    loadTableCarBrand();
                                    loadTableCatalogCar();
                                    loadTableCar();
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
