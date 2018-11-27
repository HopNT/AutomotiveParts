function loadTableQuotation() {
    $('#tbl_quotation').DataTable({
        // columnDefs: [
        //     {
        //         targets: [0, 2, 3, 4],
        //         orderable: false
        //     }
        // ],
        // order: [[1, 'asc']]
    });
}

$(document).ready(function () {
    loadTableQuotation();

    // Onload catalog car by car_brand_id
    $('body').on('change', '#form_quotation #car_brand_id', function () {
        let carBrandId = $('#form_quotation #car_brand_id').val();
        loadCatalogByCarBrand(carBrandId, 'form_quotation', 'select-catalog-car', 'catalog_car_id', 'catalog_car_id');
        // let catalogCarId = $('#form-accessary #catalog_car_id').val();
        loadCarByCatalog(null, 'form_quotation', 'select-car', 'car_id', 'car_id');
    });

    // Onload car by catalog_car_id
    $('body').on('change', '#form_quotation #catalog_car_id', function () {
        let catalogCarId = $('#form_quotation #catalog_car_id').val();
        loadCarByCatalog(catalogCarId, 'form_quotation', 'select-car', 'car_id', 'car_id');
    });

    var counter = 0;
    $("#formQuotation #addrow").on("click", function () {
        var newRow = $("<tr>");
        var cols = "";
        cols += '<td><input type="text" class="form-control" name="code[]"/></td>';
        cols += '<td><input type="text" class="form-control" name="name_vi[]"/></td>';
        cols += '<td><input type="text" class="form-control" name="nation_id[]"/></td>';
        cols += '<td><input type="text" class="form-control" name="trademark_id[]"></td>';
        cols += '<td><input type="text" class="form-control" name="garage_price[]"/></td>';
        cols += '<td><input type="text" class="form-control" name="retail_price[]"></td>';
        newRow.append(cols);
        $("#formQuotation #tbl_temp").append(newRow);
    });
});
