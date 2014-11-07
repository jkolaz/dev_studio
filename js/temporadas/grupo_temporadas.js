var base_url;

jQuery(document).ready( function() {
    base_url = $("#base_url").val();
    $("#nuevoGrupo").click( function() {
        url = base_url + "index.php/temporadas/grupo_temporada/nuevo_grupo";
        location.href = url;
    } );
    $("#grabar").click( function() {
        $("#frmGrupoTemporadas").submit();
    } );
    
    
    $("#agregar_grupo").click(function(){
                    
        codigo=$('codigoTemp').val();
        nombre=$('nombreTemp').val();
    // var num = $('#detalle_grupo_temporada').val();
                    
                    
    });
                
    $("#guardarTemporada").click(function(){
         modo=$('#modo').val();
		 if(modo=='N')           
		direccion=base_url+"index.php/3_lecturas/grupo_temporada/insertar";
		else
		direccion=base_url+"index.php/3_lecturas/grupo_temporada/modificar";		
        dataString = $("#frmGrupo").serialize();
        $.ajax({
            type : "POST",
            url : direccion,
            data: dataString,
                                             
            success: function(data){
                            
                parent.location.href= base_url+"index.php/3_lecturas/grupo_temporada/listar_grupos";
                parent.$.fancybox.close(); 
                            
            }
        });
                                       
                                      
    }); 
	
     
    
} );


function eliminarGrupo(codigo) {
    if ( confirm('Esta seguro desea eliminar este grupo de temporadas?') ) {
        
        url = base_url + "index.php/3_lecturas/grupo_temporada/eliminar_grupo/"+codigo;
         location.href = url;
        
    }
}

function preDeterminar(codigo) {
    if ( confirm('Confirma que desea re-asignar el grupo de temporadas vigente?') ) {
        dataString = "cod=" + codigo;
        url = base_url + "index.php/temporadas/grupo_temporada/pre_determinar";
        $.post( url, dataString, function(data) {
            url = base_url + "index.php/temporadas/grupo_temporada/listar_grupos_todos";
            location.href = url;
        } );
    }
}
