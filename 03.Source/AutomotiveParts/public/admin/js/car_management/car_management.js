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

function loadCarBrand(form) {
    $.ajax({
        type: 'GET',
        url: '/admin/car-brand/getAll',
        success: function (result) {
            let selectCarBrand = '<select class="form-control" name="car_brand_id" id="car_brand_id">';
            selectCarBrand += '<option value="">-- Chọn Hãng xe --</option>';
            $.each(result, function(i, data) {
                selectCarBrand += '<option value="' + data.car_brand_id + '">' + data.name + '</option>';
            });
            selectCarBrand += '</select>';
            $("#" + form + " #select-car-brand").html(selectCarBrand);
        }
    });
}

function loadCatalogByCarBrand(carBrandId, form) {
    $.ajax({
        type: 'GET',
        url: '/admin/catalog-car/getByCarBrand',
        data: {'id' : carBrandId},
        success: function (result) {
            let selectCatalogCar = '<select id="catalog_car_id" class="form-control" name="catalog_car_id">';
            selectCatalogCar += '<option value="">-- Chọn Dòng xe --</option>';
            $.each(result, function(i, data) {
                selectCatalogCar += '<option value="' + data.catalog_car_id + '">' + data.name + '</option>';
            });
            selectCatalogCar += '</select>';
            $("#" + form + " #select-catalog-car").html(selectCatalogCar);
        }
    });
}
