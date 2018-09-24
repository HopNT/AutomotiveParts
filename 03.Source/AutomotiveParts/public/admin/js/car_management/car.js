$(document).ready(function () {
    loadTableCar();

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

    // Reset modal
    $('#modal_add_update_car').on('hidden.bs.modal', function (e) {
        $(this).find('form').trigger('reset');
        $('#modal_add_update_car #parts').val('').trigger('change');
    });

    // Open modal add new car
    $('body').on('click', '#btn_add_new_car', function () {
        loadCarBrand('form-car');
        $('#modal_add_update_car #title-add').css('display', 'block');
        $('#modal_add_update_car #title-update').css('display', 'none');
        $('#modal_add_update_car').modal();
    });

    // Save or update car
    $('body').on('click', '#btn_save_car', function () {
        $('#modal_add_update_car #car_brand_id_error').html("");
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
        loadCatalogByCarBrand(carBrandId, 'form-car');
    });

    // Load select2 for control
    $('#modal_add_update_car #parts').select2({
        ajax: {
            url: '/admin/parts/search-by-text',
            dataType: 'json',
            data: function (params) {
                var query = {
                    query: params.term
                }
                return query;
            },
            processResults: function (data) {
                return {
                    results: data.items
                };
            }
        },
        placeholder: 'Nhập mã bộ phận/tên bộ phận...'
    });

});
