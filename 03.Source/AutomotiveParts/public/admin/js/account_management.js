$( document ).ready(function() {
    loadDataTable();
    $('body').on('click','#btn_add_new_role', function () {
        $("#form_add_update_role input[name='role_id']").val('');
        $("#form_add_update_role input[name='role_name']").val('');
        $("#form_add_update_role textarea[name='description']").val('');
        $('#modal_add_update_role').modal();
    });
    $('body').on('click','#btn_add_new_user', function () {
        $("#form_add_update_role input[name='role_id']").val('');
        $("#form_add_update_role input[name='role_name']").val('');
        $("#form_add_update_role textarea[name='description']").val('');
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
                    console.log(rs.errors);
                    $.each(rs.errors, function(key, value){
                        $("input[name='"+key+"']").next().html(value);
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

});
function loadDataTable() {
    $('#user_table').DataTable();
    $('#role_table').DataTable();
    $('[data-toggle="popover"]').popover();
    $('[data-toggle="tooltip"]').tooltip();
}
