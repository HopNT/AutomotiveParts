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
            data: $('#form_add_update_user').serialize(),
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
                            }else if(i=="role_id" || i=="user_type"){
                                $("#form_add_update_user select[name='"+i+"']").val(v);
                            }else {
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
});
function loadDataTable() {
    $('#user_table').DataTable();
    $('#role_table').DataTable();
    $('[data-toggle="popover"]').popover();
    $('[data-toggle="tooltip"]').tooltip();
}
