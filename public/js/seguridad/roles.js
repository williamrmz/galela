var model="roles";

var itemsData = [];
var permisosData = [];
var reportesData = [];

var misItems = [];
var misPermisos = [];
var misReportes = [];

$(function(){
    showListItems();

    $('#'+model+'-form-search').submit( function(e) {
        e.preventDefault();
        showListItems();
    });

    $('#'+model+'-btn-clear').click( function(e) {
        e.preventDefault();
        $('#'+model+'-form-search').trigger("reset");
        showListItems();
    });

    $('#'+model+'-btn-create').click( function (e) {
        e.preventDefault();
        createItem();
    });
});

function getPathCtrl()
{
    return $("input[name='"+model+"-path-ctrl']").val();
}

function showListItems(page=1)
{
    url = getPathCtrl();
    params  = $('#'+model+'-form-search').serialize();
    params += "&page="+page;

    $.ajax({
        data: params, url: url,
        type:  'GET', dataType: 'html',
        success:  function (response) {
            $('.'+model+'-table').html(response);

            $('.'+model+'-paginator .pagination a').click( function (e) {
                e.preventDefault();
                $('.firma-paginator li').removeClass('active');
                $(this).parent('.firma-paginator li').addClass('active');
                let page=$(this).attr('href').split('page=')[1];
                showListItems(page);
            })

            $('.'+model+'-btn-show').click( function (e) {
                e.preventDefault();
                id = $(this).siblings('input').val();
                showItem(id);
            });

            $('.'+model+'-btn-edit').click( function (e) {
                e.preventDefault();
                id = $(this).siblings('input').val();
                editItem(id);
            });
        
            $('.'+model+'-btn-delete').click( function (e) {
                e.preventDefault();
                id = $(this).siblings('input').val();
                deleteItem(id);
            });
        }
    });
}

function configCombos()
{
    let url = getPathCtrl();
    $.ajax({
        data: {}, url: url+'/api/service?name=getDataCombos',
        type:  'GET', dataType: 'json',
        success:  function (response) {
            // console.log(response);
            itemsData = $.map(response.items, function (obj) {
                obj.id = obj.IdListItem;
                obj.text = obj.Modulo + " :: " + obj.SubModulo;
                return obj;
            });

            permisosData = $.map(response.permisos, function (obj) {
                obj.id = obj.IdPermiso;
                obj.text = obj.Descripcion;
                return obj;
            });

            reportesData = $.map(response.reportes, function (obj) {
                obj.id = obj.idReporte;
                obj.text = obj.Modulo + " :: " + obj.Reporte;
                return obj;
            });

            $(".lista-modulos").select2({
                data: itemsData,
            });

            $(".lista-permisos").select2({
                data: permisosData,
            });

            $(".lista-reportes").select2({
                data: reportesData,
            });
    
        }
    });
}

function getDataRol(idRol)
{
    url = getPathCtrl();
    params = {
        name: 'getDataRol',
        idRol: idRol,
    };
    $.ajax({
        data: params, url: url+'/api/service',
        type:  'GET', dataType: 'json',
        success:  function (response) {
            // console.log(response);

            misItems = $.map(response.misModulos, function (obj) {
                obj.id = obj.IdListItem;
                obj.chkAgregar = obj.Agregar==1? 'checked': null;
                obj.chkModificar = obj.Modificar==1? 'checked': null;
                obj.chkConsultar = obj.Consultar==1? 'checked': null;
                obj.chkEliminar = obj.Eliminar==1? 'checked': null;
                return obj;
            });
            
            misPermisos = $.map(response.misPermisos, function (obj) {
                obj.id = obj.IdPermiso;
                return obj;
            });

            misReportes = $.map(response.misReportes, function (obj) {
                obj.id = obj.IdReporte;
                obj.Modulo = obj.MODULO;
                return obj;
            });

            verMisItems();
            verMisPermisos();
            verMisReportes();
            configCombos();
        }
    });
}

function addEventsForm()
{
    $(".btn-agregar-modulo").click( function (e) {
        e.preventDefault();
        agregarModulo( $(".lista-modulos").val() );
    });

    $(".btn-agregar-permiso").click( function (e) {
        e.preventDefault();
        agregarPermiso( $(".lista-permisos").val() );
    });

    $(".btn-agregar-reporte").click( function (e) {
        e.preventDefault();
        agregarReporte( $(".lista-reportes").val() );
    });

    $(".chk-reporte-todos").change( function (e) {
        e.preventDefault();
        if($(this).prop('checked')){
            $('.chk-reporte-ninguno').prop('checked', false);
            misReportes = JSON.parse( JSON.stringify(reportesData) );
            verMisReportes();
            // realizar acciones
        }
    });

    $(".chk-reporte-ninguno").change( function (e) {
        e.preventDefault();
        if($(this).prop('checked')){
            $('.chk-reporte-todos').prop('checked', false);
            misReportes = [];
            verMisReportes();
            // realizar acciones
        }
    });
}

//MODULOS
function agregarModulo(id)
{
    itemExiste = misItems.find( element => element.id === id);

    if(itemExiste == null){
        itemData = itemsData.find(element => element.id === id);
        item = JSON.parse( JSON.stringify(itemData) );
        item.chkAgregar = $(".chk-modulo-agregar").prop('checked')? 'checked':null;
        item.chkModificar = $(".chk-modulo-modificar").prop('checked')? 'checked': null;
        item.chkConsultar = $(".chk-modulo-consultar").prop('checked')? 'checked': null;
        item.chkEliminar = $(".chk-modulo-eliminar").prop('checked')? 'checked': null;
        misItems.push(item);
        verMisItems();
    }else{
        toastr.warning("El item ya ha sido agregado");
    }
}

function quitarModulo(id)
{
    for( key in misItems){
        if( misItems[key].id == id){
            misItems.splice(key, 1);
            verMisItems();
            break;
        }
    }
}

function verMisItems()
{
    let html = "";
    misItems.forEach( (element, key) => {
        html += '<tr>';
            html += '<td>'+element.SubModulo+'<input type="hidden" name="modulos['+key+'][idListItem]" value="'+element.IdListItem+'"></td>';
            html += '<td>'+element.Modulo+'</td>';
            html += '<td align="center"> <input type="checkbox" name="modulos['+key+'][agregar]" value="1" '+element.chkAgregar+'> </td>';
            html += '<td align="center"> <input type="checkbox" name="modulos['+key+'][modificar]" value="1" '+element.chkModificar+'> </td>';
            html += '<td align="center"> <input type="checkbox" name="modulos['+key+'][consultar]" value="1" '+element.chkConsultar+'> </td>';
            html += '<td align="center"> <input type="checkbox" name="modulos['+key+'][eliminar]" value="1" '+element.chkEliminar+'> </td>';
            html += '<td>';
                html += '<input type="hidden" value="'+element.id+'">';
                html += '<a href="#" class="btn btn-xs btn-default btn-quitar-modulo"> <i class="text-red fa fa-close"></i></a>';
            html += '</td>';
        html += '</tr>';
    });

    $('.tbody-modulos').html(html);

    $(".btn-quitar-modulo").click( function (e) {
        e.preventDefault();
        quitarModulo( $(this).siblings('input').val() );
    });
}

// PERMISOS
function agregarPermiso(id)
{
    itemExiste = misPermisos.find( element => element.id === id);
    
    if(itemExiste == null){
        itemData = permisosData.find(element => element.id === id);
        item = JSON.parse( JSON.stringify(itemData) );
        misPermisos.push(item);
        verMisPermisos();
    }else{
        toastr.warning("El permiso ya ha sido agregado");
    }
}

function quitarPermiso(id)
{
    for( key in misPermisos){
        if( misPermisos[key].id == id){
            misPermisos.splice(key, 1);
            verMisPermisos();
            break;
        }
    }
}

function verMisPermisos()
{
    let html = "";
    misPermisos.forEach( (element, key) => {
        html += '<tr>';
            html += '<td>'+element.Descripcion+'<input type="hidden" name="permisos['+key+'][idPermiso]" value="'+element.id+'"></td>';
            html += '<td>';
                html += '<input type="hidden" value="'+element.id+'">';
                html += '<a href="#" class="btn btn-xs btn-default btn-quitar-permiso"> <i class="text-red fa fa-close"></i></a>';
            html += '</td>';
        html += '</tr>';
    });

    $('.tbody-permisos').html(html);

    $(".btn-quitar-permiso").click( function (e) {
        e.preventDefault();
        quitarPermiso( $(this).siblings('input').val() );
    });
}

// REPORTES
function agregarReporte(id)
{
    itemExiste = misReportes.find( element => element.id === id);
    
    if(itemExiste == null){
        itemData = reportesData.find(element => element.id === id);
        item = JSON.parse( JSON.stringify(itemData) );
        misReportes.push(item);
        verMisReportes();
    }else{
        toastr.warning("El reporte ya ha sido agregado");
    }
}

function quitarReporte(id)
{
    for( key in misReportes){
        if( misReportes[key].id == id){
            misReportes.splice(key, 1);
            verMisReportes();
            break;
        }
    }
}

function verMisReportes()
{
    let html = "";
    misReportes.forEach( (element, key) => {
        checked = element.tieneAcceso==1? 'checked': null;
        html += '<tr>';
            html += '<td>'+element.Reporte+'<input type="hidden" name="reportes['+key+'][idReporte]" value="'+element.id+'"></td>';
            html += '<td>'+element.Modulo+'</td>';
            html += '<td align="center"> <input type="checkbox" name="reportes['+key+'][tieneAcceso]" value="1" '+checked+' style="width:30px;"></td>';
            html += '<td>';
                html += '<input type="hidden" value="'+element.id+'">';
                html += '<a href="#" class="btn btn-xs btn-default btn-quitar-reporte"> <i class="text-red fa fa-close"></i></a>';
            html += '</td>';
        html += '</tr>';
    });

    $('.tbody-reportes').html(html);

    $(".btn-quitar-reporte").click( function (e) {
        e.preventDefault();
        quitarReporte( $(this).siblings('input').val() );
    });
}

// CRUD
function createItem()
{
    let url = getPathCtrl();

    $.ajax({
        data: {}, url: url+'/create',
        type:  'GET', dataType: 'html',
        success:  function (response) {
            configCombos();
            misItems = [];
            misPermisos = [];
            misReportes = [];
            $('#myModalTitle').html('Crear '+model);
            $('#myModalSize').addClass('modal-lg'); //options: '', 'modal-lg'
            $('#myModalBody').html(response);
            
            $('#'+model+'-form').submit( function (e) {
                e.preventDefault();
                storeItem();
            });

            addEventsForm();

            $('#myModal').modal('show');
            
        }
    });
}

function editItem(id)
{
    let url = getPathCtrl();
    $.ajax({
        data: {}, url: url+'/'+id+'/edit',
        type:  'GET', dataType: 'html',
        success:  function (response) {
            $('#myModalTitle').html('Editar '+model);
            $('#myModalSize').addClass('modal-lg');
            $('#myModalBody').html(response);
            $('#myModal').modal('show');

            $('#'+model+'-form').submit( function (e) {
                e.preventDefault();
                updateItem(id);
            });

            addEventsForm();
            getDataRol(id);

            $('#myModal').modal('show');
        }
    });
}

function showItem(id)
{
    let url = getPathCtrl();
    $.ajax({
        data: {}, url: url+'/'+id,
        type:  'GET', dataType: 'html',
        success:  function (response) {
            $('#myModalTitle').html('Ver '+model);
            $('#myModalSize').addClass('modal-lg'); //options: '', 'modal-lg'
            $('#myModalBody').html(response);
            $('#'+model+'-form').submit( function (e) {
                e.preventDefault();
                $('#myModal').modal('hide');
            });
            
            getDataRol(id);

            $('#myModal').modal('show');
        }
    });
}

function deleteItem(id)
{
    let url = getPathCtrl();
    $.ajax({
        data: {}, url: url+'/'+id+'/delete',
        type:  'GET', dataType: 'html',
        success:  function (response) {
            $('#myModalTitle').html('Eliminar '+model);
            $('#myModalBody').html(response);
            $('#myModal').modal('show');

            $('#'+model+'-form').submit( function (e) {
                e.preventDefault();
                destroyItem(id);
            });

            $('#myModal').modal('show');
        }
    });
}

function storeItem()
{
    params = $('#'+model+'-form').serialize();
    url = getPathCtrl();

    $.ajax({
        data: params, url: url,
        type:  'POST', dataType: 'json',
        success:  function (response) {
            if(response.success){
                toastr.success(model+' creado', 'OK!');
                $('#'+model+'-form-search').trigger("reset");
                showListItems();
                $('#myModal').modal('hide');
            }else{
                toastr.error( response.message, 'Error');
            }
        },
        error: function (request, status, error) {
            showErrosValidator(request);
        }
    });
}

function updateItem(id)
{
    params = $('#'+model+'-form').serialize();
    url = getPathCtrl();

    $.ajax({
        data: params, url: url+'/'+id,
        type:  'POST', dataType: 'json',
        success:  function (response) {
            if(response.success){
                toastr.success(model+' actualizado', 'OK!');
                showListItems();
                $('#myModal').modal('hide');
            }
        },
        error: function (request, status, error) {
            showErrosValidator(request);
        }
    });
}

function destroyItem(id)
{
    params = $('#'+model+'-form').serialize();
    url = getPathCtrl();

    $.ajax({
        data: params, url: url+'/'+id,
        type:  'POST', dataType: 'json',
        success:  function (response) {
            if( response.success ){
                toastr.success(model+' eliminado', 'OK!');
                $('#'+model+'-form-search').trigger("reset");
                showListItems();
                $('#myModal').modal('hide');
            }else {
                toastr.error(response.message, 'Error');
            }
        }
    });
}

function showErrosValidator(request)
{
    errors = request.responseJSON.errors;
    html = '<ul>';
    for (var key in errors) {
        html += "<li>" + key + ": " + errors[key] + "</li>";
    }
    html += '</ul>';
    toastr.error(html, 'Error')
}

