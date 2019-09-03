var model="catalogoServicios";

var puntosData = [];
var preciosData = [];
var misPuntos = [];
var misPrecios = [];
var action = 'CREATE';
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

function cargarCombos()
{
    let url = getPathCtrl();

    $.ajax({
        data: {name: 'getDataCombos'}, url: url+'/api/service',
        type:  'GET', dataType: 'json',
        success:  function (response) {
            // console.log(response.partidas);
            gruposData = response.grupos;
            centrosData = response.centros;
            partidasData = response.partidas;

            misPuntos = [];
            puntosData = [];
            puntosData = response.puntos;

            gruposData.unshift({id:'', text:'Seleccione...'});
            centrosData.unshift({id:'', text:'Ninguno'});
            partidasData.unshift({id:'', text:'Ninguno'});

            $("#idServicioGrupo").select2({ data: gruposData });
            $("#idCentroCosto").select2({ data: centrosData });
            $("#idPartida").select2({ data: partidasData});
            $("#lista-puntos-carga").select2({ data: puntosData});

            if (action !== 'CREATE'){
                idServicioGrupo = $("#idServicioGrupoTmp").val();
                $("#idServicioGrupo").val( idServicioGrupo );
                $('#idServicioGrupo').select2().trigger('change');
                cargarComboSubGrupo( idServicioGrupo );

                $("#idCentroCosto").val( $('#idCentroCostoTmp').val() );
                $('#idCentroCosto').select2().trigger('change');

                $("#idPartida").val( $('#idPartidaTmp').val() );
                $('#idPartida').select2().trigger('change');

                cargarTablaPuntos( $('#idProducto').val() );
            }

            $("#idServicioGrupo").change( function () {
                idServicioGrupo = $(this).val();
                cargarComboSubGrupo( idServicioGrupo );
            });

        }
    });
}

function cargarComboSubGrupo(idServicioGrupo)
{
    $.ajax({
        data: {name: 'getDataComboSubGrupo', id: idServicioGrupo }, 
        url: getPathCtrl()+'/api/service',
        type:  'GET', dataType: 'json',
        success:  function (subGrupoData) {
            $ ("#idServicioSubGrupo").html ('').select2({ data: subGrupoData });
            $ ("#idServicioSeccion").html ('');
            $ ("#idServicioSubSeccion").html ('');

            
            if (action !== 'CREATE'){
                idServicioSubGrupo = $("#idServicioSubGrupoTmp").val();
                $("#idServicioSubGrupo").val( idServicioSubGrupo );
                $('#idServicioSubGrupo').select2().trigger('change');
                cargarComboSeccion( idServicioSubGrupo);
            }

            $("#idServicioSubGrupo").change( function () {
                idServicioSubGrupo = $(this).val();
                cargarComboSeccion( idServicioSubGrupo);
            });
        }
    });
}

function cargarComboSeccion( idServicioSubGrupo )
{
    $.ajax({
        data: {name: 'getDataComboSeccion', id: idServicioSubGrupo }, 
        url: getPathCtrl()+'/api/service',
        type:  'GET', dataType: 'json',
        success:  function (seccionData) {
            seccionData.unshift({id: '', text:''});
            $ ("#idServicioSeccion").html ('').select2({ data: seccionData });

            if (action !== 'CREATE'){
                idServicioSeccion = $("#idServicioSeccionTmp").val();
                $("#idServicioSeccion").val( idServicioSeccion );
                $('#idServicioSeccion').select2().trigger('change');
                cargarComboSubSeccion( idServicioSeccion);
            }

            $("#idServicioSeccion").change( function () {
                idServicioSeccion = $(this).val();
                cargarComboSubSeccion(idServicioSeccion);
            });
        }
    });
}

function cargarComboSubSeccion( idServicioSeccion )
{
    $.ajax({
        data: {name: 'getDataComboSubSeccion', id: idServicioSeccion }, 
        url: getPathCtrl()+'/api/service',
        type:  'GET', dataType: 'json',
        success:  function (subSeccionData) {
            subSeccionData.unshift({id: '', text:''});
            $ ("#idServicioSubSeccion").html ('').select2({ data: subSeccionData });

            if (action !== 'CREATE'){
                idServicioSubSeccion = $("#idServicioSubSeccionTmp").val();
                $("#idServicioSubSeccion").val( idServicioSubSeccion );
                $('#idServicioSubSeccion').select2().trigger('change');
            }
        }
    });
}

function cargarTablaPrecios(idProducto = 0)
{
    let seUsaSinPrecioDisabled = ( action=='DELETE' || action=='SHOW')? 'disabled': '';
    let precioUnitarioDisabled = ( action=='DELETE' || action=='SHOW')? 'disabled': '';
    $.ajax({
        data: {name: 'getDataPrecios', idProducto:idProducto}, url: getPathCtrl()+'/api/service',
        type:  'GET', dataType: 'json',
        success:  function (data) {
            tbody = '';
            for( i in data){
                precio = data[i]
                let seUsaSinPrecio = (typeof precio.SeUsaSinPrecio == 'undefined')? 0: precio.SeUsaSinPrecio;
                seUsaSinPrecioChecked = seUsaSinPrecio=='1'? 'checked': '';
                precioUnitario = (typeof precio.PrecioUnitario == 'undefined')? 0: precio.PrecioUnitario; 
                precioUnitario = parseFloat(precioUnitario).toFixed(2);
                
                tbody += '<tr>';
                    tbody += '<td>'+data[i].Descripcion+'<input type="hidden" name="precios['+i+'][idTipoFinanciamiento]" value="'+data[i].IdTipoFinanciamiento+'"></td>';
                    tbody += '<td align="center"><input type="text" name="precios['+i+'][precioUnitario]" value="'+precioUnitario+'" '+precioUnitarioDisabled+' style="width:40px; text-align:center;"></td>';
                    tbody += '<td align="center"><input type="checkbox" name="precios['+i+'][seUsaSinPrecio]" value="1" '+seUsaSinPrecioChecked+' '+seUsaSinPrecioDisabled+'></td>';
                tbody += '</tr>';
                // console.log(data[i]);
            }
            $('.tbody-precios').html(tbody);
        }
    });
}

// para todas las acciones excepto crear
function cargarTablaPuntos(idProducto) 
{
    $.ajax({
        data: {name: 'getDataPuntos', idProducto:idProducto}, url: getPathCtrl()+'/api/service',
        type:  'GET', dataType: 'json',
        success:  function (data) {
            data.forEach( element => {
                esPreVenta = (typeof element.esPreVenta == 'undefined')? 0: element.esPreVenta;
                
                agregarPunto( element.idPuntoCarga, esPreVenta);
            });
        }
    });
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

//PUNTOS CARGA
function agregarPunto(id, esPreVenta=0)
{
    itemExiste = misPuntos.find( element => element.id === id);
    if(itemExiste == null){
        itemData = puntosData.find(element => element.id === id);
        item = JSON.parse( JSON.stringify(itemData) );
        item.esPreVenta = esPreVenta;
        misPuntos.push(item);
        verMisPuntos();
    }else{
        toastr.warning("El punto de carga ya ha sido agregado");
    }
}

function quitarPunto(id)
{
    index = misPuntos.findIndex( element => element.id === id);
    misPuntos.splice(index, 1);
    verMisPuntos();
}

function verMisPuntos()
{
    let checkDisabled = ( action=='DELETE' || action=='SHOW')? 'disabled': '';
    let html = "";
    misPuntos.forEach( (element, key) => {
        tieneIdServicio = element.idServicio != null? 1: 0;
        text = element.text + (tieneIdServicio? '(Serv='+element.idServicio+')': '');
        esPreVentaChecked = element.esPreVenta==1? 'Checked': '';
        html += '<tr>';
            html += '<td>'+(key+1)+'</td>';
            html += '<td>'+text;
                html += '<input type="hidden" name="puntosCarga['+key+'][idPuntoCarga]" value="'+element.id+'">';
                html += '<input type="hidden" name="puntosCarga['+key+'][tieneIdServicio]" value="'+tieneIdServicio+'">';
            html +='</td>';
            html += '<td align="center"> ';
                html += '<input type="hidden" value="'+element.id+'">';
                html += '<input type="checkbox" class="check-esPreventa" value="1" name="puntosCarga['+key+'][esPreVenta]" '+esPreVentaChecked+' '+checkDisabled+'>';
            html += '</td>';
            html += '<td align="center">';
                if(action != 'DELETE'){
                    html += '<input type="hidden" value="'+element.id+'">';
                    html += '<a href="#" class="btn btn-xs btn-default btn-quitar-punto"> <i class="text-red fa fa-close"></i></a>';
                }
            html += '</td>';
        html += '</tr>';
    });

    $('.tbody-puntos').html(html);

    $('.check-esPreventa').change( function (e){
        id = $(this).siblings('input').val();
        index = misPuntos.findIndex( element => element.id === id);
        misPuntos[index].esPreVenta = $(this).prop('checked')? 1: 0;
        // verMisPuntos();
    });

    $(".btn-quitar-punto").click( function (e) {
        e.preventDefault();
        quitarPunto( $(this).siblings('input').val() );
    });
}

//CRUD
function createItem()
{
    let url = getPathCtrl();

    $.ajax({
        data: {}, url: url+'/create',
        type:  'GET', dataType: 'html',
        success:  function (response) {
            action = 'CREATE';
            $('#myModalTitle').html('Crear '+model);
            $('#myModalSize').addClass('modal-lg'); //options: '', 'modal-lg'
            $('#myModalBody').html(response);
            
            $('#'+model+'-form').submit( function (e) {
                e.preventDefault();
                storeItem();
            });
            
            cargarCombos();
            cargarTablaPrecios();

            $(".btn-agregar-punto-carga").click( function(e) {
                agregarPunto( $('#lista-puntos-carga').val() );
            });

            $('#myModal').modal('show');
        }
    });
}

function editItem(id)
{
    url = getPathCtrl();
    
    $.ajax({
        data: {}, url: url+'/'+id+'/edit',
        type:  'GET', dataType: 'html',
        success:  function (response) {
            // console.log(response);
            action = 'EDIT';
            $('#myModalTitle').html('Editar '+model);
            $('#myModalSize').addClass('modal-lg');
            $('#myModalBody').html(response);
            $('#myModal').modal('show');

            $('#'+model+'-form').submit( function (e) {
                e.preventDefault();
                updateItem(id);
            });

            cargarCombos(); //tambien carga la tabla puntos
            cargarTablaPrecios(id);

            $(".btn-agregar-punto-carga").click( function(e) {
                agregarPunto( $('#lista-puntos-carga').val() );
            });

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
            action = 'DELETE';
            $('#myModalTitle').html('Eliminar '+model);
            $('#myModalSize').addClass('modal-lg');
            $('#myModalBody').html(response);
            $('#myModal').modal('show');

            $('#'+model+'-form').submit( function (e) {
                e.preventDefault();
                destroyItem(id);
            });

            cargarCombos(); //tambien carga la tabla puntos
            cargarTablaPrecios(id);

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



