// Load All Catalog Car
function loadCatalogCar(form, divSelectId, selectName, selectId) {
    $.ajax({
        type: 'GET',
        url: '/admin/catalog-car/getAll',
        success: function (result) {
            let selectCatalogCar = '<select class="form-control" name="' + selectName + '" id="' + selectId + '">';
            selectCatalogCar += '<option value="">-- Chọn Dòng xe --</option>';
            $.each(result, function(i, data) {
                selectCatalogCar += '<option value="' + data.catalog_car_id + '">' + data.name + '</option>';
            });
            selectCatalogCar += '</select>';
            $("#" + form + " #" + divSelectId).html(selectCatalogCar);
        }
    })
}

// Load All Car Brand
function loadCarBrand(form, divSelectId, selectName, selectId) {
    $.ajax({
        type: 'GET',
        url: '/admin/car-brand/getAll',
        success: function (result) {
            let selectCarBrand = '<select class="form-control" name="' + selectName + '" id="' + selectId + '">';
            selectCarBrand += '<option value="">-- Chọn Hãng xe --</option>';
            $.each(result, function(i, data) {
                selectCarBrand += '<option value="' + data.car_brand_id + '">' + data.name + '</option>';
            });
            selectCarBrand += '</select>';
            $("#" + form + " #" + divSelectId).html(selectCarBrand);
        }
    });
}

// Load Catalog Car by Car Brand
function loadCatalogByCarBrand(carBrandId, form, divSelectId, selectName, selectId) {
    var selectCatalogCar = '<select id="' + selectId + '" class="form-control" name="' + selectName + '">';
    selectCatalogCar += '<option value="">-- Chọn Dòng xe --</option>';
    if (carBrandId != undefined && carBrandId != null && carBrandId != "") {
        $.ajax({
            type: 'GET',
            url: '/admin/catalog-car/getByCarBrand',
            data: {'id': carBrandId},
            success: function (result) {
                $.each(result, function (i, data) {
                    selectCatalogCar += '<option value="' + data.catalog_car_id + '">' + data.name + '</option>';
                });
                selectCatalogCar += '</select>';
                $("#" + form + " #" + divSelectId).html(selectCatalogCar);
            }
        });
    } else {
        selectCatalogCar += '</select>';
        $("#" + form + " #" + divSelectId).html(selectCatalogCar);
    }
}

// Load Catalog Parts
function loadCatalogParts(form, divSelectId, selectName, selectId) {
    $.ajax({
        type: 'GET',
        url: '/admin/catalog-parts/getAll',
        success: function (result) {
            let selectCatalogParts = '<select class="form-control" name="' + selectName + '" id="' + selectId + '">';
            selectCatalogParts += '<option value="">-- Chọn Nhóm bộ phận xe --</option>';
            $.each(result, function(i, data) {
                selectCatalogParts += '<option value="' + data.catalog_parts_id + '">' + data.name + '</option>';
            });
            selectCatalogParts += '</select>';
            $("#" + form + " #" + divSelectId).html(selectCatalogParts);
        }
    });
}
