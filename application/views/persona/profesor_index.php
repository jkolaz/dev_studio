<script type="text/javascript" src="<?php echo base_url() ?>js/sistema/usuario.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>js/fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>js/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>js/fancybox/jquery.fancybox-1.3.4.css" media="screen" />
<script type="text/javascript" charset="utf-8">
    $(document).ready( function() {
        oTable = $('#usuarios').dataTable( {
        } );
    } );
</script>
<script type="text/javascript">
    $(document).ready( function() {
        base_url   = $("#base_url").val();
        $(".editar_usuario").fancybox( {
            'width'          : 500,
            'height'         : 350,
            'transitionIn'   : 'elastic',
            'transitionOut'  : 'elastic',
            'type'	     : 'iframe'
        } );
        $(".ver_usuario").fancybox( {
            'width'          : 500,
            'height'         : 350,
            'transitionIn'   : 'elastic',
            'transitionOut'  : 'elastic',
            'type'	     : 'iframe'
        } );
        $('#nuevo_usuario').click(function(){
            location.href = $(this).attr('href');
        });
    } );
</script>

<br><br>
<div id="botonera">
    <ul href="<?php echo base_url() ?>index.php/seguridad/usuario/mostrar_nuevo" id="nuevo_usuario" 
        class="lista_botones">
        <li id="nuevo"> Agregar Profesor </li>
    </ul>
</div>

<br>
<div class="header"><?php echo $titulo ?></div>

<div id="container">
    <div class="demo_jui">
        <table cellpadding="0" cellspacing="0" border="0" class="display" id="usuarios">
            <thead>
                <tr>
                    <th> N </th>
                    <th> APELLIDO<br>PATERNO </th>
                    <th> APELLIDO<br>MATERNO </th>
                    <th> NOMBRES </th>
                    <th> USUARIO </th>
                    <th> ROL </th>
                    <th> CURSO - GRADO - NIVEL </th>
                    <th> ESTADO </th>
                    <th> ACCIONES </th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($lista) {
                    $i = 1;
                    foreach ($lista as $objeto) {
                        $idUsuario = $objeto->USUA_id;
                        $nombreEstado = describir_estado($objeto->USUA_estado);
                ?>
                <tr>
                    <td style="text-align: center"><?=$i?></td>
                    <td style="text-align: justify"><?=$objeto->USUA_apellidoPaterno?></td>
                    <td style="text-align: justify"><?=$objeto->USUA_apellidoMaterno?></td>
                    <td style="text-align: justify"><?=$objeto->USUA_nombres?></td>
                    <td style="text-align: justify"><?=$objeto->USUA_login?></td>
                    <td style="text-align: justify"><?=$objeto->ROL_nombre?></td>
                    <td style="text-align: justify"><?=$objeto->cursos?></td>
                    <td style="text-align: center"><?=$nombreEstado?></td>
                    <td style="text-align: center">
                        <a target="_blank" href="<?=base_url()?>index.php/seguridad/usuario/ver_profesor/<?=$idUsuario?>">
                            <img src="<?=base_url()?>img/ver.png" width="16" border="0" title="Ver Profesor" />
                        </a>&nbsp;&nbsp;
                        <a class="editar_usuario" href="<?=base_url()?>index.php/3_lecturas/usuario/mostrar_editar/<?=$idUsuario?>">
                            <img src="<?=base_url()?>img/modificar.png" width="16" border="0" title="Editar Profesor" />
                        </a>&nbsp;&nbsp;
                <?php
                    if($objeto->USUA_estado == "AC"){
                ?>    
                        <a href="javascript:;" onclick="eliminar_usuario('profesor', <?=$idUsuario?>)">
                            <img src="<?=base_url()?>img/eliminar.png" width="16" border="0" title="Bloquear Profesor" />
                        </a>
                <?php
                    }else{
                ?>
                        <a href="javascript:;" onclick="activar_usuario('profesor', <?=$idUsuario?>)">
                            <img src="<?=base_url()?>img/aprobar.png" width="16" border="0" title="Activar Profesor" />
                        </a>
                <?php
                    }
                ?> 
                    </td>
                </tr>
                <?php
                        $i++;
                    }
                }
                ?>
            </tbody>
            <input type="hidden" name="base_url" id="base_url" value="<?php echo base_url() ?>">
        </table>
    </div>
</div>
<br><br>

<?php
//imprimir($lista);
?>