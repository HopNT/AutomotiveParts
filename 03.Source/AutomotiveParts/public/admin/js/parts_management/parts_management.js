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
    $('#form-catalog-parts #status').css('display', 'none');
    $('#form-catalog-parts select[name="status"]').val("");
    $("#form-catalog-parts select[name='parent_id']").empty();
    resetPhoto('form-catalog-parts', 'photo');
}

function resetPartsForm() {
    $('#form-parts #status').css('display', 'none');
    $('#form-parts select[name="status"]').val("");
    $('#form-parts input[name="code"]').prop('disabled', false);
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

function onloadPhoto(form, inputName) {
    var closebtn = $('<button/>', {
        type: "button",
        text: 'x',
        id: 'close_' + inputName + '_preview',
        style: 'font-size: initial;',
    });
    closebtn.attr("class", "close pull-right");
    $('#' + form + ' #' + inputName + '_image_preview').popover({
        trigger: 'manual',
        html: true,
        title: "<strong>Xem trước</strong>" + $(closebtn)[0].outerHTML,
        content: "Không có ảnh xem trước",
        placement: 'bottom'
    });

    $('body').on('click', '#close_' + inputName + '_preview', function () {
        $('#' + form + ' #' + inputName + '_image_preview').popover('hide');
        $('#' + form + ' #' + inputName + '_image_preview').hover(
            function () {
                $('#' + form + ' #' + inputName + '_image_preview').popover('show');
            },
            function () {
                $('#' + form + ' #' + inputName + '_image_preview').popover('hide');
            }
        )
    });

    $('body').on('click', '#' + form + ' #' + inputName + '_image_preview_clear', function () {
        $('#' + form + ' #' + inputName + '_image_preview').attr("data-content", "").popover('hide');
        $('#' + form + ' #' + inputName + '_image_preview_filename').val("");
        $('#' + form + ' #' + inputName + '_image_preview_clear').hide();
        $('#' + form + ' .image-preview-input input[name="' + inputName + '"]').val("");
        $("#" + form + " #" + inputName + "_image_preview_input_title").text("Duyệt");
    });

    $('body').on('change', '#' + form + ' .image-preview-input input[name="' + inputName + '"]', function () {
        var img = $('<img/>', {
            id: inputName,
            width: 250,
            height: 200
        });
        var file = this.files[0];
        var reader = new FileReader();
        // Set preview image into the popover data-content
        reader.onload = function (e) {
            $("#" + form + " #" + inputName + "_image_preview_input_title").text("Thay đổi");
            $("#" + form + " #" + inputName + "_image_preview_clear").show();
            $("#" + form + " #" + inputName + "_image_preview_filename").val(file.name);
            img.attr('src', e.target.result);
            $("#" + form + " #" + inputName + "_image_preview").attr("data-content", $(img)[0].outerHTML).popover("show");
        }
        reader.readAsDataURL(file);
    });
}

function resetPhoto(form, inputName) {
    $('#' + form + ' #' + inputName + '_image_preview').attr("data-content", "").popover('hide');
    $('#' + form + ' #' + inputName + '_image_preview_filename').val("");
    $('#' + form + ' #' + inputName + '_image_preview_clear').hide();
    $('#' + form + ' .image-preview-input input[name="' + inputName + '"]').val("");
    $("#" + form + " #" + inputName + "_image_preview_input_title").text("Duyệt");
    var closebtn = $('<button/>', {
        type: "button",
        text: 'x',
        id: 'close_' + inputName + '_preview',
        style: 'font-size: initial;',
    });
    closebtn.attr("class", "close pull-right");
    $('#' + form + ' #' + inputName + '_image_preview').popover({
        trigger: 'manual',
        html: true,
        title: "<strong>Xem trước</strong>" + $(closebtn)[0].outerHTML,
        content: "Không có ảnh xem trước",
        placement: 'bottom'
    });
}
