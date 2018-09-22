function loadTableCatalogParts() {
    $('#tbl_catalog_parts').DataTable({
        columnDefs: [
            {
                targets: [0, 1, 2, 3],
                orderable: false
            }
        ],
    });
}

function loadTableParts() {
    $('#tbl_parts').DataTable({
        columnDefs: [
            {
                targets: [0, 1, 3, 4, 5],
                orderable: false
            }
        ],
        order: [[2, 'asc']]
    });
}
