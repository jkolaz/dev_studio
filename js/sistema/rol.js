var base_url;

jQuery(document).ready( function() {
    base_url = $("#base_url").val();
    oTable = $('#roles').dataTable( {
        } );
    $("#guardarRol").click( function() {
        nombre = $('#nombreRol').val(); 
        if ( ! nombre ) { 
            alert('Debe ingresar un nombre de rol');
            return false;
        }
        modo = $('#modo').val(); 
        if ( modo == 'N' ) {
            direccion = base_url + "index.php/seguridad/rol/insertar";
        } else {
            direccion = base_url + "index.php/seguridad/rol/modificar"; 
        }
        dataString = $("#frmRol").serialize();
        $.ajax( {
            type : "POST",
            url : direccion,
            data: dataString,
            success: function(data) {
                parent.location.href = base_url + "index.php/seguridad/rol/listar";
                parent.$.fancybox.close();
            }
        } );
    } );
} );

function eliminar_rol(tipo, codigo) {
    var texto = "Esta seguro desea desactivar este rol?";
    if(tipo === "activar"){
        texto = "Esta seguro desea activar este rol?";
    }
    if ( confirm(texto) ) {
        url = base_url + "index.php/seguridad/rol/update/"+tipo+"/" + codigo;
        location.href = url;
    }
}
