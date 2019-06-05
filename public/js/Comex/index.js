$(document).ready(function() {
    $('#tabelaEmail').DataTable({
        scrollY: "350px",
        scrollCollapse: true,
        paging: true,
        lengthChange: true,
        pageLength: 10,
        bSort: true,
        order: [0, "asc"],
        bAutoWidth: true,
        responsive: true,
    });
} );