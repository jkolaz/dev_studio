<html>
    <head>
        <script type="text/javascript" src="<?php echo base_url() ?>js/jquery.js"></script>        
        <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>css/estilos.css" media="screen" />
        <title>Asigar Profesor</title>
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
                asignar_profesor();
            } );
            function asignar_profesor(){
                $('#nuevo').click(function(){
                    var profesores = "";
                    if($('.seleccionar').is(':checked')){
                        $('.seleccionar').each(function(index, value){
                            if($(this).is(':checked')){
                                profesores += $(this).val()+",";
                            }
                        });
                        $.ajax({
                            type: "POST",
                            url: base_url+"index.php/educacion/curso/agregarProfesor",
                            data: {curso: <?=$curso?>, profesores: profesores},
                            dataType: "json",
                            success: function(data, textStatus, jqXHR){
                                try{
                                    if(data.result == 1){
                                        location.href = base_url+"index.php/educacion/curso/verProfesores/<?=$curso?>";
                                    }else{
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
                    }else{
                        alert('Debe de seleccionar a un profesor.')
                    }
                });
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
            <ul curso="<?=$curso?>" id="nuevo" class="lista_botones">
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
                                <input type="checkbox" name="seleccionar[<?=$objeto->USUA_codigo?>]" id="seleccionar_<?=$objeto->USUA_codigo?>" value="<?=$objeto->USUA_id?>" class="seleccionar"/>
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
