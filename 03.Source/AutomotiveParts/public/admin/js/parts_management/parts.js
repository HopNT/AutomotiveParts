$(document).ready(function () {

    loadTableParts();

    // Open modal add new parts
    $('body').on('click', '#btn_add_new_parts', function () {

        resetPartsForm();

        let accessary = $('#form-parts #accessary');
        accessary.select2({
            ajax: {
                url: '/admin/accessary/searchByText',
                dataType: 'json',
                data: function (params) {
                    let query = {
                        query: params.term
                    }
                    return query;
                },
                processResults: function (data) {
                    return {
                        results: data.items
                    };
                },
                cache: false
            },
            placeholder: 'Nhập mã phụ tùng/tên phụ tùng...',
            allowClear: true,
            multiple: true
        });
        loadCatalogParts('form-parts', 'select-catalog-parts', 'catalog_parts_id', 'catalog_parts_id');

        $('#modal_add_update_parts #title-add').css('display', 'block');
        $('#modal_add_update_parts #title-update').css('display', 'none');
        $('#modal_add_update_parts').modal();
    });

    // Open modal update parts
    $('body').on('click', '#btn_update_parts', function () {

        resetPartsForm();

        $('#form-parts #accessary').select2({
            ajax: {
                url: '/admin/accessary/searchByText',
                dataType: 'json',
                data: function (params) {
                    let query = {
                        query: params.term
                    }
                    return query;
                },
                processResults: function (data) {
                    return {
                        results: data.items
                    };
                },
                cache: false
            },
            placeholder: 'Nhập mã phụ tùng/tên phụ tùng...',
            allowClear: true,
            multiple: true
        });

        loadCatalogParts('form-parts', 'select-catalog-parts', 'catalog_parts_id', 'catalog_parts_id');
        $('#modal_add_update_parts #title-add').css('display', 'none');
        $('#modal_add_update_parts #title-update').css('display', 'block');
        $('#modal_add_update_parts').modal();
        let url = $(this).attr('href');
        $.ajax({
            type: 'GET',
            url: url,
            success: function (result) {
                $("#form-parts input[name='parts_id']").val(result.data.parts_id);
                $("#form-parts select[name='catalog_parts_id']").val(result.data.catalog_parts_id);
                $("#form-parts input[name='code']").val(result.data.code);
                $("#form-parts input[name='name']").val(result.data.name);
                $("#form-parts input[name='width']").val(result.data.width);
                $("#form-parts input[name='height']").val(result.data.height);
                $("#form-parts input[name='number_of_tooth']").val(result.data.number_of_tooth);
                $("#form-parts input[name='inner_diameter']").val(result.data.inner_diameter);
                $("#form-parts input[name='outer_diameter']").val(result.data.outer_diameter);
                $("#form-parts input[name='torque']").val(result.data.torque);
                $("#form-parts input[name='life_cycle']").val(result.data.life_cycle);
                $("#form-parts input[name='weight']").val(result.data.weight);
                $("#form-parts input[name='liquor']").val(result.data.liquor);
                $("#form-parts textarea[name='description']").val(result.data.description);

                if (result.data.accessarys != undefined && result.data.accessarys.length > 0) {
                    $.each(result.data.accessarys, function (index, item) {
                        let option = "<option value='" + item.accessary_id + "' selected='selected'>" + (item.code + " - " + item.name_vi) + "</option>";
                        $('#form-parts #accessary').append(option);
                    });
                    $('#form-parts #accessary').trigger('change');
                }

                if (result.data.photo != undefined && result.data.photo != null && result.data.photo != '') {
                    var img = $('<img/>', {
                        id: 'dynamic',
                        width: 250,
                        height: 200
                    });
                    $("#form-parts .image-preview-input-title").text("Thay đổi");
                    $("#form-parts .image-preview-clear").show();
                    $("#form-parts .image-preview-filename").val(result.data.photo_name);
                    img.attr('src', result.data.photo);
                    $("#form-parts .image-preview").attr("data-content", $(img)[0].outerHTML).popover("show");
                }
            }
        });
    });

    // Save or update parts
    $('body').on('click', '#btn_save_parts', function () {
        $('#catalog_parts_id_error').html("");
        $('#code_error').html("");
        let type = $('#form-parts').attr('method');
        let url = $('#form-parts').attr('action');
        let partsId = $('#form-parts input[name="parts_id"]').val();
        $.ajax({
            type: type,
            url: url,
            data: new FormData($('#form-parts')[0]),
            contentType: false,
            processData: false,
            success: function (result) {
                if (result.error) {
                    $.each(result.errors, function (key, value) {
                        $("#form-parts #" + key + "_error").html(value);
                    });
                } else if (result.system_error) {
                    $('#modal_add_update_parts #message_error').html(result.message_error);
                    $('#modal_add_update_parts #alert_error').slideDown();
                    $("#modal_add_update_parts #alert_error").fadeTo(2000, 500).slideUp(500, function () {
                        $("#modal_add_update_parts #alert_error").slideUp(500);
                        $('#modal_add_update_parts #message_error').html('');
                    });
                } else if (!result.error) {
                    $('#modal_add_update_parts').modal('hide');
                    setTimeout(function () {
                        if (partsId != null && partsId != '') {
                            showMessage('Cập nhật thành công', 'success');
                        } else {
                            showMessage('Thêm mới thành công', 'success');
                        }
                        $('#parts').html(result.html);
                        loadTableParts();
                    }, 1000);
                }
            },
            error: function (error) {
                $('#modal_add_update_parts #message_error').html('Có lỗi xảy, vui lòng liên hệ với quản trị hệ thống! ' + error.responseJSON.message);
                $('#modal_add_update_parts #alert_error').slideDown();
                $("#modal_add_update_parts #alert_error").fadeTo(2000, 500).slideUp(500, function () {
                    $("#modal_add_update_parts #alert_error").slideUp(500);
                    $('#modal_add_update_parts #message_error').html('');
                });
            }
        });

    });

    // Preview image
    $('body').on('click', '#close-preview', function () {
        $('#form-parts .image-preview').popover('hide');
        $('#form-parts .image-preview').hover(
            function () {
                $('#form-parts .image-preview').popover('show');
            },
            function () {
                $('#form-parts .image-preview').popover('hide');
            }
        )
    });

    $('body').on('click', '#form-parts .image-preview-clear', function () {
        $('#form-parts .image-preview').attr("data-content", "").popover('hide');
        $('#form-parts .image-preview-filename').val("");
        $('#form-parts .image-preview-clear').hide();
        $('#form-parts .image-preview-input input:file').val("");
        $("#form-parts .image-preview-input-title").text("Duyệt");
    });

    $('body').on('change', "#form-parts .image-preview-input input:file", function () {
        var img = $('<img/>', {
            id: 'dynamic',
            width: 250,
            height: 200
        });
        var file = this.files[0];
        var reader = new FileReader();
        // Set preview image into the popover data-content
        reader.onload = function (e) {
            $("#form-parts .image-preview-input-title").text("Thay đổi");
            $("#form-parts .image-preview-clear").show();
            $("#form-parts .image-preview-filename").val(file.name);
            img.attr('src', e.target.result);
            $("#form-parts .image-preview").attr("data-content", $(img)[0].outerHTML).popover("show");
        }
        reader.readAsDataURL(file);
    });

});
