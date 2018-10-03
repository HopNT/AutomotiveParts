function loadTableTempPrice() {
    $('#tbl_temp_price').DataTable();
}

$(document).ready(function () {
    loadTableTempPrice();

    // Open modal add new temp price
    $('body').on('click', '#btn_add_new_temp_price', function () {
        $('#form-temp-price .imageupload').imageupload();
        loadTrademark('form-temp-price', 'select-trademark', 'trademark_id', 'trademark_id');
        loadNation('form-temp-price', 'select-nation', 'nation_id', 'nation_id');
        $('#modal_add_update_temp_price #title-add').css('display', 'block');
        $('#modal_add_update_temp_price #title-update').css('display', 'none');
        $('#modal_add_update_temp_price').modal();
    });

    // Open modal approve temp price
    $('body').on('click', '#btn_approve_temp_price', function () {
        $('#modal_add_update_temp_price #title-add').css('display', 'block');
        $('#modal_add_update_temp_price #title-update').css('display', 'none');
        $('#modal_add_update_temp_price').modal();
    });

    onloadPhoto('form-temp-price', 'photo_top');
    onloadPhoto('form-temp-price', 'photo_bottom');
    onloadPhoto('form-temp-price', 'photo_left');
    onloadPhoto('form-temp-price', 'photo_right');
    onloadPhoto('form-temp-price', 'photo_inner');
    onloadPhoto('form-temp-price', 'photo_outer');

});

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
