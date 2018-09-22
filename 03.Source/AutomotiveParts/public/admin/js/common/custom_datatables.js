(function ($, DataTable) {

    // Datatable global configuration
    $.extend(true, DataTable.defaults, {
        language: {
            url: "/admin/lang/datatables/datatables"
        }
    });

})(jQuery, jQuery.fn.dataTable);
