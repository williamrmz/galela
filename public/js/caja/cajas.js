var model="cajas";

$(function(){
    showListItems();
    optionNull = { id: "0", text: 'Selecciona un tipo de comprobante' };

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

            $('.'+model+'-btn-show').click( function (e) {
                e.preventDefault();
                id = $(this).siblings('input').val();
                showItem(id);
            });
        
        }
    });
}

function createItem()
{
    let url = getPathCtrl();    
    console.log(url);
    params = $('#'+model+'-form').serialize();

    $.ajax({
        data: {}, url: url+'/create',
        type:  'GET', dataType: 'html',
        success:  function (response) {
            cargarComboTipoComprobante();
            nrosTiposComprobante(1);
            
            $('#myModalTitle').html('Crear '+model);
            $('#myModalSize').addClass('modal-lg'); //options: '', 'modal-lg'
            $('#myModalBody').html(response);
            
            $('#'+model+'-form').submit( function (e) {
                e.preventDefault();
                storeItem();
            });

            $('#myModal').modal('show');
        }
    });
}

function showItem(id)
{
    let url = getPathCtrl();
    console.log(url);

    $.ajax({
        data: {}, url: url+'/'+id+'/show',
        type:  'GET', dataType: 'html',
        success:  function (response) {
            $('#myModalTitle').html('Visualizar Caja');
            $('#myModalBody').html(response);         

            cargarComboTipoComprobante();
            nrosTiposComprobante(parseInt(id));


            $('#'+model+'-form').submit( function (e) {
                e.preventDefault();               
            });

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
            $('#myModalBody').html(response);

            cargarComboTipoComprobante();
            nrosTiposComprobante(parseInt(id));


            $('#'+model+'-form').submit( function (e) {
                e.preventDefault();
                updateItem(id);
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

    //console.log(params);

    $.ajax({
        data: params, url: url,
        type:  'POST', dataType: 'json',
        success:  function (response) {
            console.log(response);
            if(response.success){
                toastr.success(model+' creado', 'OK!');
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



function cargarComboTipoComprobante()
{
    $.ajax({
        data: {}, url: getPathCtrl()+'/api/service?name=tiposComprobante',
        type:  'GET', dataType: 'json',
        success:  function (data) {
            comprobantesTipo = $.map(data.cmbIdTipoComprobante, function (obj) {
                obj.id = obj.IdTipoComprobante;
                obj.text = obj.Descripcion;
                return obj;
            });

            $('select[name="cmbIdTipoComprobante"]').select2({data: comprobantesTipo});

            idTipoComprobante = $("#idtipocomprobante").val();
            $('#cmbIdTipoComprobante').select2('val',idTipoComprobante,true);
        }
    });
}

function nrosTiposComprobante(id)
{
    $.ajax({
        data: {}, url: getPathCtrl()+'/api/service?name=tablaComprobante&idCaja='+id,
        type:  'GET', dataType: 'json',
        success:  function (data) {
            cantidadTipos = data.length;
            /*for(let res of data){
                console.log(res)
            }*/
            //RECIBO
            $('#nroSerieRecibo').val(data[0].NroSerie);
            $('#nroDocIniRecibo').val(data[0].nroDocumentoInicial);
            $('#nroDocFinRecibo').val(data[0].nroDocumentoFinal);
            $('#nroUltDocRecibo').val(data[0].nroDocumento);
            
            //FACTURA
            $('#nroSerieFactura').val(data[1].NroSerie);
            $('#nroDocIniFactura').val(data[1].nroDocumentoInicial);
            $('#nroDocFinFactura').val(data[1].nroDocumentoFinal);
            $('#nroUltDocFactura').val(data[1].nroDocumento);

            
            //BOLETA
            $('#nroSerieBoleta').val(data[2].NroSerie);
            $('#nroDocIniBoleta').val(data[2].nroDocumentoInicial);
            $('#nroDocFinBoleta').val(data[2].nroDocumentoFinal);
            $('#nroUltDocBoleta').val(data[2].nroDocumento);

            
            //TICKET
            $('#nroSerieTicket').val(data[3].NroSerie);
            $('#nroDocIniTicket').val(data[3].nroDocumentoInicial);
            $('#nroDocFinTicket').val(data[3].nroDocumentoFinal);
            $('#nroUltDocTicket').val(data[3].nroDocumento);

            

            //$('input[name="txtApellidoPaterno"]').val( paciente.ApellidoPaterno);
        }
    });
}