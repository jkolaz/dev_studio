<script type="text/javascript" src="<?php echo base_url() ?>js/sistema/rol.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>js/fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>js/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>js/fancybox/jquery.fancybox-1.3.4.css" media="screen" />
<script type="text/javascript" charset="utf-8">
    $(document).ready( function() {
        oTable = $('#roles').dataTable( {
        } );
    } );
</script>
<script type="text/javascript">
    $(document).ready( function() {
        base_url   = $("#base_url").val();
        $("#nuevo_rol").fancybox( {
            'width'          : 700,
            'height'         : 650,
            'transitionIn'   : 'elastic',
            'transitionOut'  : 'elastic',
            'type'	     : 'iframe'
        } );
        $(".editar_rol").fancybox( {
            'width'          : 700,
            'height'         : 650,
            'transitionIn'   : 'elastic',
            'transitionOut'  : 'elastic',
            'type'	     : 'iframe'
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
    <ul href="<?php echo base_url() ?>index.php/seguridad/rol/mostrar_nuevo" id="nuevo_rol" 
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
                        echo '<tr>';
                        echo "<td align='center'>" . $i . '</td>';
                        echo "<td align='center'>" . $objeto->ROL_nombre . '</td>';
                        echo "<td align='center'>" . $nombreEstado . '</td>';

                        echo "<td align='center'>";
                        echo "<a class='ver_rol' href='" . base_url() . "index.php/seguridad/rol/ver/"
                        . $idRol . "' ><img src='" . base_url()
                        . "img/ver.png' width='16' height='16' border='0' title='Ver Rol' /></a>";
                        echo '&nbsp;&nbsp;';
                        echo "<a class='editar_rol' href='" . base_url() . "index.php/seguridad/rol/mostrar_editar/"
                        . $idRol . "' ><img src='" . base_url()
                        . "img/modificar.png' width='16' height='16' border='0' title='Modificar Rol' /></a>";
                        echo '&nbsp;&nbsp;';
                        echo "<a href='#' onclick='eliminar_rol(" . $idRol
                        . ")'><img src='" . base_url()
                        . "img/eliminar.png' border='0' width='17' height='17' title='Eliminar Rol' /></a>";
                        echo '&nbsp;&nbsp;';
                        echo "<a href='" . base_url() . "index.php/seguridad/permiso/permisos/"
                                . $idRol . "' ><img src='" . base_url()
                                . "img/calendar.png' width='16' height='16' border='0' title='Permisos' /></a></td>";
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
