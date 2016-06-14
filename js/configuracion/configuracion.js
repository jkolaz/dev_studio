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
    
    $('#a_inicio_clases').click(function(){
        $(this).hide();
        $('#div_inicio_clases').show();
    });
    $('#cancelar_inicio_clases').click(function(){
        $('#a_inicio_clases').show();
        $('#div_inicio_clases').hide();
    });
    
    $('#inicio_matricula').datepicker({
        dateFormat: "yy-mm-dd",
        dayNamesMin: [ "Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa" ],
        showButtonPanel: true,
        onSelect: function(date){
            inicio(date);
        }
    });
} );

function cerrar_anio(id){
    var R = confirm('¿Estás seguro de cerrar el año escolar?')
    if(R === true){
        var url = controlador+'cerrarAnio/'+id;
        location.href=url;
    }
}

function inicio(fecha){
    $.ajax({
        type: "POST",
        cache: false,
        url: controlador+"fecha_inicio/"+$('#anio_').val(),
        data: {fecha: fecha},
        context: document.body,
        async: false,
        success: function(html)
        {
            $("#grado").html(html);
        }
    });
}

function inicio_clases(id){
    alert(id);
}

function fin_clases(id){
    alert(id);
}