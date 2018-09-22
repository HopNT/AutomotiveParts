$(document).ready(function () {
    $('#btn_save').on('click', function () {
        return validateToSend();
    });

    //check/uncheck role

    $("#simple-table").find(":checkbox.cb").change(function () {
        //check or uncheck childs
        checkOrUncheckChild(this);
        //check or uncheck parent
        checkOrUncheckParent(this);
        //auto check or uncheck all
        var checked = $(this).prop('checked');
        //undeck all
        if (!checked) {
            $("#simple-table").find(":checkbox.cb_all").prop('checked', checked);
        } else {
            //check all
            var arrCb = $("#simple-table").find(":checkbox.cb");
            var hasUnChecked = false;
            for (var i = 0; i < arrCb.length; i++) {
                hasUnChecked = $(arrCb[i]).prop('checked');
                if (!hasUnChecked) {
                    return;
                }

            }
            if (hasUnChecked) {
                $("#simple-table").find(":checkbox.cb_all").prop('checked', true);
            }
        }

    });
    $("#simple-table").find(":checkbox.cb_all").change(function () {
        var checked = $(this).prop('checked');
        $(':checkbox.cb').prop('checked', checked);

    });
});
function checkOrUncheckChild(node) {
    var checked = $(node).prop('checked');
    //check or uncheck childs
    var childs = $(node).data('childs');
    if (childs !== "" && childs != undefined) {
        var arr_child = childs.toString().split(",");
        for (var i = 0; i < arr_child.length; i++) {
            var cbObj = $("[name='mn_selected_list[" + arr_child[i] + "]']");
            $(cbObj).prop('checked', checked);
            checkOrUncheckChild(cbObj);
        }

    }

}
function checkOrUncheckParent(node) {
    var checked = $(node).prop('checked');
    //check or uncheck parent
    var parent = $(node).data('parent');
    if (parent != "") {
        var cbParrent = $("[name='mn_selected_list[" + parent + "]']");
        //checked parrent
        if (checked) {
            $(cbParrent).prop('checked', checked);
            checkOrUncheckParent(cbParrent);
            return;
        }
        //uncheck parrent
        var arrSameLevel = $("[data-parent='" + parent + "']");
        var hasChecked = false;
        for (var i = 0; i < arrSameLevel.length; i++) {
            hasChecked = $(arrSameLevel[i]).prop('checked');
            if (hasChecked) {
                return;
            }

        }
        if (!hasChecked) {
            $(cbParrent).prop('checked', checked);
            checkOrUncheckParent(cbParrent);
        }
    }
}


function checkParent(parentid) {
    var parent = $("[name='mn_selected_list[" + parentid + "]']");
    if (parent) {
        parent.prop('checked', true);
        //$('.parent_'+parentid).not(':checked').prop('checked', true);
        parentid = $(parent).data('parentid');
        if (parseInt(parentid) > 0) {
            return checkParent(parentid);
        }
    }
}


function validateToSend() {
    $('#frmRole').find('.text-danger').html('');
    $('#frmRole').find('.has-error').removeClass('has-error');
    save('frmRole', 'form-group');
}

function save(from_id, class_element) {

    var form_object = $('#' + from_id);
    var url = form_object.attr('action');
    if (url) {
        form_object.find('.text-danger').html('');
        $.ajax({
            url: url,
            type: 'post',
            data: form_object.serialize(),
            checkform: false,
            success: function (rs) {
                if (rs.error) {
                    if (!rs.errors) {
                        var message = rs.message ? rs.message : '';
                        showMessage(message, 'error');
                        return;
                    }
                    $.each(rs.errors, function (i, val) {
                        var object = $('#' + i);
                        var parent_object = object.closest('.' + class_element);
                        parent_object.addClass('has-error');
                        if (parent_object.find('.text-danger').length) {
                            parent_object.find('.text-danger').html(val[0]);
                        } else {
                            //var error = '<p class="text-danger margin-top-10">'+val[0]+'</p>';
                            //parent_object.append.html(error);

                        }
                    });
                } else {
                    showMessage(rs.message, 'success');

                    if (rs.url) {
                        setTimeout(function () {
                            window.location.href = rs.url;
                        },100);
                    }
                    //setTimeout(function(){ history.back(); }, 1000);
                }
            }
        });
    }
    return false;
}

/**
 * show confirm delete before submit
 * @param {type} ctrAct
 * @param {type} frmId
 * @returns {undefined}     */
function showConfirm(ctrAct, frmId) {
    $msg = $(ctrAct).data('confirm');
    confirmModal({
        'classPopup': 'confirm-mark-highlight',
        'confirmHtml': 'Yes',
        'closeHtml': 'No',
        'title': 'CONFIRMATION',
        'message': $msg,
        confirm: function () {
            save(frmId);
        }
    });
}

