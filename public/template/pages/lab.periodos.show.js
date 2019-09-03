var base_path = $('meta[name="base-path"]').attr('content');
var estado = 'NO_SELECT';
var oldval = 0;
$(function(){
    
    $(".write").dblclick(function(){
        input = $(this);
        oldval = input.val();
        estado = 'SELECT';
        
        console.log(input)
        input.css('background', '#FFF');
        input.attr('readOnly', false);
    });


    $(".write").focusout(function(){
        if(estado == 'SELECT'){
            input = $(this);
            input.val(oldval);
            input.css('background', '#C4C4C4');
            input.attr('readOnly', true);
            console.log('out'); 
        }
    });

    //guardar cambios en base de datos
    $('.write').keyup(function(e){
        if(e.keyCode == 13 && estado=='SELECT')
        {   
            // console.log($(this).siblings('input.dia').val());
            params = {
                IdPeriodoDia: $(this).siblings('input.IdPeriodoDia').val(),
                Valor: $(this).val(),
                _token: token,
            };

            url = $("input[name='periodos-path-ctrl']").val();

            $.ajax({
                data:  params, url: url+"/update-periodo-dia",
                type:  'POST',
                beforeSend: function () {
                        
                },
                success:  function (response) { //una vez que el archivo recibe el request lo procesa y lo devuelve
                    console.log(response);

                    toastr.success('Guardado')
                    estado = 'FINISH';
                    input.css('background', '#C4C4C4');
                    input.attr('readOnly', true);
                }
            });

    
            
        }
    });

});