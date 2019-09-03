$(function(){
    $("#item-form-buscar").submit( function (e) {
        e.preventDefault();
        vetTablaItems();
    });

    $(".item-btn-buscar").click( function (e) {
        e.preventDefault();
        vetTablaItems();
    });

    $(".item-btn-limpiar").click( function (e) {
        e.preventDefault();
        $(".item-input-buscar").trigger("reset");
        vetTablaItems();
    });

    vetTablaItems();
});

function getPath()
{
    return $("input[name='path_ctrl']").val();
}

function vetTablaItems(page=1)
{
    url = getPath();
    params = $("#item-form-buscar").serialize();

    $.ajax({
        data: params, url: url, async: true,
        type:  'GET', dataType: 'html',
        beforeSend: function() {
            $(".items-tabla").html("<div class='text-center'><i class='fa fa-spin fa-refresh'></i> Cargando</div>");
        },
        success:  function (response) {
            // $(".items-tabla").html(response);

            // $(".items-btn-show").click( function(e) {
            //     e.preventDefault();
            //     let id = $(this).siblings('input').val();
            //     showItem(id);
            // });

            // $(".btn-collapse").click( function (e) {
            //     e.preventDefault();
            //     icon = $(this).children('i');
            //     tr = $(this).closest("tr");
            //     myCollapse = tr.find('.collapse');

            //     if( icon.attr('class') == 'fa fa-plus' ){
            //         myCollapse.collapse('show');
            //         icon.attr('class', 'fa fa-minus');
            //     }else {
            //         myCollapse.collapse('hide');
            //         icon.attr('class', 'fa fa-plus');
            //     }
            // });
        },

    })
    .done(function(response) {
        $(".items-tabla").html(response);

        $(".items-btn-show").click( function(e) {
            e.preventDefault();
            let id = $(this).siblings('input').val();
            showItem(id);
        });

        $(".btn-collapse").click( function (e) {
            e.preventDefault();
            icon = $(this).children('i');
            tr = $(this).closest("tr");
            myCollapse = tr.find('.collapse');

            if( icon.attr('class') == 'fa fa-plus' ){
                myCollapse.collapse('show');
                icon.attr('class', 'fa fa-minus');
            }else {
                myCollapse.collapse('hide');
                icon.attr('class', 'fa fa-plus');
            }
        });
    });
}

function showItem(id)
{
    url = getPath();
    window.location.href = url + '/' + id;
}


