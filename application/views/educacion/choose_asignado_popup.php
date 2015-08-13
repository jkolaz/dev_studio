<html>
    <head>
        <script type="text/javascript" src="<?php echo base_url() ?>js/jquery.js"></script>        
        <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>css/estilos.css" media="screen" />

        <link rel="stylesheet" href="<?php echo base_url() ?>js/datatable/media/css/demo_page.css" type="text/css" />
        <link rel="stylesheet" href="<?php echo base_url() ?>js/datatable/media/css/demo_table_jui.css" type="text/css" />
        <link rel="stylesheet" href="<?php echo base_url() ?>js/datatable/examples/examples_support/themes/smoothness/jquery-ui-1.8.4.custom.css" type="text/css" />
        <script type="text/javascript" language="javascript" src="<?php echo base_url() ?>js/datatable/media/js/jquery.dataTables.js"></script>

        <script type="text/javascript" charset="utf-8">
            var base_url;
            $(document).ready( function() {
                base_url   = $("#base_url").val();
                $('#grados').dataTable( {
                    
                } );
                $('#nuevo').click(function(){
                    location.href= $(this).attr('href');
                });
            } );
            function eliminar_asignacion(curso, prof){
                try {
                    $.ajax({
                        type:"POST",
                        url: base_url+"index.php/educacion/curso/eliminarAsignacion",
                        data:{profesor:prof, curso: curso},
                        dataType:"json",
                        success: function (data) {
                            if(data.result == 1){
                                window.parent.refreshPage(1);
                                document.location.reload();
                            }
                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                            alert("Error, Intenta nuevamente.");
                        }
                    });
                }catch(E){
                    alert("ha ocurrido un error.");
                }
            }
        </script>
    </head>
    <body>
        <div align="center">
            <div style="color: #FFF; background-color: #D12122; width: 1000px; height: 20px; padding: 5px;">
                <b><?php echo $titulo ?></b>
                <input type="hidden" name="base_url" id="base_url" value="<?=base_url()?>"/>
            </div>
        </div>
        <br>
        <div id="botonera">
            <ul href="<?php echo base_url() ?>index.php/educacion/curso/nuevaAsignacion" id="nuevo" 
                class="lista_botones">
                <li id="nuevo"> Agregar Profesor </li>
            </ul>
        </div>
        <br>
        <div id="container">
            <div class="demo_jui">
                <table cellpadding="0" cellspacing="0" border="0" class="display" id="grados">
                    <thead>
                        <tr>
                            <th> N </th>
                            <th> CÓDIGO </th>
                            <th> NOMBRES </th>
                            <th> APELLIDOS </th>
                            <th> CORREO </th>
                            <th>&nbsp;&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($lista) {
                            $i = 1;
                            foreach ($lista as $objeto) {
                        ?>
                        <tr>
                            <td style="text-align: center;"><?=$i?></td>
                            <td style="text-align: left;"><?=$objeto->USUA_codigo?></td>
                            <td style="text-align: left;"><?=$objeto->USUA_nombres?></td>
                            <td style="text-align: left;"><?=$objeto->USUA_apellidoPaterno?> <?=$objeto->USUA_apellidoMaterno?></td>
                            <td style="text-align: left;"><?=$objeto->USUA_email?></td>
                            <td>
                                <a href="javascript:;" onclick="eliminar_asignacion(<?=$objeto->CURS_id?>, <?=$objeto->USUA_id?>)">
                                    <img src="<?=base_url()?>img/eliminar.png" border="0" width="16px" height="16px" title="Eliminar Curso" />
                                </a>
                            </td>
                        </tr>
                        <?php
                                $i++;
                            }
                        }
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="2" align="right"> Total : </th>
                            <th align="right"></th>
                            <th align="right"></th>
                            <th align="right"></th>
                            <th align="right"></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <input type="hidden" name="base_url" id="base_url" value="<?php echo base_url() ?>">


        <br>

    </body>
</html>
