var modulos = [];
var reportes = [];
var misReportes = [];
var misModulos = [];

$(function(){
    initSelects();

    $(".btn-modulo-agregar").click( function(e) {
        e.preventDefault();
        agregarModulo( $("#modulosId").val() );
    });

    $(".btn-reporte-agregar").click( function(e) {
        e.preventDefault();
        agregarReporte( $("#reportesId").val() );
    });

    $(".btn-reporte-agregar-todos").click( function(e) {
        e.preventDefault();
        misReportes = [];
        for( i in reportes){
            reportes[i].children.forEach(element => {
                reporte = JSON.parse( JSON.stringify( element ) );
                reporte.tieneAcceso = true;
                misReportes.push(reporte);
            });
        }
        showMisReportes();
    });

    $(".btn-reporte-agregar-ninguno").click( function(e) {
        e.preventDefault();
        misReportes = [];
        showMisReportes();
    });
    
});

function getPath()
{
    return $("input[name='path-ctrl']").val();
}

function initSelects()
{
    let url = getPath();
    $.ajax({
        data: {}, url: url+'/create',
        type:  'GET', dataType: 'json',
        success:  function (response) {
            console.log(response);
            // setSelectModulos(response.modulos);
            // setSelectReportes(response.reportes);
        }
    })
}

// MODULOS
function resetCkbModulos(){
    $("#item-check-agregar").prop('checked', false);
    $("#item-check-modificar").prop('checked', false);
    $("#item-check-consultar").prop('checked', false);
    $("#item-check-eliminar").prop('checked', false);
}

function setSelectModulos(modulosData)
{
    this.modulos = modulosData;
    var data = $.map(modulos, function (obj) {
        obj.id = obj.IdListItem,
        obj.text = obj.Modulo + ' | ' + obj.SubModulo;
        return obj;
    });

    // console.log(data);

    $("#modulosId").select2({
        placeholder: 'Seleccione un modulo',
        data: data,
        escapeMarkup: function (markup) { return markup; },
        templateResult: formatRepoModulos,
    });

    $("#modulosId").change( function (e) {
        resetCkbModulos();
    });
}

function showMisMmodulos()
{
    let html = '';
    misModulos.forEach( function(element) {

        html += '<tr>';
            html += '<td>'+element.SubModulo+'</td>';
            html += '<td>'+element.Modulo+'</td>';
            html += '<td align="center"> <input type="checkbox" name="modulos['+element.IdListItem+'][agregar]" '+(element.agregar? 'Checked': '')+'> </td>';
            html += '<td align="center"> <input type="checkbox" name="modulos['+element.IdListItem+'][modificar]" '+(element.modificar? 'Checked': '')+'> </td>';
            html += '<td align="center"> <input type="checkbox" name="modulos['+element.IdListItem+'][consultar]" '+(element.consultar? 'Checked': '')+'> </td>';
            html += '<td align="center"> <input type="checkbox" name="modulos['+element.IdListItem+'][eliminar]" '+(element.eliminar? 'Checked': '')+'> </td>';
            html += '<td align="center"><input type="hidden" value="'+element.IdListItem+'">'+
                '<a href="#" class="btn btn-xs btn-default btn-modulo-quitar"> <i class="text-red fa fa-close"></i></a> </td>';
        html += '</tr>';
        console.log(element);
    });

    $(".tbody-modulos").html(html);

    $(".btn-modulo-quitar").click( function(e) {
        e.preventDefault();
        let id = $(this).siblings('input').val();
        quitarModulo ( id );
    });

    
}

function agregarModulo(id)
{
    // Verifica si modulo ya esta agregado
    let moduloExiste = misModulos.find( function (element) {
        return element.IdListItem == id;
    });

    if ( moduloExiste) { toastr.error('El modulo ya a sido agregado'); return; }
    
    //verifica si se a seleccionado una opcion
    if(id === null) { toastr.error('Seleccione un modulo'); return; }

    // Obtener datos del modulo seleccionado
    let modulo = modulos.find( function (element) {
        if(element.IdListItem == id) return element;
    });
    
    modulo.agregar = $("#item-check-agregar").is(':checked');
    modulo.modificar = $("#item-check-modificar").is(':checked');
    modulo.consultar = $("#item-check-consultar").is(':checked');
    modulo.eliminar = $("#item-check-eliminar").is(':checked');


    misModulos.push(modulo);

    resetCkbModulos();
    showMisMmodulos();
}

function quitarModulo(id)
{
    let deleted = false;

    for ( i in misModulos) {
        if( misModulos[i].IdListItem == id){
            misModulos.splice(i, 1);
            deleted = true;
            break;
        }
    }
            
    if( deleted ) {
        toastr.info('Modulo eliminado', 'Info');
        showMisMmodulos();
    }else{
        toastr.error('Ocurrio un error al intentar eliminar el modulo', 'Error');
    }

}

function formatRepoModulos (repo) {
    if (repo.loading) {
        return repo.text;
    }
    
    var markup = "<div class='select2-result-repository clearfix'>" +
        "<div class='select2-result-repository__meta'>"
            + "<div class='select2-result-repository__title'>" + repo.Modulo + "</div>" + 
        "</div>";
    
    return markup;
}
// --END MODULOS

// REPORTES
function resetCkbReportes()
{
    $("#reportes-check-todos").prop('checked', false);
    $("#reportes-check-ninguno").prop('checked', false);
}

function setSelectReportes(dataDB)
{
    this.reportes = dataDB;

    console.log(reportes);
    var data = $.map(dataDB, function (obj) {
        obj.text = obj.text;
        obj.children = obj.children;
        return obj;
    });

    $("#reportesId").select2({
        placeholder: 'Seleccione un Reporte',
        data: data,
        escapeMarkup: function (markup) { return markup; },
        templateResult: formatRepoReportes,
        templateSelection: formatRepoSelectionReportes,
    });

    $("#reportesId").change( function (e) {
        resetCkbReportes();
    });
}

function showMisReportes()
{
    let html = '';
    misReportes.forEach( function(element) {

        html += '<tr>';
            html += '<td>'+element.Reporte+'</td>';
            html += '<td>'+element.Modulo+'</td>';
            html += '<td align="center"> <input type="checkbox" name="reporte['+element.idReporte+'][tieneAcceso]" '+(element.tieneAcceso? 'Checked': '')+'> </td>';
            html += '<td align="center"><input type="hidden" value="'+element.idReporte+'">'+
                '<a href="#" class="btn btn-xs btn-default btn-reporte-quitar"> <i class="text-red fa fa-close"></i></a> </td>';
        html += '</tr>';
        console.log(element);
    });

    $(".tbody-reportes").html(html);

    $(".btn-reporte-quitar").click( function(e) {
        e.preventDefault();
        let id = $(this).siblings('input').val();
        quitarReporte ( id );
    });
}

function agregarReporte(id)
{
    // Verifica si el reporte ya esta agregado
    let moduloExiste = misReportes.find( function (element) {
        return element.idReporte == id;
    });

    if ( moduloExiste) { toastr.error('El reporte ya a sido agregado'); return; }
    
    //verifica si se a seleccionado una opcion
    if(id === null) { toastr.error('Seleccione un reporte'); return; }

    console.log(reportes);
    let reporte = null;
    // Obtener datos del reporte seleccionado
    for ( i in reportes){
        reportes[i].children.forEach(element => {
            if(element.idReporte == id){
                reporte = JSON.parse( JSON.stringify( element ) );
            }
        });
    }

    if( reporte == null) {
        toastr.error('Ocurrio un error al intentar agregar el permiso a la lista'); 
        return;
    }

    
    reporte.tieneAcceso = true;

    misReportes.unshift(reporte);

    resetCkbReportes();
    showMisReportes();
}

function quitarReporte(id)
{
    let deleted = false;

    for ( i in misReportes) {
        if( misReportes[i].idReporte == id){
            misReportes.splice(i, 1);
            deleted = true;
            break;
        }
    }
            
    if( deleted ) {
        toastr.info('Modulo eliminado', 'Info');
        showMisReportes();
    }else{
        toastr.error('Ocurrio un error al intentar eliminar el modulo', 'Error');
    }
}

function formatRepoReportes (repo) {
    if (repo.loading) {
        return repo.text;
    }

    var title = repo.Reporte;
    if ( typeof title === 'undefined'){
        title = repo.text;
    }
    
    var markup = "<div class='select2-result-repository clearfix'>" +
        "<div class='select2-result-repository__meta'>"
            + "<div class='select2-result-repository__title'>" + title + "</div>" + 
        "</div>";
    
    return markup;
}

function formatRepoSelectionReportes (repo) {
    var title = repo.Reporte;
    if ( typeof title === 'undefined'){
        title = repo.text;
    }
    return title;
}
//-- END REPORTES



