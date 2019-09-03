const ICON_VALIDAR_TRUE = 'fa fa-fw fa-check text-green';
const ICON_VALIDAR_FALSE = 'fa fa-fw fa-close text-red';

const ICON_TRUE = 'fa fa-check';
const ICON_FALSE = 'fa fa-close';
const ICON_NULL = 'fa';

const ICON_PENDING_TRUE = 'fa fa-clock-o fa-true';
const ICON_PENDING_FALSE = 'fa fa-clock-o fa-false';

$(function(){

    $(".btn-aceptar-observaciones").click(function(e){
        e.preventDefault();
        // $("#modal-observaciones").modal('hide');
        $(".input-observaciones").val(CKEDITOR.instances.editor1.getData());
        CKEDITOR.instances.editor1.destroy();
        $("#modal-observaciones").modal('hide');
        
        // console.log(data.getData());
    })

    $(".btn-observaciones").click(function(e) {
        e.preventDefault();
        if (CKEDITOR.instances.editor1 == null){
            CKEDITOR.replace('editor1');
        }
        CKEDITOR.instances.editor1.setData($(".input-observaciones").val());
        $("#modal-observaciones").modal('show');
    })

    $(".btn-pending").click(function(e) {
        e.preventDefault();
        setPendingRaw($(this));
    });

    $(".myselect").change(function(){
        let input = $(this).siblings('input');
        input.val($(this).val());
    });

    $(".btn-check").click(function(e) {
        e.preventDefault();
        
        clickBtnCheck($(this));
    });

    $(".btn-validar").click(function(e) {
        e.preventDefault();
        clickBtnValidar($(this));
    });

    $(".btn-preview").click(function(e) {
        e.preventDefault();
        $idOrden = $("input[name='idOrden']").val();
        getPreview($idOrden);
    });

});

function setPendingRaw(btn)
{
    let inputPending = btn.siblings('.input-pending');
    let icon = btn.children("i")

    if(icon.attr('class') == ICON_PENDING_TRUE){
        icon.attr('class', ICON_PENDING_FALSE);
        inputPending.val(null);
        btn.removeClass('btn-danger');
        btn.addClass('btn-default');
    } else if(icon.attr('class') == ICON_PENDING_FALSE){
        icon.attr('class', ICON_PENDING_TRUE);
        inputPending.val(1);

        $(".btn-validar").children('i').attr('class', ICON_VALIDAR_FALSE);
        $(".input-validar").val(0);

        btn.removeClass('btn-default')
        btn.addClass('btn-danger')
    }
    btn.blur();
}

function clickBtnValidar(btn)
{
    if( $('#IdEmpleado').val() !== $('#IdUsuario').val() ) {
        toastr.error('No puede validar estos resultados ya que no es el responsable');
        return ;
    }
    let inputValidar = btn.siblings('.input-validar');
    let icon = btn.children("i");

    if(icon.attr('class') == ICON_VALIDAR_TRUE){
        icon.attr('class', ICON_VALIDAR_FALSE);
        inputValidar.val(0);
    } else if(icon.attr('class') == ICON_VALIDAR_FALSE){
        //validar resultados pendientes
        if(rowsPending()){
            icon.attr('class', ICON_VALIDAR_TRUE);
            inputValidar.val(1);
        }else{
            toastr.error('No puede validar la prueba mientras tenga resultados pendientes', 'Alerta!');
        }
    }
    // btn.blur();
}

function rowsPending()
{
    let rows = $('.input-pending');
    let cant = 0;
    rows.each( (index, input, array) => {
        if(input.value==1){
            cant++;
        }
    })
    return (cant == 0)
}

function clickBtnCheck (btnCheck)
{
    let i = btnCheck.children("i");
    let icono = i.attr('class');
    let inputCheck = btnCheck.siblings('input.input-check');

    let oxrId = btnCheck.siblings('input.oxr-id').val();

    if(icono === ICON_TRUE){
        i.attr('class', ICON_FALSE);
        inputCheck.val(0)
        $("#btn-antibiograma-"+oxrId).hide();
    }else if(icono === ICON_FALSE){
        i.attr('class', ICON_NULL);
        inputCheck.val(null)
        $("#btn-antibiograma-"+oxrId).hide();
    }else if(icono === ICON_NULL){
        i.attr('class', ICON_TRUE);
        inputCheck.val(1)
        $("#btn-antibiograma-"+oxrId).show();
    }
    btnCheck.blur();
}

function validarForm()
{
    let responsable = $("#realizaPrueba").val();
    if(responsable == 0){
        toastr.error('Debe seleccionar el personal que realizó la prueba');
        return false;
    }
    return true;
}

function getPreview(idOrden)
{
    let url = $("input[name='url_preview']").val();
    $.ajax({
        data: [], url:  url,
        type:  'GET', dataType: 'html',
        success:  function (response) {
            console.log(response);
            $("#modal-preview-body").html(response);
            $("#modal-preview").modal('show');
        }
    });
}

function getReferencias(idItem, nombreItem)
{
    base_path = $('meta[name="base-path"]').attr('content');
    let params = {
        service: 'getTablaItemReferencias',
        idItem: idItem,
    };
    $.ajax({
    data:  params, url: base_path+"/api",
    type:  'GET', dataType: 'html',
    success:  function (response) {
        $("#modal-ref-title").html(nombreItem);
        $("#modal-ref-body").html(response);
        $("#modal-ref").modal('show');
    }
});
}