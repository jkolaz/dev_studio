/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready( function() {
    var BASE_URL = $('#base_url').val();
    
    $('#txt_dni').focus();

    $('#guardar_RA').click(function(e){
        var contador = 0;
        $('.require').each(function(){
            if($(this).val() == "" || $(this).val() == "0"){
                contador ++;
                $(this).attr('style', 'border-color: red;');
            }
        });
        if(contador > 0){
            return false;
        }
    });
    $('#form1').validate();
    
    $( "#txt_dni" ).autocomplete({
        minLength: 2,
        source: BASE_URL+'index.php/reporte/reporte/getAlumnos',
        focus: function( event, ui ) {
          $( "#txt_dni" ).val( ui.item.USUA_dni );
          return false;
        },
        select: function( event, ui ) {
            var UI = ui.item;
          $( "#txt_dni" ).val( UI.USUA_dni );
          $( "#informacion" ).html( UI.USUA_nombres+' '+ UI.USUA_apellidoPaterno+' '+UI.USUA_apellidoMaterno);
          //$( "#project-icon" ).attr( "src", "images/" + ui.item.icon );

          return false;
        }
    })
    .autocomplete( "instance" )._renderItem = function( ul, item ) {
        return $( "<li>" )
        .append( '<a><span style="color: red">' + item.USUA_dni + '</span><br>' + item.USUA_nombres+ item.USUA_apellidoPaterno+' '+item.USUA_apellidoMaterno + '</a>' )
        .appendTo( ul );
    };
    
});