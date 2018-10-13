function loadTableCarBrand() {
    $('#tbl_car_brand').DataTable({
        columnDefs: [
            {
                targets: [0, 3, 4, 5],
                orderable: false
            }
        ],
        order: [[1, 'asc'], [2, 'asc']]
    });
}

function loadTableCatalogCar() {
    $('#tbl_catalog_car').DataTable({
        bSort: false
    });
}

function loadTableCar() {
    $('#tbl_car').DataTable({
        bSort: false
    });
}

function resetCarBrandForm() {
    $('#form-car-brand input[name="car_brand_id"]').val("");
    $('#form-car-brand input[name="code_brand"]').val("");
    $('#form-car-brand #code_brand_error').html("");
    $('#form-car-brand input[name="name"]').val("");
    $('#form-car-brand #name_error').html("");
    $('#form-car-brand select[name="nation_id"]').val("");
    $('#form-car-brand textarea[name="description"]').val("");
    $('#form-car-brand #status').css('display', 'none');
    $('#form-car-brand select[name="status"]').val("");
    $('#modal_add_update_car_brand input[name="code_brand"]').prop('disabled', false);
}

function resetCatalogCarForm() {
    $('#form-catalog-car-data input[name="catalog_car_id"]').val("");
    $('#form-catalog-car-data select[name="car_brand_id"]').val("");
    $('#form-catalog-car-data #car_brand_id_error').html("");
    $('#form-catalog-car-data input[name="name"]').val("");
    $('#form-catalog-car-data #name_error').html("");
    $('#form-catalog-car-data textarea[name="description"]').val("");
    $('#form-catalog-car-data #status').css('display', 'none');
    $('#form-catalog-car-data select[name="status"]').val("");
}

function resetCarForm() {
    $('#form-car input[name="car_id"]').val("");
    $('#form-car select[name="car_brand_id"]').val("");
    $('#form-car select[name="catalog_car_id"]').val("");
    $('#form-car select[name="car_manufacturer_id"]').val("");
    $('#form-car select[name="nation_id"]').val("");
    $('#form-car select[name="factory_id"]').val("");
    $('#form-car select[name="year_manufacture_id"]').val("");
    $('#form-car select[name="motion_system_id"]').val("");
    $('#form-car input[name="name"]').val("");
    $('#form-car input[name="number_of_doors"]').val("");
    $('#form-car textarea[name="description"]').val("");
    $('#form-car #parts').html('');
    $('#form-car #name_error').html("");
    $('#form-car #catalog_car_id_error').html("");
    $('#form-car #status').css('display', 'none');
    $('#form-car select[name="status"]').val("");
}
