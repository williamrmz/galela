$(function() {
    $(".btn-buscar-empleado").click( e => {
        e.preventDefault();
        buscarEmpleado(1);
    });

    $(".filtro-btn-buscar").click( e => {
        e.preventDefault();
        buscarEmpleado(1);
    });

    $("#filtroTexto").keyup( e => {
        if (e.keyCode==13) buscarEmpleado(1);
        // buscarEmpleado(1);
    });

});

function buscarEmpleado(page){
    let data = {
        service: 'getTablaEmpleados',
        page: page,
        dni: $("#dni").val(),
        empleadoFiltro: $("#filtroTexto").val(),
    }

    $.ajax({
        data:  data , url:   basePath+"/partials",
        type:  'GET', dataType: 'html',
        success:  function (response) {
            $("#myModalBuscarTitle").html('Empleados');
            $("#myModalBuscarBody").html(response);
            $("#myModalBuscar").modal('show');
           
            $('.pagination a').click( function(e) {
                e.preventDefault();
                $('li').removeClass('active');
                $(this).parent('li').addClass('active');
                var url = $(this).attr('href');
                var page = $(this).attr('href').split('page=')[1];
        
                buscarEmpleado(page)
            });

            $('.empleado-btn-seleccionar').click( function (e) {
                e.preventDefault();
                let empleado = $(this).siblings('input').val();
                empleado = JSON.parse(empleado);
                $("#IdEmpleadoRecepciona").val(empleado.IdEmpleado);
                $("#FullnameEmpleadoRecepciona").val(empleado.Fullname);
                $("#myModalBuscar").modal('hide');
            })
        }
    });
}


