function loadTableCatalogParts() {
    $('#tbl_catalog_parts').DataTable({
        columnDefs: [
            {
                targets: [0, 1, 2, 3],
                orderable: false
            }
        ],
    });
}

function loadTableParts() {
    $('#tbl_parts').DataTable({
        columnDefs: [
            {
                targets: [0, 1, 3, 4, 5],
                orderable: false
            }
        ],
        order: [[2, 'asc']]
    });
}

function resetCatalogPartsForm() {
    $('#form-catalog-parts input[name="catalog_parts_id"]').val("");
    $('#form-catalog-parts input[name="name"]').val("");
    $('#form-catalog-parts #name_error').html("");
    $('#form-catalog-parts textarea[name="description"]').val("");
}

function resetPartsForm() {
    $('#form-parts input[name="parts_id"]').val("");
    $('#form-parts select[name="catalog_parts_id"]').html("");
    $('#form-parts input[name="code"]').val("");
    $('#form-parts input[name="name"]').val("");
    $('#form-parts input[name="width"]').val("");
    $('#form-parts input[name="height"]').val("");
    $('#form-parts input[name="number_of_tooth"]').val("");
    $('#form-parts input[name="inner_diameter"]').val("");
    $('#form-parts input[name="outer_diameter"]').val("");
    $('#form-parts input[name="torque"]').val("");
    $('#form-parts input[name="life_cycle"]').val("");
    $('#form-parts input[name="weight"]').val("");
    $('#form-parts input[name="liquor"]').val("");
    $('#form-parts textarea[name="description"]').val("");
    $('#form-parts #accessary').html("");
    $('#form-parts .image-preview').attr("data-content", "").popover('hide');
    $('#form-parts .image-preview-filename').val("");
    $('#form-parts .image-preview-clear').hide();
    $('#form-parts .image-preview-input input:file').val("");
    $("#form-parts .image-preview-input-title").text("Duyệt");
    $('#form-parts #catalog_parts_id_error').html("");
    $('#form-parts #code_error').html("");

    var closebtn = $('<button/>', {
        type: "button",
        text: 'x',
        id: 'close-preview',
        style: 'font-size: initial;',
    });
    closebtn.attr("class", "close pull-right");
    $('#form-parts .image-preview').popover({
        trigger: 'manual',
        html: true,
        title: "<strong>Xem trước</strong>" + $(closebtn)[0].outerHTML,
        content: "Không có ảnh xem trước",
        placement: 'bottom'
    });

}
