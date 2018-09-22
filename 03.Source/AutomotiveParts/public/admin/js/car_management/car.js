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
    });

    // Open modal add new car
    $('body').on('click', '#btn_add_new_car', function () {
        loadCarBrand('form-car');
        $('#modal_add_update_car #title-add').css('display', 'block');
        $('#modal_add_update_car #title-update').css('display', 'none');
        $('#modal_add_update_car').modal();
    });

    // Onload catalog car by car_brand_id
    $('body').on('change', '#form-car #car_brand_id', function () {
        let carBrandId = $('#form-car #car_brand_id').val();
        loadCatalogByCarBrand(carBrandId, 'form-car');
    });

});
