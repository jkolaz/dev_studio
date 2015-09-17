<script type="text/javascript" src="<?php echo base_url() ?>js/sistema/rol.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>js/fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>js/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>js/fancybox/jquery.fancybox-1.3.4.css" media="screen" />
<script type="text/javascript">
    $(document).ready( function() {
        base_url   = $("#base_url").val();
        $("#nuevo_rol").click( function() {
            var url = $(this).attr('href');
            location.href = url;
        } ); 
        $(".ver_rol").fancybox( {
            'width'          : 700,
            'height'         : 650,
            'transitionIn'   : 'elastic',
            'transitionOut'  : 'elastic',
            'type'	     : 'iframe'
        } );
    } );
</script>

<br><br>
<div id="botonera">
    <ul href="<?php echo base_url() ?>index.php/seguridad/rol/formulario/nuevo" id="nuevo_rol" 
        class="lista_botones">
        <li id="nuevo"> Agregar Rol </li>
    </ul>
</div>

<br>
<div class="header"><?php echo $titulo ?></div>

<div id="container">
    <div class="demo_jui">
        <table cellpadding="0" cellspacing="0" border="0" class="display" id="roles">
            <thead>
                <tr>
                    <th> N </th>
                    <th> ROL </th>
                    <th> ESTADO </th>
                    <th> ACCIONES </th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($lista) {
                    $i = 1;
                    foreach ($lista as $objeto) {
                        $idRol = $objeto->ROL_id;
                        $nombreEstado = describir_estado($objeto->ROL_estado);
                ?>
                <tr>
                    <td align="center"><?=$i?></td>
                    <td style="text-align: justify; padding-left: 20px;"><?=$objeto->ROL_nombre?></td>
                    <td align="center"><?=$nombreEstado?></td>
                    <td align="center">
                        <a class="ver_rol" href="<?=  base_url()?>index.php/seguridad/rol/ver/<?=$idRol?>">
                            <img src="<?=  base_url()?>img/ver.png" width="16" height="16" border="0" title="Ver Rol">
                        </a>
                        &nbsp;&nbsp;
                        <a class="editar_rol" href="<?=  base_url()?>index.php/seguridad/rol/formulario/editar/<?=$idRol?>">
                            <img src="<?=  base_url()?>img/modificar.png" width="16" height="16" border="0" title="Editar Rol">
                        </a>
                        &nbsp;&nbsp;
                        <?php
                        if($objeto->ROL_estado == "AC"){
                        ?>
                        <a class="editar_rol" href="javascript:;" onclick="eliminar_rol('desactivar', <?=$idRol?>)">
                            <img src="<?=  base_url()?>img/eliminar.png" width="16" height="16" border="0" title="Eliminar Rol">
                        </a>
                        <?php
                        }else{
                        ?>
                        <a class="editar_rol" href="javascript:;" onclick="eliminar_rol('activar', <?=$idRol?>)">
                            <img src="<?=  base_url()?>img/aprobar.png" width="16" height="16" border="0" title="Activar Rol">
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
        </table>
        <input type="hidden" name="base_url" id="base_url" value="<?php echo base_url() ?>">
    </div>
</div>
<br><br>
