$(document).ready(function () {

    $('body').on('click','#btn_run', function () {
        debugger;
        var url = $('#frmRunSQL').attr('action');
        $.ajax({
            type:'POST',
            url:url,
            data: $('#frmRunSQL').serialize(),
            success:function(rs){
                if(rs.error){
                    $.each(rs.errors, function(key, value){
                        $("input[name='"+key+"']").parent().find('.text-danger').html(value);
                    });
                }else{
                    $('#frmRunSQL').modal('hide');
                    setTimeout(function(){
                        showMessage(rs.message,'success');
                        $('#role').html(rs.html);
                    }, 200);
                }

            }
        });
    });
});
