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

// Load car by catalog car
function loadCarByCatalog(catalogCarId, form, divSelectId, selectName, selectId) {
    var selectCar = '<select id="' + selectId + '" class="form-control" name="' + selectName + '">';
    selectCar += '<option value="">-- Chọn Mẫu xe --</option>';
    if (catalogCarId != undefined && catalogCarId != null && catalogCarId != "") {
        $.ajax({
            type: 'GET',
            url: '/admin/car/getByCatalog',
            data: {'id': catalogCarId},
            success: function (result) {
                $.each(result, function (i, data) {
                    selectCar += '<option value="' + data.car_id + '">' + data.name + (data.year != null ? ' - ' + data.year : '') + '</option>';
                });
                selectCar += '</select>';
                $("#" + form + " #" + divSelectId).html(selectCar);
            }
        });
    } else {
        selectCar += '</select>';
        $("#" + form + " #" + divSelectId).html(selectCar);
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

// Load All Trademark
function loadTrademark(form, divSelectId, selectName, selectId) {
    $.ajax({
        type: 'GET',
        url: '/admin/trademark/getAll',
        success: function (result) {
            let selectTrademark = '<select class="form-control" name="' + selectName + '" id="' + selectId + '">';
            selectTrademark += '<option value="">-- Chọn Thương hiệu --</option>';
            $.each(result, function (i, data) {
                selectTrademark += '<option value="' + data.trademark_id + '">' + data.name + '</option>';
            });
            selectTrademark += '</select>';
            $('#' + form + " #" + divSelectId).html(selectTrademark);
        }
    });
}

// Load All Nation
function loadNation(form, divSelectId, selectName, selectId) {
    $.ajax({
        type: 'GET',
        url: '/admin/nation/getAll',
        success: function (result) {
            let selectNation = '<select class="form-control" name="' + selectName + '" id="' + selectId + '">';
            selectNation += '<option value="">-- Chọn Quốc gia --</option>';
            $.each(result, function (i, data) {
                selectNation += '<option value="' + data.nation_id + '">' + data.name_vi + '</option>';
            });
            selectNation += '</select>';
            $('#' + form + " #" + divSelectId).html(selectNation);
        }
    });
}

// Load All year manufacture
function loadYearManufacture(form, divSelectId, selectName, selectId) {
    $.ajax({
        type: 'GET',
        url: '/admin/year-manufacture/getAll',
        success: function (result) {
            let selectYearManufacture = '<select class="form-control" name="' + selectName + '" id="' + selectId + '">';
            selectYearManufacture += '<option value="">-- Chọn Năm sản xuất --</option>';
            $.each(result, function (i, data) {
                selectYearManufacture += '<option value="' + data.year_manufacture_id + '">' + data.year + '</option>';
            });
            selectYearManufacture += '</select>';
            $('#' + form + " #" + divSelectId).html(selectYearManufacture);
        }
    });
}
