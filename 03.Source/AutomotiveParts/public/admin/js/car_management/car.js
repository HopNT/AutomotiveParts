$(document).ready(function () {

    loadTableCar();

    $('body').on('input', '#form-car input[name="number_of_doors"]', function (e) {
        e.target.value = e.target.value.replace(/[^0-9]/g,'');
    });

    // Check all row
    $('body').on('click', '#tbl_car #check_all', function (e) {
        if ($(this).is(':checked', true)) {
            $("#tbl_car .checkbox").prop('checked', true);
        } else {
            $("#tbl_car .checkbox").prop('checked', false);
        }
    });

    // Check one row
    $('body').on('click', '#tbl_car .checkbox', function () {
        if ($('#tbl_car .checkbox:checked').length == $('#tbl_car .checkbox').length) {
            $('#tbl_car #check_all').prop('checked', true);
        } else {
            $('#tbl_car #check_all').prop('checked', false);
        }
    });

    // Open modal add new car
    $('body').on('click', '#btn_add_new_car', function () {
        resetCarForm();
        $('#form-car #parts').select2({
            ajax: {
                url: '/admin/parts/searchByText',
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
            placeholder: 'Nhập mã bộ phận/tên bộ phận...',
            allowClear: true,
            multiple: true
        });
        loadCarBrand('form-car', 'select-car-brand', 'car_brand_id', 'car_brand_id');
        $('#modal_add_update_car #title-add').css('display', 'block');
        $('#modal_add_update_car #title-update').css('display', 'none');
        $('#modal_add_update_car').modal();
    });

    // Open modal update car
    $('body').on('click', '#btn_update_car', function () {
        resetCarForm();
        $('#form-car #parts').select2({
            ajax: {
                url: '/admin/parts/searchByText',
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
            placeholder: 'Nhập mã bộ phận/tên bộ phận...',
            allowClear: true,
            multiple: true
        });
        loadCarBrand('form-car', 'select-car-brand', 'car_brand_id', 'car_brand_id');
        loadCatalogCar('form-car', 'select-catalog-car', 'catalog_car_id', 'catalog_car_id');
        $('#modal_add_update_car #title-add').css('display', 'none');
        $('#modal_add_update_car #title-update').css('display', 'block');
        $('#modal_add_update_car').modal();
        let url = $(this).attr('href');
        $.ajax({
            type: 'GET',
            url: url,
            success: function (result) {
                let car = result.data;
                $('#form-car input[name="car_id"]').val(car['car_id']);
                $('#form-car input[name="name"]').val(car['name']);
                $('#form-car input[name="number_of_doors"]').val(car['number_of_doors']);
                $('#form-car textarea[name="description"]').val(car['description']);

                let catalogCar = car['catalog_car'];
                $("#form-car select[name='car_brand_id']").val(catalogCar['car_brand_id']);
                $("#form-car select[name='catalog_car_id']").val(catalogCar.catalog_car_id);

                let parts = car['parts'];
                if (parts != undefined && parts.length > 0) {
                    $.each(parts, function (index, item) {
                        let option = "<option value='" + item.parts_id + "' selected='selected'>" + (item.code + " - " + item.name) + "</option>";
                        $('#form-car #parts').append(option);
                    });
                    $('#form-car #parts').trigger('change');
                }

                if (car.status == 0) {
                    $('#form-car #status').css('display', '');
                    $('#form-car select[name="status"]').val(car.status);
                }
            }
        })
    });

    // Save or update car
    $('body').on('click', '#btn_save_car', function () {
        $('#modal_add_update_car #catalog_car_id_error').html("");
        $('#modal_add_update_car #name_error').html("");
        let type = $('#form-car').attr('method');
        let url = $('#form-car').attr('action');
        let carId = $('#form-car input[name="car_id"]').val();
        $.ajax({
            type: type,
            url: url,
            data: $('#form-car').serialize(),
            success: function (result) {
                if (result.error) {
                    $.each(result.errors, function (key, value) {
                        $("#form-car #" + key + "_error").html(value);
                    });
                } else if (result.system_error) {
                    $('#modal_add_update_car #message_error').html(result.message_error);
                    $('#modal_add_update_car #alert_error').slideDown();
                    $("#modal_add_update_car #alert_error").fadeTo(2000, 500).slideUp(500, function(){
                        $("#modal_add_update_car #alert_error").slideUp(500);
                        $('#modal_add_update_car #message_error').html('');
                    });
                } else if (!result.error) {
                    $('#modal_add_update_car').modal('hide');
                    setTimeout(function () {
                        if (carId != null && carId != '') {
                            showMessage('Cập nhật thành công', 'success');
                        } else {
                            showMessage('Thêm mới thành công', 'success');
                        }
                        $('#car').html(result.html);
                        loadTableCar();
                    }, 1000);
                }
            },
            error: function (error) {
                $('#modal_add_update_car #message_error').html('Có lỗi xảy, vui lòng liên hệ với quản trị hệ thống! ' + error.responseJSON.message);
                $('#modal_add_update_car #alert_error').slideDown();
                $("#modal_add_update_car #alert_error").fadeTo(2000, 500).slideUp(500, function(){
                    $("#modal_add_update_car #alert_error").slideUp(500);
                    $('#modal_add_update_car #message_error').html('');
                });
            }
        })
    });

    // Onload catalog car by car_brand_id
    $('body').on('change', '#form-car #car_brand_id', function () {
        let carBrandId = $('#form-car #car_brand_id').val();
        loadCatalogByCarBrand(carBrandId, 'form-car', 'select-catalog-car', 'catalog_car_id', 'catalog_car_id');
    });

    // Delete one row catalog parts
    $('body').on('click', '#btn_delete_car', function () {
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
                                $('#car').html(rs.html);
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

    // Delete multi row car
    $('body').on('click', '#btn_delete_multi_car', function () {
        let idsArr = [];
        $("#tbl_car .checkbox:checked").each(function () {
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
                        url: '/admin/car/delete',
                        data: {'ids': idsArr},
                        success: function (rs) {
                            if (rs.error) {
                                swal('Có lỗi xảy ra, vui lòng liên hệ với quản trị hệ thống!', rs.message, 'error');
                            } else {
                                swal("Xóa thành công!", "", "success");
                                setTimeout(function () {
                                    $('#car').html(rs.html);
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
