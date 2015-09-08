<?php
$objInstancia = get_instance();
$this->load->model('seguridad/permiso_model');
?>
<html>
    <head>
        <title>Mi Jazmincito | EDUSOFT</title>
        <meta charset="utf-8">
        <script type="text/javascript" src="<?php echo base_url() ?>js/jquery.js"></script>        
        <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>css/estilos.css" media="screen" />
        <script>
            var rol;
            var base_url;
            jQuery(document).ready( function() {
                base_url = $('#base_url').val();
                asignado = $('#asignado').val();
                check_criterio();
            });
            
            
            function check_criterio(){
                $('.criterio').click( function(){
                    var criterio = $(this).val();
                    var activar;
                    if($(this).is(':checked')){
                        activar = 1;
                        /*activar permiso*/
                    }else{
                        activar = 0;
                        /*desactivar permiso*/
                    }
                    $.ajax({
                        type: "POST",
                        url: base_url+"index.php/profesor/profesor/criterioUpdate",
                        data: {asignado: asignado, criterio: criterio, activar: activar},
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
        </script>
    </head>
    <body>
        <input type="hidden" name="asignado" id="asignado" value="<?=$asignado?>" />
        <div id="pagina">
            <div id="zonaContenido">
                <div align="center">
                    
                    <div id="tituloForm" class="header" style="font-size: 16px; font-weight: bold;"><?php echo $curso ?></div>

                    <div id="frmResultado" style="width:100%; height:90%; overflow: auto; background-color: #f5f5f5">

                        <div id="datosGenerales">
                            <table class="fuente8" width="98%" cellspacing=0 cellpadding="6" border="0">
                                <thead>
                                    <tr><th style="font-size: 14px; font-weight: bold; border-bottom: solid 3px;">CRITERIO DE EVALUACIÓN</th></tr>
                                </thead>
                                <tbody>
                                <?php
                                foreach ($criterio as $value) {
                                    $checked = "";
                                    if($value->check != 0){
                                        $checked = "checked";
                                    }
                                    ?>
                                    <tr>
                                        <td>
                                            <input type="checkbox" name="criterio_<?=$value->CRIT_id?>" id="criterio_<?=$value->CRIT_id?>" class="criterio" <?=$checked?> value="<?=$value->CRIT_id?>" />
                                            <?=$value->CRIT_nombre?>
                                        </td>
                                    </tr>
                                    <?php
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
                        <input type="hidden" name="base_url" id="base_url" value="<?php echo base_url() ?>">
                    </div>

                </div>
            </div>
        </div>
    </body>
</html>