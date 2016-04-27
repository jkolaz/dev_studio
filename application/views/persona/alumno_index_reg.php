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
        $("#nuevo_usuario").click( function(){
            var url = $(this).attr('href');
            location.href = url;
        });
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
        $(".ver_padres").fancybox( {
            'width'          : 800,
            'height'         : 500,
            'transitionIn'   : 'elastic',
            'transitionOut'  : 'elastic',
            'type'	     : 'iframe'
        } );
        $(".ver_pagos").fancybox( {
            'width'          : 850,
            'height'         : 500,
            'transitionIn'   : 'elastic',
            'transitionOut'  : 'elastic',
            'type'	     : 'iframe'
        } );
    } );
</script>

<br><br>
<div id="botonera">
    <ul href="<?php echo base_url() ?>index.php/seguridad/usuario/alumnonuevo" id="nuevo_usuario" 
        class="lista_botones">
        <li id="nuevo"> Agregar Alumno </li>
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
                    <th> CÓDIGO </th>
                    <th> APELLIDO<br>PATERNO </th>
                    <th> APELLIDO<br>MATERNO </th>
                    <th> NOMBRES </th>
                    <th> USUARIO </th>
                    <!--<th> ROL </th>-->
                    <th> PADRES </th>
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
                    <td style="text-align: center"><?=$objeto->USUA_codigo?></td>
                    <td style="text-align: left"><?=$objeto->USUA_apellidoPaterno?></td>
                    <td style="text-align: left"><?=$objeto->USUA_apellidoMaterno?></td>
                    <td style="text-align: left"><?=$objeto->USUA_nombres?></td>
                    <td style="text-align: left"><?=$objeto->USUA_login?></td>
                    <td style="text-align: center">
                        <a class="ver_padres" href="<?=base_url()?>index.php/seguridad/usuario/ver_padres/<?=$idUsuario?>">
                            <img src="<?=base_url()?>img/usuarios.png" width="16" height="16" border="0" title="<?=str_replace('<br>', '#', $objeto->padres)?>"/>
                        </a>
                    </td>
                    <td style="text-align: center">
                        <a class="ver_pagos" href="<?=base_url()?>index.php/seguridad/usuario/ver_pagos/<?=$idUsuario?>">
                            <?=$nombreEstado?>
                        </a>
                    </td>
                    <td style="text-align: center">
                        <a href="<?=base_url()?>index.php/seguridad/usuario/ver_user/<?=$idUsuario?>">
                            <img src="<?=base_url()?>img/ver.png" width="16" height="16" border="0" title="Ver usuario"/>
                        </a>
                        &nbsp;&nbsp;
                        <a class="editar_usuarios" href="<?=base_url()?>index.php/3_lecturas/usuario/mostrar_editar/<?=$idUsuario?>">
                            <img src="<?=base_url()?>img/modificar.png" width="16" height="16" border="0" title="Modificar usuario"/>
                        </a>
                        &nbsp;&nbsp;
                        <a href="#" onclick="eliminar_usuario(<?=$idUsuario?>)">
                            <img src="<?=base_url()?>img/eliminar.png" width="16" height="16" border="0" title="Eliminar usuario"/>
                        </a>
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
