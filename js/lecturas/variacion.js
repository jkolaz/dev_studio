var base_url;

jQuery(document).ready( function() {
    base_url = $("#base_url").val();
    $("#guardarVariacion").click( function() {
        direccion = base_url + "index.php/3_lecturas/variacion_lectura/modificar_semanal";
        dataString = $("#frmVariacion").serialize();
        $.ajax( {
            type : "POST",
            url : direccion,
            data: dataString,
            success: function(data) {
                parent.location.href = base_url + "index.php/3_lecturas/variacion_lectura/listar";
                parent.$.fancybox.close();
            }
        } );
    } );
} );
