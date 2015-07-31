/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
var base_url;
jQuery(document).ready( function() {
    base_url = $("#base_url").val();
    checkbox_rol();
    oTable = $('#roles').dataTable( {
    } );
    $("#nuevo_rol").fancybox( {
        'width'          : 700,
        'height'         : 650,
        'transitionIn'   : 'elastic',
        'transitionOut'  : 'elastic',
        'type'	     : 'iframe'
    } );
    $(".editar_rol").fancybox( {
        'width'          : 700,
        'height'         : 650,
        'transitionIn'   : 'elastic',
        'transitionOut'  : 'elastic',
        'type'	     : 'iframe'
    } ); 
    $(".ver_rol").fancybox( {
        'width'          : 700,
        'height'         : 650,
        'transitionIn'   : 'elastic',
        'transitionOut'  : 'elastic',
        'type'	     : 'iframe'
    } );
});

function checkbox_rol(){
    $('.seleccionar').click( function(){
        var rol = $(this).val();
        var panel = $(this).attr('panel');
        var activar;
        if($(this).is(':checked')){
            /*activar permiso*/
            activar = 1;
        }else{
            /*desactivar_permiso*/
            activar = 0;
        }
        $.ajax({
            type: "POST",
            url: base_url+"index.php/configuracion/configuracion/panelRol",
            data: {rol: rol, panel: panel, activar: activar},
            dataType: "json",
            success: function(data, textStatus, jqXHR){
                try{
                    if(data.result == 0){
                        alert('se produjo un error');
                    }
                }catch(E){
                    alert('se produjo un error');
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert('se produjo un error');
            }
        });
    });
}
