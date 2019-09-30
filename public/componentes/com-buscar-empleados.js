$.fn.comBuscarEmpleado = function( options )
{
    var opts = $.extend({}, $.fn.comBuscarEmpleado.defaults, options);

    var tbody = '';

    console.log(opts.id);

    options.data.forEach(element => {
        tbody +=
        '<tr>' +
            '<td>'+element.dni+'</td>' +
            '<td>'+element.name+'</td>' +
            '<td>' +
                '<input type="hidden" class="row-data" value=\''+JSON.stringify(element)+'\'>' +
                '<a href="#" class="btn btn-secondary btn-sm '+opts.id+'-btn-select"> <i class="fa fa-plus"></i>+</a>' +
            '</td>' +
        '</tr>';
    });

    var template = $(
    '<div class="card ">'+
        '<div class="card-header">' +
            opts.title +
        '</div>' +
        '<div class="card-body">' +
            '<div class="row">' +
                '<div class="col-sm-12">' +
                    '<form action="#" class="row">' +
                        '<div class="col-sm-3 form-group">' +
                            '<input type="text" class="form-control form-control-sm '+opts.id+'-input-dni">' +
                        '</div>' +
                        '<div class="col-sm-7 form-group">' +
                            '<input type="text" class="form-control form-control-sm '+opts.id+'-input-nombres">' +
                        '</div>' +
                        '<div class="col-sm-2 form-group">' +
                            '<a href="#" class="btn btn-success '+opts.id+'-btn-search btn-sm">Search</a>' +
                            '<a href="#" class="btn btn-secondary '+opts.id+'-btn-clear btn-sm">Clear</a>' +
                        '</div>' +
                    '</form>' +
                '</div>' +
        
                '<div class="col-sm-12">' +
                    '<table class="table table-sm table-hover">' +
                        '<thead>' +
                            '<tr style="">' +
                                '<td>DNI</td>' +
                                '<td>Nombres y apellidos</td>' +
                               ' <td width="30"></td>' +
                            '</tr>' +
                        '</thead>' +
                        '<tbody class="'+opts.id+'-tbody">' +
                            tbody +
                        '</tbody>' +
                    '</table>' +
                '</div>' +
            '</div>' +
        '</div>' +
    '</div>');
    $(this).html(template);


    var clearFilter = function(){
        $('.'+opts.id+'-input-dni').val('');
        $('.'+opts.id+'-input-nombres').val('');
    };

    $('.'+opts.id+'-btn-select').click( function(e) {
        e.preventDefault();
        item = JSON.parse( $(this).siblings('input.row-data').val() );
        console.log(item);
    });

    $('.'+opts.id+'-btn-search').click( function(e) {
        e.preventDefault();

        $.ajax({
            data: {}, url: opts.basePath+'/api?service=getLabEmpleados',
            type:  'GET', dataType: 'html',
            success:  function (data) {
                data
            }
        });
        $('.'+opts.id+'-tbody').html('seraching...');
    });

    $('.'+opts.id+'-btn-clear').click( function(e) {
        e.preventDefault();
        clearFilter();
    });





}


$.fn.comBuscarEmpleado.defaults = {
    id: 'com-buscar-empleado',
    title: 'Formulario de busqueda',
    data: [],
    basePath: 'localhost:8000',
};


// $.fn.ClickRow = function()
// {
//     this.alert('se ha seleccionado la fila');
// }

// $.fn.ClickSearch = function()
// {
//     this.alert('se ha seleccionado la fila');
// }