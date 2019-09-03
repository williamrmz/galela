$(function(){
    $("#almacen").select2({
        ajax: {
            delay: 500,
            url: basePath+'/api?service=getLabInsumoResponsables',
            data: function (params) {
                var query = {
                    search: params.term,
                    page: params.page || 1
                }
                return query;
            },

            processResults: function (response) {
                console.log('aki');
                console.log(response);
                elements = [];
                response.data.forEach(element => {
                    elements.push({
                        id: element.idEmpleado,
                        text: element.nombres+' '+element.apellidoPaterno+' '+element.apellidoMaterno,
                        dni: element.dni,
                    })
                });
                return {
                    results: elements,
                    pagination: {
                        more: response.current_page < response.last_page,
                    },   
                };
            },
            cache: true,
        }, 
        placeholder: 'Buscar almacen',
        escapeMarkup: function (markup) { return markup; },
        minimumInputLength: 0,
        templateResult: formatRepoEmpleado,
        templateSelection: formatRepoSelectionEmpleado,
        
    });

    $("#empleado").select2({
        ajax: {
            delay: 500,
            url: basePath+'/api?service=getLabConsumoEmpleados',
            data: function (params) {
                var query = {
                    search: params.term,
                    page: params.page || 1
                }
                return query;
            },

            processResults: function (response) {
                elements = [];
                response.data.forEach(element => {
                    elements.push({
                        id: element.idEmpleado,
                        text: element.nombres+' '+element.apellidoPaterno+' '+element.apellidoMaterno,
                        dni: element.dni,
                    })
                });
                return {
                    results: elements,
                    pagination: {
                        more: response.current_page < response.last_page,
                    },   
                };
            },
            cache: true,
        }, 
        placeholder: 'Buscar empleado',
        escapeMarkup: function (markup) { return markup; },
        minimumInputLength: 0,
        templateResult: formatRepoEmpleado,
        templateSelection: formatRepoSelectionEmpleado,
        
    });

    $("#insumo").select2({
        ajax: {
            delay: 500,
            url: basePath+'/api?service=getLabConsumoInsumos',
            data: function (params) {
                var query = {
                    search: params.term,
                    page: params.page || 1
                }
                return query;
            },

            processResults: function (response) {
                elements = [];
                response.data.forEach(element => {
                    elements.push({
                        id: element.idProducto,
                        text: element.nombre,
                        codigo: element.codigo,
                        denominacion: element.denominacion,
                    })
                });
                return {
                    results: elements,
                    pagination: {
                        more: response.current_page < response.last_page,
                    },   
                };
            },
            cache: true,
        }, 
        placeholder: 'Buscar insumo',
        escapeMarkup: function (markup) { return markup; },
        minimumInputLength: 0,
        templateResult: formatRepoInsumos,
        templateSelection: formatRepoSelectionInsumos,
        
    });

    $(".btn-clear-select").click( function(e) {
        e.preventDefault();
        $(this).siblings('select').empty();
        // $("#empleado").empty();
    });

    $("#consumo-form-filtro").submit( function (e) {
        e.preventDefault();
        verTablaItems();
    });

    $(".consumos-btn-buscar").click( function (e) {
        e.preventDefault();
        verTablaItems();
    });

    $(".consumos-btn-limpiar").click( function (e) {
        e.preventDefault();
        $("#rangoFecha").val('');
        $("#almacen").empty();
        $("#insumo").empty();
        $("#empleado").empty();
        verTablaItems();
    });
    verTablaItems();
});

function getPath()
{
    return $("input[name='InsumoConsumoController']").val();
}

function verTablaItems(page=1)
{
    let url = getPath();
    let params = $("#consumo-form-filtro").serialize();

    $.ajax({
        data: params, url: url,
        type:  'GET', dataType: 'html',
        success:  function (response) {
            $(".items-tabla").html(response);

            $(".items-btn-show").click( function(e) {
                e.preventDefault();
                let id = $(this).siblings('input').val();
                showItem(id);
            });

            $(".items-btn-edit").click( function(e) {
                e.preventDefault();
                let id = $(this).siblings('input').val();
                editItem(id);
            });

            $(".items-btn-delete").click( function(e) {
                e.preventDefault();
                let id = $(this).siblings('input').val();
                deleteItem(id);
            });

            $('[data-toggle="tooltip"]').tooltip();
        }
    });
}


// SELECT 2 CONFIG 
function formatRepoEmpleado (repo) {
    if (repo.loading) {
        return repo.text;
    }
    
    var markup = "<div class='select2-result-repository clearfix'>" +
        "<div class='select2-result-repository__meta'>" +
        "<div class='select2-result-repository__title'>" + repo.text + "</div>";
    
    if (repo.description) {
        markup += "<div class='select2-result-repository__description'>" + 'hola.' + "</div>";
    }
    
    markup += "<div class='select2-result-repository__statistics'>" +
        "<div class='select2-result-repository__watchers'><b>DNI:</b> " + repo.dni + "</div>" +
    "</div>" +
    "</div></div>";
    
    return markup;
}

function formatRepoSelectionEmpleado (repo) {
    return repo.text;
}


function formatRepoInsumos (repo) {
    if (repo.loading) {
        return repo.text;
    }
    
    var markup = "<div class='select2-result-repository clearfix'>" +
        "<div class='select2-result-repository__meta'>" +
        "<div class='select2-result-repository__title'>" + repo.text + "</div>";
    
    if (repo.description) {
        markup += "<div class='select2-result-repository__description'>" + 'hola.' + "</div>";
    }
    
    markup += "<div class='select2-result-repository__statistics'>" +
        "<div class='select2-result-repository__watchers'><b>Codigo:</b> " + repo.codigo + "</div>" +
    "</div>" +
    "</div></div>";
    
    return markup;
}

function formatRepoSelectionInsumos (repo) {
    return repo.text;
}



