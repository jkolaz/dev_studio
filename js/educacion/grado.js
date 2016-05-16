/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

var base_url;
var controlador_menu = "index.php/educacion/grado/";

jQuery(document).ready( function() {
    base_url = $("#base_url").val();
//    $('#nuevoPadre').click(function(){
//        var ruta = base_url + controlador_menu +$(this).attr('ruta')+'/0';
//        location.href = ruta;
//    });
    if(validate_permiso == 1){
        $('#form1').validate();
    }
} );

function desactivar(codigo, tipo) {
    var texto = "Esta seguro desea desactivar este rol?";
    if(tipo === "activar"){
        texto = "Esta seguro desea activar este rol?";
    }
    if ( confirm(texto) ) {
        var url = base_url +controlador_menu+ "delete/"+tipo+"/" + codigo;
        location.href = url;
    }
}

function editar(codigo){
    var url = base_url + controlador_menu +"update/"+codigo;
    location.href = url;
}
