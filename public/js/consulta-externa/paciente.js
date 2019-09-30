var model="paciente";

$(function(){
    showListItems();

    $('#'+model+'-form-search').submit( function(e) {
        e.preventDefault();
        showListItems();
    });

    $('#'+model+'-btn-clear').click( function(e) {
        e.preventDefault();
        $('#'+model+'-form-search').trigger("reset");
        $('.'+model+'-tbody').html('<tr> <td colspan="12" class="text-center"> Sin resultados </td> </tr>');
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
    if( validarFiltro() ){
        url = getPathCtrl();
        params  = $('#'+model+'-form-search').serialize();
        params += "&page="+page;

        $.ajax({
            data: params, url: url,
            type:  'GET', dataType: 'html',
            beforeSend: function() {
                $('.'+model+'-tbody').html('<tr> <td colspan="12" class="text-center"> <i class="text-blue fa fa-refresh fa-spin"></i> buscando... </td> </tr>');
            },
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
}


var first_time = true;
function validarFiltro()
{
    // return true;
    dni = $.trim( $('input[name="ftxtDni"]').val() );
    historia = $.trim( $('input[name="ftxtNroHistoria"]').val() );
    aPaterno = $.trim( $('input[name="ftxtApellidoPaterno"]').val() );
    aMaterno = $.trim( $('input[name="ftxtApellidoMaterno"]').val() );
    ficha1 = $.trim( $('input[name="ftxtFichaFamiliar1"]').val() );
    ficha2 = $.trim( $('input[name="ftxtFichaFamiliar2"]').val() );
    ficha3 = $.trim( $('input[name="ftxtFichaFamiliar3"]').val() );

    errors = [];
    if ( (aPaterno== "" && aMaterno == ""  && historia == "" && dni == "") && (ficha1 == "" && ficha2 == "" && ficha3 == "") ){
        errors.push("Por favor ingrese algunos de los filtros (Ap. Paterno ,Ap. Materno, DNI, Ficha Familiar o Nro Historia)");
    }else{
        if (historia == "" && dni == "" && (ficha1 == "" && ficha2 == "" && ficha3 == "") ) {
            if (aPaterno == "") {
                errors.push("Por favor ingrese Ap. Paterno");
            }
        }
    }

    if( errors.length > 0 && first_time==false){
        let html = '<ul>';
        errors.forEach(error => { html += '<li>'+error+'</li>'; });
        html += '</ul>';
        toastr.error(html, 'Error');
    }
    first_time= false;

    return errors.length==0? true: false;
}
