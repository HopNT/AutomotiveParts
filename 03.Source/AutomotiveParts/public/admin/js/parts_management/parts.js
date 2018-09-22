$(document).ready(function () {
    loadTableParts();

    // Open modal add new parts
    $('body').on('click', '#btn_add_new_parts', function () {
        $('#modal_add_update_parts #title-add').css('display', 'block');
        $('#modal_add_update_parts #title-update').css('display', 'none');
        $('#modal_add_update_parts').modal();
    });
});
