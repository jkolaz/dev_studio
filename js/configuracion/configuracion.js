/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
var controlador;
$(document).ready( function() {
    controlador = $('#controlador').val();
    
    oTable = $('#anio').dataTable( {
        } );
    
    $('#guardar').click(function(){
        var contador = 0;
        $('.require').each(function(){
            if($(this).val() == ""){
                contador ++;
                $(this).attr('style', 'border-color: red;');
            }
        });
        if(contador > 0){
            return false;
        }
    });
    $('#cancelar').click( function(){
        var url = controlador+'getAnioEscolar';
        location.href=url;
    });
    $('#nuevo').click(function(){
        var ruta = $(this).attr('href');
        location.href = ruta;
    });
} );

function cerrar_anio(id){
    var R = confirm('¿Estás seguro de cerrar el año escolar?')
    if(R === true){
        var url = controlador+'cerrarAnio/'+id;
        location.href=url;
    }
}