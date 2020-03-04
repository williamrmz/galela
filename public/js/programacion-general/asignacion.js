$(document).ready(function ()
 {
     initEventos();
     initConfig();
 });

// Eventos iniciales
function initEventos()
{
    $("select[name=cmbIdDepartamento]").change(function (e)
    {
        cargarServiciosPorDepartamento();
    });

    $("select[name=cmbIdRol]").change(function (e)
    {
        var texto = $(this).select2('data')[0].text;
        let desactivarDepartamento = false;
        let desactivarServicio = false;

        if(texto == "DIRECTOR" || texto == "JEFE DE PERSONAL")
        {
            desactivarDepartamento = true;
            desactivarServicio = true;
        }

        if(texto == "JEFE DE DEPARTAMENTO")
        {
            desactivarDepartamento = false;
            desactivarServicio = true;
        }
        
        desactivarCombos(desactivarDepartamento, desactivarServicio);
    });
}

// Activar o desactivar campos
function desactivarCombos(desactivarDepartamento, desactivarServicio)
{
    $("select[name=cmbIdDepartamento]").prop("disabled", desactivarDepartamento);
    $("select[name=cmbIdServicio]").prop("disabled", desactivarServicio);
}
// Configuración inicial
function initConfig()
{
    cargarCombos();
}
// Cargar combos
function cargarCombos()
{
    $.ajax({
        data: {}, url: url + '/api/service?name=getCombos',
        type: 'GET', dataType: 'json',
        success: function (data)
        {
            var form = data;
            // Mostrar informacion en los combos, y aplicar plugin select2
            $('select[name="cmbIdRol"]').select2({data: form.cmbIdRol});
            $('select[name="cmbIdEmpleado"]').select2({data: form.cmbIdEmpleado});
            $('select[name="cmbIdDepartamento"]').select2({data: form.cmbIdDepartamento});
            $('select[name="cmbIdServicio"]').select2({data: form.cmbIdServicio});
        }
    });
}

// Cargar servicios por departamento
 function cargarServiciosPorDepartamento()
 {
     var idDepartamento = $("select[name=cmbIdDepartamento]").val();
     $.ajax({
         data: {idDepartamento}, url: url + '/api/service?name=getComboServicio',
         type: 'GET', dataType: 'json',
         success: function (data)
         {
             // Mostrar informacion en los combos, y aplicar plugin select2
             $('select[name="cmbIdServicio"]').html('').select2({data: data});
         }
     });
 }

// Cargar empleados y roles asociados a esos departamentos
function cargarTablaEmpleadosPorDepartamento()
{

}
