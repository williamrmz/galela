var model="empleados";

var rolesData = [];
var cargosData = [];
var areasData = [];
var subAreasData = [];

var misRoles = [];
var misCargos = [];
var misLugares = [];

var action = 'create';

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

function configCombos()
{
    url = getPathCtrl();
    $.ajax({
        data: {}, url: url+'/api/service?name=getDataCombos',
        type:  'GET', dataType: 'json',
        success:  function (response) {
            console.log(response);
            documentoTiposData = $.map(response.documentoTipos, function (obj) {
                obj.id = obj.IdDocIdentidad;
                obj.text = obj.Descripcion;
                return obj;
            });

            trabajoCondicionesData = $.map(response.trabajoCondiciones, function (obj) {
                obj.id = obj.IdCondicionTrabajo;
                obj.text = obj.Descripcion;
                return obj;
            });

            destacadoTiposData = $.map(response.destacadoTipos, function (obj) {
                obj.id = obj.idDestacado;
                obj.text = obj.Destacado;
                return obj;
            });

            empleadoTiposData = $.map(response.empleadoTipos, function (obj) {
                obj.id = obj.IdTipoEmpleado;
                obj.text = obj.DescripcionLarga;
                return obj;
            });

            misRoles = [];
            rolesData = [];
            rolesData = $.map(response.roles, function (obj) {
                obj.id = obj.IdRol;
                obj.text = obj.Nombre;
                return obj;
            });

            misCargos = [];
            cargosData = [];
            cargosData = $.map(response.cargos, function (obj) {
                obj.id = obj.idTipoCargo;
                obj.text = obj.Cargo;
                return obj;
            });

            misLugares = [];
            areasData = [];
            areasData = $.map(response.areas, function (obj) {
                obj.text = obj.nombre;
                return obj;
            });

            $("#idTipoDocumento").select2({
                data: documentoTiposData,
            });

            $("#idTipoEmpleado").select2({
                data: empleadoTiposData,
            });

            $("#idCondicionTrabajo").select2({
                data: trabajoCondicionesData,
            });

            $("#idTipoDestacado").select2({
                data: destacadoTiposData,
            });

            $(".lista-roles").select2({
                data: rolesData,
            });

            $(".lista-cargos").select2({
                data: cargosData,
            });

            $(".lista-areas").select2({
                data: areasData,
            });

            $('.lista-areas').change( function (e) {
                e.preventDefault();
                idArea = $(this).val();
                $.ajax({
                    data: {}, url: url+'/api/service?name=getDataComboSubAreas&idArea='+idArea,
                    type:  'GET', dataType: 'json',
                    success:  function (response) {
                        // console.log(response);
                        subAreasData = [];
                        if( response != 0){
                            subAreasData = response;
                            $("#sub-areas").html("");
                            $("#sub-areas").html("<select class='form-control lista-sub-areas'></select>");
                            $(".lista-sub-areas").select2({
                                data: response,
                            });
                        }else{
                            $("#sub-areas").html("");
                        }
                    }
                });
            });

            CargarDatosALosControles();
    
        }
    });
}

function CargarDatosALosControles()
{
    idEmpleado = $("#idEmpleado").val();
    if ( typeof idEmpleado == 'undefined') return;

    $.ajax({
        data: {}, url: url+'/api/service?name=CargarDatosALosControles&idEmpleado='+idEmpleado,
        type:  'GET', dataType: 'json',
        success:  function (response) {
            var empleado = response.empleado;
            $("#codigoPlanilla").val(empleado.CodigoPlanilla);
            $("#dni").val(empleado.DNI);
            $("#apellidoPaterno").val(empleado.ApellidoPaterno);
            $("#apellidoMaterno").val(empleado.ApellidoMaterno);
            $("#nombres").val(empleado.Nombres);
            $("#fechaNacimiento").val(empleado.FechaNacimiento);

            if ($('#idTipoDocumento').find("option[value='" + empleado.idTipoDocumento + "']").length) {
                $('#idTipoDocumento').val(empleado.idTipoDocumento).trigger('change');
            }
            if ($('#idTipoEmpleado').find("option[value='" + empleado.IdTipoEmpleado + "']").length) {
                $('#idTipoEmpleado').val(empleado.IdTipoEmpleado).trigger('change');
            }
            if ($('#idCondicionTrabajo').find("option[value='" + empleado.IdCondicionTrabajo + "']").length) {
                $('#idCondicionTrabajo').val(empleado.IdCondicionTrabajo).trigger('change');
            }
            if ($('#idTipoDestacado').find("option[value='" + empleado.idTipoDestacado + "']").length) {
                $('#idTipoDestacado').val(empleado.idTipoDestacado).trigger('change');
            }

            $("#idSupervisor").val(empleado.idSupervisor);
            $("#idEstablecimientoExterno").val(empleado.IdEstablecimientoExterno);
            $("#usuario").val(empleado.Usuario);
            $("#clave").val(empleado.Clave);
            $("#usaGalenhos").attr('checked', empleado.loginEstado);
            $("#loginPc").val(empleado.loginPC);
            $("#codigoDigitador").val(empleado.HisCodigoDigitador);
            $("#reniecAutorizado").attr('checked', empleado.ReniecAutorizado);

            misRoles = [];
            misRoles = $.map(response.roles, function (obj) {
                obj.id = obj.IdRol;
                obj.text = obj.Nombre;
                return obj;
            });

            misCargos = [];
            misCargos = $.map(response.cargos, function (obj) {
                obj.id = obj.idCargo;
                obj.text = obj.Cargo;
                return obj;
            });

            misLugares = [];
            misLugares = $.map(response.lugares, function (obj) {
                obj.id = obj.idLaboraSubArea;
                obj.text = obj.SubArea;
                obj.areaText = obj.Area;
                obj.areaId = obj.idLaboraArea;
                return obj;
            });

            verMisRoles();
            verMisCargos();
            verMisLugares();
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

//ROLES
function agregarRol(id)
{
    itemExiste = misRoles.find( element => element.id === id);
    if(itemExiste == null){
        itemData = rolesData.find(element => element.id === id);
        item = JSON.parse( JSON.stringify(itemData) );
        misRoles.push(item);
        verMisRoles();
    }else{
        toastr.warning("El rol ya ha sido agregado");
    }
}

function quitarRol(id)
{
    for( key in misRoles){
        if( misRoles[key].id == id){
            misRoles.splice(key, 1);
            verMisRoles();
            break;
        }
    }
}

function verMisRoles()
{
    let html = "";
    misRoles.forEach( (element, key) => {
        html += '<tr>';
            html += '<td>'+(key+1)+'</td>';
            html += '<td>'+element.text+'<input type="hidden" name="roles['+key+'][idRol]" value="'+element.id+'"></td>';
            html += '<td>';
                if(action != 'DELETE'){
                    html += '<input type="hidden" value="'+element.id+'">';
                    html += '<a href="#" class="btn btn-xs btn-default btn-quitar-rol"> <i class="text-red fa fa-close"></i></a>';
                }
            html += '</td>';
        html += '</tr>';
    });

    $('.tbody-roles').html(html);

    $(".btn-quitar-rol").click( function (e) {
        e.preventDefault();
        quitarRol( $(this).siblings('input').val() );
    });
}

//CARGOS
function agregarCargo(id)
{
    itemExiste = misCargos.find( element => element.id === id);
    if(itemExiste == null){
        itemData = cargosData.find(element => element.id === id);
        item = JSON.parse( JSON.stringify(itemData) );
        misCargos.push(item);
        verMisCargos();
    }else{
        toastr.warning("El cargo ya ha sido agregado");
    }
}

function quitarCargo(id)
{
    for( key in misCargos){
        if( misCargos[key].id == id){
            misCargos.splice(key, 1);
            verMisCargos();
            break;
        }
    }
}

function verMisCargos()
{
    let html = "";
    misCargos.forEach( (element, key) => {
        html += '<tr>';
            html += '<td>'+(key+1)+'</td>';
            html += '<td>'+element.text+'<input type="hidden" name="cargos['+key+'][idTipoCargo]" value="'+element.id+'"></td>';
            html += '<td>';
                if(action != 'DELETE'){
                    html += '<input type="hidden" value="'+element.id+'">';
                    html += '<a href="#" class="btn btn-xs btn-default btn-quitar-cargo"> <i class="text-red fa fa-close"></i></a>';
                }
            html += '</td>';
        html += '</tr>';
    });

    $('.tbody-cargos').html(html);

    $(".btn-quitar-cargo").click( function (e) {
        e.preventDefault();
        quitarCargo( $(this).siblings('input').val() );
    });
}

//LUGARES
function agregarLugar(id)
{
    if (typeof id ==  'undefined'){
        toastr.warning('Ingrese SubArea', 'Alerta');
        return;
    }

    itemExiste = misLugares.find( element => element.id === id);
    if(itemExiste == null){
        itemData = subAreasData.find(element => element.id === id);
        item = JSON.parse( JSON.stringify(itemData) );

        idArea = $(".lista-areas").val();
        // console.log(idArea);
        area = areasData.find( element => element.id == idArea);
        item.areaText = area.nombre;
        item.areaId = area.id;
        misLugares.push(item);
        verMisLugares();
    }else{
        toastr.warning("El lugar de trabajo ya ha sido agregado");
    }
}

function quitarLugar(id)
{
    for( key in misLugares){
        if( misLugares[key].id == id){
            misLugares.splice(key, 1);
            verMisLugares();
            break;
        }
    }
}

function verMisLugares()
{
    let html = "";
    misLugares.forEach( (element, key) => {
        html += '<tr>';
            html += '<td>'+(key+1)+'</td>';
            html += '<td>'+element.areaText+'<input type="hidden" name="lugares['+key+'][idLaboraArea]" value="'+element.areaId+'"></td>';
            html += '<td>'+element.text+'<input type="hidden" name="lugares['+key+'][idLaboraSubArea]" value="'+element.id+'"></td>';
            html += '<td>';
                if(action != 'DELETE'){
                    html += '<input type="hidden" value="'+element.id+'">';
                    html += '<a href="#" class="btn btn-xs btn-default btn-quitar-lugar"> <i class="text-red fa fa-close"></i></a>';
                }
            html += '</td>';
        html += '</tr>';
    });

    $('.tbody-lugares').html(html);

    $(".btn-quitar-lugar").click( function (e) {
        e.preventDefault();
        quitarLugar( $(this).siblings('input').val() );
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
            $('#myModalSize').addClass('modal-lg');
            $('#myModalBody').html(response);
            
            $('#'+model+'-form').submit( function (e) {
                e.preventDefault();
                storeItem();
            });

            configCombos();


            $('.btn-agregar-rol').click( function (e) {
                e.preventDefault();
                agregarRol( $(".lista-roles").val() );
            })

            $('.btn-agregar-cargo').click( function (e) {
                e.preventDefault();
                agregarCargo( $(".lista-cargos").val() );
            })

            $('.btn-agregar-area').click( function (e) {
                e.preventDefault();
                agregarLugar( $(".lista-sub-areas").val() );
            })
            

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
            action = 'EDIT';
            $('#myModalTitle').html('Editar '+model);
            $('#myModalSize').addClass('modal-lg');
            $('#myModalBody').html(response);
            $('#myModal').modal('show');

            $('#'+model+'-form').submit( function (e) {
                e.preventDefault();
                updateItem(id);
            });

            configCombos();

            $('.btn-agregar-rol').click( function (e) {
                e.preventDefault();
                agregarRol( $(".lista-roles").val() );
            })

            $('.btn-agregar-cargo').click( function (e) {
                e.preventDefault();
                agregarCargo( $(".lista-cargos").val() );
            })

            $('.btn-agregar-area').click( function (e) {
                e.preventDefault();
                agregarLugar( $(".lista-sub-areas").val() );
            })
            
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

            configCombos();

            // controls = document.getElementById(model+'-form').elements;
            // for( i in controls) controls[i].disabled = true;
            $('.btn-agregar-rol').hide();
            $('.btn-agregar-cargo').hide();
            $('.btn-agregar-area').hide();
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
                toastr.success('Empleado creado', 'OK!');
                $('#'+model+'-form-search').trigger("reset");
                showListItems();
                $('#myModal').modal('hide');
            }else{
                toastr.error(response.message, 'Error');
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
                toastr.success('Empleado actualizado', 'OK!');
                showListItems();
                $('#myModal').modal('hide');
            }else{
                toastr.error(response.message, 'Error');
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
                toastr.success('Empleado eliminado', 'OK!');
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

