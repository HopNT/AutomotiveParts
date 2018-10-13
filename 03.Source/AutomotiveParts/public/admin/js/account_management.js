$( document ).ready(function() {
    loadDataTable();
    $('body').on('click','#btn_add_new_role', function () {
        $("#form_add_update_role input[name='role_id']").val('');
        $("#form_add_update_role input[name='role_name']").val('');
        $("#form_add_update_role textarea[name='description']").val('');
        $('#modal_add_update_role').modal();
    });
    $('body').on('click','#btn_add_new_user', function () {
        $("#form_add_update_user input[type='text']").val('');
        $("#form_add_update_user input[type='email']").val('');
        $("#form_add_update_user textarea[name='address']").val('');
        $("#form_add_update_user select[name='role_id']").val('');
        $("#form_add_update_user select[name='user_type']").val('');
        // resetPhoto('modal_add_update_user','avatar');
        // onloadPhoto('modal_add_update_user','avatar');
        $('#modal_add_update_user').modal();

    });
    $('body').on('click','#btn_save_role', function () {
        var url = $('#form_add_update_role').attr('action');
        $.ajax({
            type:'POST',
            url:url,
            data: $('#form_add_update_role').serialize(),
            success:function(rs){
                if(rs.error){
                    $.each(rs.errors, function(key, value){
                        $("input[name='"+key+"']").parent().find('.text-danger').html(value);
                    });
                }else{
                    $('#modal_add_update_role').modal('hide');
                    setTimeout(function(){
                        showMessage(rs.message,'success');
                        $('#role').html(rs.html);
                        loadDataTable();
                    }, 200);
                }

            }
        });
    });

    $('body').on('click','#btn_update_role', function () {
        var url = $(this).attr('href');
        $.ajax({
            type:'GET',
            url:url,
            dataType:'JSON',
            success:function(rs){
                if(!rs.error){
                    var role = rs.data;
                    if(role){
                        $("#form_add_update_role input[name='role_id']").val(role['id']);
                        $("#form_add_update_role input[name='role_name']").val(role['role_name']);
                        $("#form_add_update_role textarea[name='description']").val(role['description']);
                        $('#modal_add_update_role').modal();
                    }
                }else{
                    showMessage(rs.message,'danger');
                }

            }
        });
    });

    $('body').on('click','#btn_delete_role', function () {
        var url = $(this).attr('href');
        swal({
            title: $('#btn_delete_role').data('confirm'),
            text: "",
            type: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes",
            cancelButtonText: "No",
            closeOnConfirm: true,
            closeOnCancel: true
        }, function(isConfirm) {
            if (isConfirm) {
                $.ajax({
                    url:url,
                    type:'GET',
                    success:function(rs){
                        if(rs.error){
                            showMessage(rs.message,'danger');
                        }else{
                            setTimeout(function(){
                                $('#role').html(rs.html);
                                loadDataTable();
                                showMessage(rs.message,'success');
                            }, 200);
                        }

                    }
                });
            }
        });
    });

    $('body').on('click','#btn_save_user', function () {
        var url = $('#form_add_update_user').attr('action');
        $.ajax({
            type:'POST',
            url:url,
            data: new FormData($('#form_add_update_user')[0]),
            contentType: false,
            processData: false,
            success:function(rs){
                if(rs.error){
                    $.each(rs.errors, function(key, value){
                        if(key == "gender"){
                            $("input[name='"+key+"']").parent().parent().find('.text-danger').html(value);
                        }else if(key == "role_id"){
                            $("select[name='"+key+"']").parent().find('.text-danger').html(value);
                        } else {
                            $("input[name='"+key+"']").parent().find('.text-danger').html(value);
                        }

                    });
                }else{
                    $('#modal_add_update_user').modal('hide');
                    setTimeout(function(){
                        showMessage(rs.message,'success');
                        $('#user').html(rs.html);
                        loadDataTable();
                    }, 200);
                }

            }
        });
    });

    $('body').on('click','#btn_get_user', function () {
        var url = $(this).attr('href');
        $.ajax({
            type:'GET',
            url:url,
            dataType:'JSON',
            success:function(rs){
                if(!rs.error){
                    var user = rs.data_user;
                    if(user){
                        $.each(user, function(i, v){
                            if(i=="gender"){
                                $("#form_add_update_user input[name='gender'][id='gender_"+v+"']").prop('checked', true);
                            }else if(i=="address"){
                                $("#form_add_update_user textarea[name='"+i+"']").val(v);
                            }else if(i=="role_id" || i=="user_type") {
                                $("#form_add_update_user select[name='" + i + "']").val(v);
                            } else {
                                $("#form_add_update_user input[name='"+i+"']").val(v);
                            }

                        });
                        $('#dob').datepicker({
                            format: "yyyy-mm-dd",
                            autoclose: true,
                            todayHighlight: true
                        });
                        $(".text-danger").html('');
                        $('#modal_add_update_user').modal();
                    }
                }else{
                    showMessage(rs.message,'danger');
                }

            }
        });
    });

    $('body').on('click','#btn_delete_user', function () {
        var url = $(this).attr('href');
        swal({
            title: $('#btn_delete_user').data('confirm'),
            text: "",
            type: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes",
            cancelButtonText: "No",
            closeOnConfirm: true,
            closeOnCancel: true
        }, function(isConfirm) {
            if (isConfirm) {
                $.ajax({
                    url:url,
                    type:'GET',
                    success:function(rs){
                        if(rs.error){
                            showMessage(rs.message,'danger');
                        }else{
                            setTimeout(function(){
                                $('#user').html(rs.html);
                                loadDataTable();
                                showMessage(rs.message,'success');
                            }, 200);
                        }

                    }
                });
            }
        });
    });

    $('body').on('click','#btn_change_pass', function () {
        $('#modal_change_pass').modal();
    });

    $('body').on('click','#btn_change_password', function () {
        var url = $('#form_change_password').attr('action');
        $.ajax({
            type:'POST',
            url:url,
            data: $('#form_change_password').serialize(),
            success:function(rs){
                if(rs.error){
                    $.each(rs.errors, function(key, value){
                        if(key == "gender"){
                            $("input[name='"+key+"']").parent().parent().find('.text-danger').html(value);
                        }else if(key == "role_id"){
                            $("select[name='"+key+"']").parent().find('.text-danger').html(value);
                        } else {
                            $("input[name='"+key+"']").parent().find('.text-danger').html(value);
                        }

                    });
                }else{
                    $('#modal_change_pass').modal('hide');
                    setTimeout(function(){
                        showMessage(rs.message,'success');
                        $('#user').html(rs.html);
                        loadDataTable();
                    }, 200);
                }

            }
        });
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
    $("#avatar").change(function() {
        readURL(this);
    });
});
function loadDataTable() {
    $('#user_table').DataTable();
    $('#role_table').DataTable();
    $('[data-toggle="popover"]').popover();
    $('[data-toggle="tooltip"]').tooltip();
}
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#imagePreview').css('background-image', 'url('+e.target.result +')');
            $('#imagePreview').hide();
            $('#imagePreview').fadeIn(650);
        }
        reader.readAsDataURL(input.files[0]);
    }
}
