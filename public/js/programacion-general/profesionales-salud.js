// Variables
var especialidadesSeleccionadas = [];

// Se ejecuta cuando carga la página
$(document).ready(function () {
    listar();
    initEventos();
    initCargarCombos();
    initForm();
});

function initEventos() {
    // :: Se ejecuta al presionar en el boton de busqueda
    $('#' + model + '-form-search').submit(function (e) {
        e.preventDefault();
        listar();
    });

    // :: Limpiar búsqueda
    $('#' + model + '-btn-clear').click(function (e) {
        e.preventDefault();
        $("input[name=ftxtCodPlanilla]").val("");
        $("input[name=ftxtApellidoPaterno]").val("");
        $("input[name=ftxtApellidoMaterno]").val("");
        $("input[name=ftxtNombres]").val("");
        listar();
    });

    // :: Botón crear <- Muestra el formulario para crear un paciente
    $('#' + model + '-btn-create').click(function (e) {
        e.preventDefault();
        formCreate();
    });

    // :: Botón mostrar
    $('body').on('click', '.' + model + '-btn-show', function (e) {
        e.preventDefault();
        idProfesionalSalud = $(this).siblings('input').val();
        formShow(idProfesionalSalud);
    });

    // :: Botón cancelar
    $(".btn-cancel").click(function (e) {
        e.preventDefault();
        openModalCrud('CANCEL');
    });

    // :: Guarda o actualiza el registro del paciente
    $('body').on('click', '.btn-save', function (e) {
        e.preventDefault();
        actionSave();
    });

    // :: Editar
    $('body').on('click', '.' + model + '-btn-edit', function (e) {
        e.preventDefault();
        idProfesionalSalud = $(this).siblings('input').val();
        formEdit(idProfesionalSalud);
    });

    // :: Eliminar
    $('body').on('click', '.' + model + '-btn-delete', function (e) {
        e.preventDefault();
        idProfesionalSalud = $(this).siblings('input').val();
        formDelete(idProfesionalSalud);
    });

    // :: Cada vez que cambia departamentos, traer especialidades
    $('select[name="cmbIdDepartamento"]').on('select2:select', function (e) {
        getEspecialidades();
    });

    // :: Evento click para botón de agregar especialidad a tabla
    $(".btn-especialidad-agregar").click(function () {
        agregarEspecialidad();
    });

    // :: Limpiar ID de supervisor
    $(".btn-supervisor-limpiar").click(function () {
        $('select[name=cmbIdSupervisor]').html('');
        $('select[name=cmbIdSupervisor]').select2({
            ajax:
                {
                    url: url + '/api/service?name=getEmpleadosCoincidencia',
                    dataType: 'json',
                    processResults: function (data) {
                        return {
                            results: data
                        }
                    },
                    cache: true,
                },
            placeholder: 'Escriba apellidos o nombres',
            minimumInputLength: 3,
        });
    });
}

function actionSave()
{
    form = $('#' + model + '-form');
    data = new FormData(form[0]);
    idProfesionalSalud = ($("#id-" + model).val() == "0") ? undefined : $("#id-" + model).val();
    accion = $("#accion-" + model).val().toUpperCase();
    var urlTemp = url;
    if (accion == 'EDIT') {
        urlTemp += '/' + idProfesionalSalud;
        data.append('_method', 'PUT');
    } else if (accion == 'DELETE') {
        urlTemp += '/' + idProfesionalSalud;
        data.append('_method', 'DELETE');
    }

    // Agregar informacion de especialidades al request
    for (var i = 0; i < especialidadesSeleccionadas.length; i++) {
        data.append('especialidades[]', JSON.stringify(especialidadesSeleccionadas[i]));
    }

    $.ajax({
        data: data, url: urlTemp, contentType: false, cache: false, processData: false,
        type: 'POST', dataType: 'json',
        beforeSend: function () {
            $(".btn-cancel").addClass('disabled');
            $(".btn-save").addClass('disabled');
            $(".btn-save").html('<i class="fa fa-spinner fa-spin"></i> ESPERE');
        },
        success: function (response) {
            if (response.estado) {
                toastr.success(response.mensaje, 'Información');
                $('#' + model + '-btn-clear').trigger("click");
                openModalCrud('CANCEL');
            } else {
                toastr.error(response.mensaje, 'Error');
            }

        },
        error: function (request, status, error) {
            mostrarErrores(request);
        },
        complete: function (jqXHR, textStatus) {
            $(".btn-cancel").removeClass('disabled');
            $(".btn-save").removeClass('disabled');
            $(".btn-save").html('GUARDAR');
        }
    });
}

function mostrarErrores(request) {
    errors = request.responseJSON.errors;
    html = '<ul>';
    for (var key in errors) {
        html += "<li>" + errors[key] + "</li>";
    }
    html += '</ul>';
    toastr.error(html, 'Error')

}

function initForm() {
    // Limpiar variables
    especialidadesSeleccionadas = [];

    // Limpiar campos
    $("input[name=txtNroDocumento]").val("");
    $("input[name=txtApellidoPaterno]").val("");
    $("input[name=txtApellidoMaterno]").val("");
    $("input[name=txtFechaNacimiento]").val("");
    $("input[name=txtCodigoPlanilla]").val("");
    $("input[name=txtColegiatura]").val("");
    $("input[name=txtLote]").val("");

    // Limpiar combos
    $("select[name=cmbIdDocIdentidad]").val("").trigger("change");
    $("select[name=cmbIdCondicionTrabajo]").val("").trigger("change");
    $("select[name=cmbIdTipoEmpleado]").val("").trigger("change");
    $("select[name=cmbIdDestacado]").val("").trigger("change");
    $("select[name=cmbIdColegio]").val("").trigger("change");
    $("select[name=cmbIdDepartamento]").val("").trigger("change");
    $('select[name=cmbIdEspecialidad]').html('').select2({data: [opcionBlanco]});
    $('select[name=cmbIdSupervisor]').html('');
    initComboSupervisor();

    leerEspecialidades();

    habilitarForm(true);
}

function agregarEspecialidad() {
    var idEspecialidad = $('select[name="cmbIdEspecialidad"]').val();
    var descripcion = $('select[name="cmbIdEspecialidad"]').select2('data')[0].text;

    if (idEspecialidad == "") {
        toastr.error("Debe seleccionar una especialidad", "Error");
        return;
    }

    // Validar que especialidad no esté agregada anteriormente
    for (var i = 0; i < especialidadesSeleccionadas.length; i++) {
        objeto = especialidadesSeleccionadas[i];
        if (objeto.IdEspecialidad == idEspecialidad) {
            toastr.error("La especialidad seleccionada ya existe", "Error");
            return;
        }
    }
    // Agregar especialidad
    var oEspecialidad = new Object();
    oEspecialidad.IdEspecialidad = idEspecialidad;
    oEspecialidad.Descripcion = descripcion;
    oEspecialidad.estado = "NUEVO";
    especialidadesSeleccionadas.push(oEspecialidad);
    leerEspecialidades();
}

function leerEspecialidades(blockButtons = false)
{
    $("." + model + "-especialidades").html("");

    for (var i = 0; i < especialidadesSeleccionadas.length; i++) {
        oEspecialidad = especialidadesSeleccionadas[i];
        var fila = "";
        fila += "<tr>";
        fila += "<td>" + oEspecialidad.IdEspecialidad + "</td>";
        fila += "<td>" + oEspecialidad.Descripcion + "</td>";
        fila += '<td><button class="btn btn-xs btn-secondary btn-especialidad-eliminar" onclick="eliminarEspecialidad(' + oEspecialidad.IdEspecialidad + ')"><i class="fa fa-close text-danger"></i></a></td>';
        fila += "</tr>";
        $("." + model + "-especialidades").append(fila);
    }

    if (blockButtons) {
        $(".btn-especialidad-eliminar").prop("disabled", blockButtons)
    }
}

function eliminarEspecialidad(idEsp)
{
    for (var i = 0; i < especialidadesSeleccionadas.length; i++) {
        oEspecialidad = especialidadesSeleccionadas[i];
        if (oEspecialidad.IdEspecialidad == idEsp) {
            especialidadesSeleccionadas.splice(i, 1);
            break;
            console.log("Eliminar especialidad", id);
        }
    }

    leerEspecialidades();
}

function formCreate() {
    initForm();
    habilitarForm(true);
    openModalCrud('CREATE');
}

function formShow(idProfesionalSalud) {
    initForm();
    cargarDatos(idProfesionalSalud, true);
    habilitarForm(false);
    openModalCrud('SHOW');
}

function formEdit(idProfesionalSalud) {
    initForm();
    cargarDatos(idProfesionalSalud, false);
    habilitarForm(true);
    openModalCrud('EDIT', idProfesionalSalud);
}

function formDelete(idProfesionalSalud) {
    initForm();
    cargarDatos(idProfesionalSalud, true);
    habilitarForm(false);
    openModalCrud('DELETE', idProfesionalSalud);
}


function habilitarForm(estado) {
    $('#profesionales-salud-form input').each(function () {
        $(this).prop('readonly', !estado)
    });
    $('#profesionales-salud-form select').each(function () {
        $(this).prop('disabled', !estado)
    });
    $('#profesionales-salud-form button').each(function () {
        $(this).prop('disabled', !estado)
    });
}

function cargarDatos(idProfesionalSalud, blockButtons = false) {
    $.ajax({
        data: {}, url: url + '/' + idProfesionalSalud,
        type: 'GET', dataType: 'json',
        success: function (response) {
            var empleado = response.empleado;
            var medico = response.medico;
            var especialidades = response.especialidades;

            // Cargar datos del empleado
            $("select[name=cmbIdDocIdentidad]").val(empleado.idTipoDocumento).trigger('change');
            $("input[name=txtNroDocumento]").val(empleado.DNI);
            $("input[name=txtApellidoPaterno]").val(empleado.ApellidoPaterno);
            $("input[name=txtApellidoMaterno]").val(empleado.ApellidoMaterno);
            $("input[name=txtNombres]").val(empleado.Nombres);
            $("input[name=txtFechaNacimiento]").val(empleado.FechaNacimiento);
            $("input[name=txtCodigoPlanilla]").val(empleado.CodigoPlanilla);
            $("select[name=cmbIdTipoEmpleado]").val(empleado.IdTipoEmpleado).trigger('change');
            $("select[name=cmbIdCondicionTrabajo]").val(empleado.IdCondicionTrabajo).trigger('change');
            $("select[name=cmbIdDestacado]").val(empleado.idTipoDestacado).trigger('change');

            // Cargar datos supervisor
            if (empleado.idSupervisor != null && empleado.idSupervisor != "") {
                var option = new Option(empleado.nombre_supervisor, empleado.idSupervisor, true, true);
                $('select[name=cmbIdSupervisor]').append(option).trigger('change');
            }

            // Cargar datos médico
            $("input[name=txtLote]").val(medico.LoteHIS);
            $("select[name=cmbIdColegio]").val(medico.idColegioHIS).trigger('change');
            $("input[name=txtColegiatura]").val(medico.Colegiatura);

            // Cargar especialides
            for (var i = 0; i < especialidades.length; i++)
            {
                var especialidad = especialidades[i];
                var oEspecialidad = new Object();
                oEspecialidad.IdEspecialidad = especialidad.IdEspecialidad;
                oEspecialidad.Descripcion = especialidad.descripcion;
                oEspecialidad.estado = "NUEVO";
                especialidadesSeleccionadas.push(oEspecialidad);
            }

            leerEspecialidades(blockButtons);
        }
    });
}

// Configuración para apertura del formulario
function openModalCrud(accion, idProfesionalSalud = 0) {
    $('#listado-profesionales-salud').toggle();
    $('#form-profesionales-salud').toggle();
    $('#accion-' + model).val(accion);
    $('#id-' + model).val(idProfesionalSalud);

    btn_name = '';
    btn_class = '';

    if (accion == 'CREATE') {

        btn_class = 'btn-primary';
        btn_name = 'GUARDAR';
        visible = true;
    }

    if (accion == 'EDIT') {
        btn_class = 'btn-success';
        btn_name = 'ACTUALIZAR';
        visible = true;
    }

    if (accion == 'DELETE') {
        btn_class = 'btn-danger';
        btn_name = 'ELIMINAR';
        visible = true;
    }

    if (accion == 'SHOW') {
        btn_class = 'btn-default';
        btn_name = 'SHOW';
        visible = false;
    }

    if (accion == 'CANCEL') {
        btn_class = 'btn-success';
        btn_name = 'CANCEL';
        visible = false;
    }
    $('.btn-save').removeClass(['btn-primary', 'btn-default', 'btn-danger', 'btn-success']).addClass([btn_class]).html(btn_name);
    visible ? $('.btn-save').show() : $('.btn-save').hide();
}

// Listar
function listar(nPagina = 1) {
    params = $('#' + model + '-form-search').serialize();
    params += "&page=" + nPagina;

    $.ajax({
        data: params, url: url,
        type: 'GET', dataType: 'html',
        beforeSend: function () {
            $('.' + model + '-tbody').html('<tr> <td colspan="12" class="text-center"> <i class="text-blue fa fa-refresh fa-spin"></i> Buscando... </td> </tr>');
        },
        success: function (response) {
            $('.' + model + '-table').html(response);

            $('.' + model + '-paginator .pagination a').click(function (e) {
                e.preventDefault();
                $('.firma-paginator li').removeClass('active');
                $(this).parent('.firma-paginator li').addClass('active');
                let page = $(this).attr('href').split('page=')[1];
                listar(page);
            })
        }
    });
}

// Cargar combos
function initCargarCombos() {
    $.ajax({
        data: {}, url: url + '/api/service?name=getDataForms',
        type: 'GET', dataType: 'json',
        success: function (data) {

            var form = data;

            // Cargar opcion vacio( "..." ) a los combos en el inicio
            form.cmbIdDocIdentidad.unshift(opcionBlanco);
            form.cmbIdCondicionTrabajo.unshift(opcionBlanco);
            form.cmbIdTipoEmpleado.unshift(opcionBlanco);
            form.cmbIdDestacado.unshift(opcionBlanco);
            form.cmbIdColegio.unshift(opcionBlanco);
            form.cmbIdDepartamento.unshift(opcionBlanco);


            // Mostrar informacion en los combos, y aplicar plugin select2
            $('select[name="cmbIdDocIdentidad"]').select2({data: form.cmbIdDocIdentidad});
            $('select[name="cmbIdCondicionTrabajo"]').select2({data: form.cmbIdCondicionTrabajo});
            $('select[name="cmbIdTipoEmpleado"]').select2({data: form.cmbIdTipoEmpleado});
            $('select[name="cmbIdDestacado"]').select2({data: form.cmbIdDestacado});
            $('select[name="cmbIdColegio"]').select2({data: form.cmbIdColegio});
            $('select[name="cmbIdDepartamento"]').select2({data: form.cmbIdDepartamento});
            $('select[name="cmbIdEspecialidad"]').html('').select2({data: [opcionBlanco]});

        }
    });

    // Inicializar combo de busqueda de supervisor
    initComboSupervisor();
}

function initComboSupervisor() {
    $('select[name=cmbIdSupervisor]').select2({
        ajax:
            {
                url: url + '/api/service?name=getEmpleadosCoincidencia',
                dataType: 'json',
                processResults: function (data) {
                    return {
                        results: data
                    }
                },
                cache: true,
            },
        placeholder: 'Escriba apellidos o nombres',
        minimumInputLength: 3,
    });
}

function getEspecialidades() {
    var idDepartamento = $('select[name="cmbIdDepartamento"]').val();
    if (idDepartamento != '') {
        $.ajax({
            data: {'IdDepartamento': idDepartamento}, url: url + '/api/service?name=getEspecialidades',
            type: 'GET', dataType: 'json',
            success: function (data) {
                var form = data;
                form.unshift(opcionBlanco);
                $('select[name="cmbIdEspecialidad"]').html('');
                $('select[name="cmbIdEspecialidad"]').select2({data: data});
            }
        });
    }
}
