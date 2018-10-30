function loadTableQuotation() {
    $('#tbl_quotation').DataTable({
        // columnDefs: [
        //     {
        //         targets: [0, 2, 3, 4],
        //         orderable: false
        //     }
        // ],
        // order: [[1, 'asc']]
    });
}

$(document).ready(function () {
    loadTableQuotation();

    var counter = 0;
    $("#formQuotation #addrow").on("click", function () {
        var newRow = $("<tr>");
        var cols = "";
        cols += '<td><input type="text" class="form-control" name="code[]"/></td>';
        cols += '<td><input type="text" class="form-control" name="name_vi[]"/></td>';
        cols += '<td><input type="text" class="form-control" name="nation_id[]"/></td>';
        cols += '<td><input type="text" class="form-control" name="trademark_id[]"></td>';
        cols += '<td><input type="text" class="form-control" name="garage_price[]"/></td>';
        cols += '<td><input type="text" class="form-control" name="retail_price[]"></td>';
        newRow.append(cols);
        $("#formQuotation #tbl_temp").append(newRow);
    });
});
