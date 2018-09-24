$(document).ready(function () {
    loadTableCatalogCar();

    // Check all row
    $('body').on('click', '#tbl_catalog_car #check_all', function (e) {
        if ($(this).is(':checked', true)) {
            $("#tbl_catalog_car .checkbox").prop('checked', true);
        } else {
            $("#tbl_catalog_car .checkbox").prop('checked', false);
        }
    });

    // Check one row
    $('body').on('click', '#tbl_catalog_car .checkbox', function () {
        if ($('#tbl_catalog_car .checkbox:checked').length == $('#tbl_catalog_car .checkbox').length) {
            $('#tbl_catalog_car #check_all').prop('checked', true);
        } else {
            $('#tbl_catalog_car #check_all').prop('checked', false);
        }
    });

    // Open modal add new catalog car
    $('body').on('click', '#btn_add_new_catalog_car', function () {
        loadCarBrand('form-catalog-car-data');
        $('#modal_add_update_catalog_car #title-add').css('display', 'block');
        $('#modal_add_update_catalog_car #title-update').css('display', 'none');
        $('#modal_add_update_catalog_car').modal();
    });

    // Open modal update catalog car
    $('body').on('click', '#btn_update_catalog_car', function () {
        loadCarBrand('form-catalog-car-data');
        $('#modal_add_update_catalog_car #title-add').css('display', 'none');
        $('#modal_add_update_catalog_car #title-update').css('display', 'block');
        let url = $(this).attr('href');
        $.ajax({
            type: 'GET',
            url: url,
            success: function (result) {
                let catalogCar = result.data;
                $("#form-catalog-car-data input[name='catalog_car_id']").val(catalogCar['catalog_car_id']);
                $("#form-catalog-car-data select[name='car_brand_id']").val(catalogCar['car_brand_id']);
                $("#form-catalog-car-data input[name='name']").val(catalogCar['name']);
                $("#form-catalog-car-data textarea[name='description']").val(catalogCar['description']);
                $('#modal_add_update_catalog_car').modal();
            }
        });
    });

    // Reset modal
    $('#modal_add_update_catalog_car').on('hidden.bs.modal', function (e) {
        $(this).find('form').trigger('reset');
    });

    // Save or update catalog car
    $('body').on('click', '#btn_save_catalog_car', function () {
        $('#form-catalog-car-data #car_brand_id_error').html("");
        $('#form-catalog-car-data #name_error').html("");
        let type = $('#form-catalog-car-data').attr('method');
        let url = $('#form-catalog-car-data').attr('action');
        let catalogCarId = $('#form-catalog-car-data input[name="catalog_car_id"]').val();
        $.ajax({
            type: type,
            url: url,
            data: $('#form-catalog-car-data').serialize(),
            success: function (result) {
                if (result.error) {
                    $.each(result.errors, function (key, value) {
                        $("#form-catalog-car-data #" + key + "_error").html(value);
                    });
                } else if (result.system_error) {
                    $('#modal_add_update_catalog_car #message_error').html(result.message_error);
                    $('#modal_add_update_catalog_car #alert_error').slideDown();
                    $("#modal_add_update_catalog_car #alert_error").fadeTo(2000, 500).slideUp(500, function(){
                        $("#modal_add_update_catalog_car #alert_error").slideUp(500);
                        $('#modal_add_update_catalog_car #message_error').html('');
                    });
                } else if (!result.error) {
                    $('#modal_add_update_catalog_car').modal('hide');
                    setTimeout(function () {
                        if (catalogCarId != null && catalogCarId != '') {
                            showMessage('Cập nhật thành công', 'success');
                        } else {
                            showMessage('Thêm mới thành công', 'success');
                        }
                        $('#catalog_car').html(result.html);
                        loadTableCatalogCar();
                    }, 1000);
                }

            },
            error: function (error) {
                $('#modal_add_update_catalog_car #message_error').html('Có lỗi xảy, vui lòng liên hệ với quản trị hệ thống! ' + error.responseJSON.message);
                $('#modal_add_update_catalog_car #alert_error').slideDown();
                $("#modal_add_update_catalog_car #alert_error").fadeTo(2000, 500).slideUp(500, function(){
                    $("#modal_add_update_catalog_car #alert_error").slideUp(500);
                    $('#modal_add_update_catalog_car #message_error').html('');
                });
            }
        });
    });

    // Delete one row car brand
    $('body').on('click', '#btn_delete_catalog_car', function () {
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
                                $('#catalog_car').html(rs.html);
                                loadTableCatalogCar();
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
    $('body').on('click', '#btn_delete_multi_catalog_car', function () {
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
                        url: '/admin/catalog-car/delete',
                        data: {'ids': idsArr},
                        success: function (rs) {
                            if (rs.error) {
                                swal('Có lỗi xảy ra, vui lòng liên hệ với quản trị hệ thống!', rs.message, 'error');
                            } else {
                                swal("Xóa thành công!", "", "success");
                                setTimeout(function () {
                                    $('#catalog_car').html(rs.html);
                                    loadTableCatalogCar();
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
