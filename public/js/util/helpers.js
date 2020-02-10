var overlay_title = "&nbsp; Cargando ...";

function ajaxConfig()
{
    $(document).ajaxSend(function()
    {
        $("#overlay").fadeIn(0);
        $("#overlay_title").html(overlay_title);
        overlay_title = "&nbsp; Cargando ...";
    });

    $(document).ajaxStop(function()
    {
        $("#overlay").fadeOut(0);
    });
}