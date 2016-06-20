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
    <ul href="<?php echo base_url() ?>index.php/matricula/matricula/newMatricula" id="nuevo_usuario" 
        class="lista_botones">
        <li id="nuevo"> Nueva Matricula </li>
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
                    <th> DNI </th>
                    <!--<th> ROL </th>-->
                    <th> GRADO </th>
                    <th> NIVEL </th>
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
                        echo '<tr>';
                        echo "<td align='center'>" . $i . '</td>';
                        echo "<td align='left'>" . $objeto->USUA_apellidoPaterno . '</td>';
                        echo "<td align='left'>" . $objeto->USUA_apellidoMaterno . '</td>';
                        echo "<td align='left'>" . $objeto->USUA_nombres . '</td>';
                        echo "<td align='center'>" . $objeto->USUA_dni . '</td>';
//                        echo "<td align='center'>" . utf8_encode($objeto->ROL_nombre) . '</td>';
                        echo "<td align='center'>" . $objeto->GRAD_abreviatura . '</td>';
                        echo "<td align='center'>" . $objeto->NIVE_abreviatura . '</td>';

                        echo "<td align='center'>";
                        echo "<a class='ver_padres' href='" . base_url()
                        . "index.php/seguridad/usuario/ver_padres/"
                        . $idUsuario . "' ><img src='" . base_url()
                        . "img/usuarios.png' width='16' height='16' border='0' title='"
                        . str_replace('<br>', ' # ', $objeto->padres) . "' /></a>";
                        echo '</td>';

                        echo "<td align='center'>";
                        echo "<a class='ver_pagos' href='" . base_url()
                        . "index.php/seguridad/usuario/ver_pagos/" . $idUsuario . "' > $nombreEstado </a>";
                        echo '</td>';

                        echo "<td align='center'>";
                        echo "<a target='_blank' href='" . base_url()
                        . "index.php/seguridad/usuario/ver_user/"
                        . $idUsuario . "' ><img src='" . base_url()
                        . "img/ver.png' width='16' height='16' border='0' title='Ver Usuario' /></a>";
                        echo '&nbsp;&nbsp;';
                        echo "<a class='editar_usuario' href='" . base_url()
                        . "index.php/3_lecturas/usuario/mostrar_editar/"
                        . $idUsuario . "' ><img src='" . base_url()
                        . "img/modificar.png' width='16' height='16' border='0' title='Modificar Usuario' /></a>";
                        echo '&nbsp;&nbsp;';
                        echo "<a href='#' onclick='eliminar_usuario(" . $idUsuario
                        . ")'><img src='" . base_url()
                        . "img/eliminar.png' border='0' width='17' height='17' title='Eliminar Usuario' /></a>";
                        echo '</td>';

                        echo '</tr>';
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
