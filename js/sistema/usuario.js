var base_url;

jQuery(document).ready( function() {
    base_url = $("#base_url").val();
    $("#guardarUsuario").click( function() {
        rol = $('#rol').val();
        usuario = $('#usuario').val();
        if ( ! rol ) {
            alert('Debe seleccionar un rol');
            return false;
        }
        if ( ! usuario ) {
            alert('Debe ingresar un nombre de usuario');
            return false;
        }
        modo = $('#modo').val();
        if ( modo == 'N' ) {
            direccion = base_url + "index.php/seguridad/usuario/insertar";
        } else {
            direccion = base_url + "index.php/seguridad/usuario/modificar";
        }
        dataString = $("#frmUsuario").serialize();
        $.ajax( {
            type : "POST",
            url : direccion,
            data: dataString,
            success: function(data) {
                parent.location.href = base_url + "index.php/seguridad/usuario/listar";
                parent.$.fancybox.close();
            }
        } );
    } );
} );

function eliminar_usuario(tipo,codigo) {
    if ( confirm('Esta seguro desea bloquear este usuario?') ) {
        url = base_url + "index.php/seguridad/usuario/eliminar/"+tipo+"/" + codigo;
        location.href = url;
    }
}
function activar_usuario(tipo, codigo) {
    if ( confirm('Esta seguro desea activar este usuario?') ) {
        url = base_url + "index.php/seguridad/usuario/activar/"+tipo+"/" + codigo;
        location.href = url;
    }
}
