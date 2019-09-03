// const basePath = 'http://localhost/galenz/public/';

basePath = '';

servicioInsumos = [];

$(function() {
    
    basePath = $('meta[name="base-path"]').attr('content');

    getServicioInsumos();

    verInsumos();

    $('.btn-modal-insumos').click( (e) => {
        e.preventDefault();
        buscarInsumos(1);
        $('#modal-insumos').modal('show');
    });
    

});


function getServicioInsumos(){
    let params = {
        service: 'getServicioInsumos',
        IdProducto: $("#IdProducto").val(),
    }

    $.ajax({
        data:  params , url:   basePath+"/api",
        type:  'GET', dataType: 'json',
        success:  function (response) {
            servicioInsumos = response;
            verInsumos();
        }
    });
}

function verInsumos()
{
    console.log(servicioInsumos);
    let styleI = 'style="border:0px; width:50px; text-align:center"';
    let html = '';
    servicioInsumos.forEach( (insumo, index) => {
        cantidad = parseFloat(insumo.Cantidad).toFixed(2);
        unidad = (insumo.Unidad != null)? insumo.Unidad: '';
        html += '<tr>';
            html += '<td><input type="hidden" name="insumos['+index+'][IdProducto]" value="'+insumo.IdProducto+'">'+insumo.Codigo+'</td>';
            html += '<td><input type="hidden" name="insumos['+index+'][Nombre]" value="'+insumo.Nombre+'">'+insumo.Nombre+'</td>';
            html += '<td align="center"><input type="number" name="insumos['+index+'][Cantidad]" value="'+cantidad+'"  min="0" placeholder="0" '+styleI+'></td>';
            html += '<td align="center"><input type="text" name="insumos['+index+'][Unidad]" value="'+unidad+'" placeholder="---" '+styleI+'></td>';
            html += '<td> <a href="javascript: quitarInsumo('+index+')" class="btn btn-xs btn-default"> <i class="fa fa-trash"></i></a></td>';
        html += '</tr>';
    });
    $("#tbody-insumos").html(html);
}

function addInsumo(insumo){

    let add = true;
    servicioInsumos.forEach( servicioInsumo => {
        if(servicioInsumo.Codigo == insumo.Codigo){
            add = false; return;
        }
    })

    if(add){
        insumo.Cantidad = 0;
        insumo.Unidad = null;
        servicioInsumos.push(insumo);
        verInsumos();
    }else {
        toastr.error('El insumo ya esta agregado', 'Alert!');
    }
    
}

function quitarInsumo(index){
    servicioInsumos.splice(index, 1);
    verInsumos();
}



function buscarInsumos(page){
    let data = {
        service: 'getInsumos',
        page: page,
        codigo: $("#codigo").val(),
        nombre: $("#nombre").val(),
    }

    $.ajax({
        data:  data , url:   basePath+"/api",
        type:  'GET', dataType: 'html',
        success:  function (response) {

            $("#modal-insumos-body").html(response);

            $('.pagination a').click( function(e) {
                e.preventDefault();
                $('li').removeClass('active');
                $(this).parent('li').addClass('active');
                var url = $(this).attr('href');
                var page = $(this).attr('href').split('page=')[1];
        
                buscarInsumos(page)
            });

            $('.btn-add-insumo').click( function (e) {
                e.preventDefault();
                let insumo = $(this).siblings('input').val();
                insumo = JSON.parse(insumo);
                addInsumo(insumo);
            })

            $(".btn-buscar-insumo").click( function (e) {
                e.preventDefault();
                buscarInsumos(1);
            });

        }
    });
}


