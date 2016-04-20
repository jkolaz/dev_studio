var base_url;
var controlador_menu = "index.php/configuracion/menu/";

jQuery(document).ready( function() {
    base_url = $("#base_url").val();
    oTable = $('#roles').dataTable( {
        } );
    
} );

function desactivar(codigo, tipo) {
    var texto = "Esta seguro desea desactivar este rol?";
    if(tipo === "activar"){
        texto = "Esta seguro desea activar este rol?";
    }
    if ( confirm(texto) ) {
        url = base_url +controlador_menu+ "delete/"+tipo+"/" + codigo;
        location.href = url;
    }
}

function editar(codigo){
    url = base_url + controlador_menu +"update/"+codigo;
    location.href = url;
}