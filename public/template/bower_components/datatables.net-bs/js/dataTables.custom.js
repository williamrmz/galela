function customDataTable(table, unorderable, unsearchable)
{
    table.DataTable({
        "order": [[ 0, "desc" ]],

        "columnDefs": [
            { 
                "orderable": false,
                "targets": unorderable, 
            },
            { 
                "searchable": false,
                "targets": unsearchable, 
            },
        ],
        "language": {
            "search": "Buscar:",
            "lengthMenu": "Mostrar _MENU_ registros por pagina",
            "zeroRecords": "Sin resultados",
            "info": "Mostrando pagina _PAGE_ de _PAGES_",
            "infoEmpty": "No hay registros disponibles",
            "infoFiltered": "(filtrado de _MAX_ registros totales)",
            "paginate": {
                "first":      "Primero",
                "last":       "Ultimo",
                "next":       "Siguiente",
                "previous":   "Anterior"
            },
        }
    });
}