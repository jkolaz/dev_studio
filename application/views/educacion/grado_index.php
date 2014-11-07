<script type="text/javascript" src="<?php echo base_url() ?>js/educacion/grado.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>js/fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>js/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>js/fancybox/jquery.fancybox-1.3.4.css" media="screen" />
<script type="text/javascript" charset="utf-8">
    $(document).ready( function() {
        $('#grados').dataTable( {
        } );
    } );
</script>
<script type="text/javascript">
    $(document).ready( function() {
        base_url   = $("#base_url").val();
        $("#nuevo_grado").fancybox( {
            'width'          : 700,
            'height'         : 650,
            'transitionIn'   : 'elastic',
            'transitionOut'  : 'elastic',
            'type'	     : 'iframe'
        } );
        $(".editar_grado").fancybox( {
            'width'          : 700,
            'height'         : 650,
            'transitionIn'   : 'elastic',
            'transitionOut'  : 'elastic',
            'type'	     : 'iframe'
        } ); 
        $(".ver_grado").fancybox( {
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
    <ul href="<?php echo base_url() ?>index.php/educacion/grado/mostrar_nuevo" id="nuevo_grado" 
        class="lista_botones">
        <li id="nuevo"> Agregar Grado </li>
    </ul>
</div>

<br>
<div class="header"><?php echo $titulo ?></div>

<div id="container">
    <div class="demo_jui">
        <table cellpadding="0" cellspacing="0" border="0" class="display" id="grados">
            <thead>
                <tr>
                    <th> N </th>
                    <th> GRADO </th>
                    <th> NIVEL </th>
                    <th> ESTADO </th>
                    <th> ACCIONES </th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($lista) {
                    $i = 1;
                    foreach ($lista as $objeto) {
                        $idGrado = $objeto->GRAD_id;
                        $nombreGrado = utf8_encode($objeto->GRAD_nombre . ' (' . $objeto->GRAD_abreviatura . ')');
                        $nombreEstado = describir_estado($objeto->GRAD_estado);
                        echo '<tr>';
                        echo "<td align='center'>" . $i . '</td>';
                        echo "<td align='center'>" . $nombreGrado . '</td>';
                        echo "<td align='center'>" . $objeto->NIVE_nombre . '</td>';
                        echo "<td align='center'>" . $nombreEstado . '</td>';
                        echo "<td align='center'>";
                        echo "<a class='ver_grado' href='" . base_url() . "index.php/educacion/grado/ver/"
                        . $idGrado . "' ><img src='" . base_url()
                        . "img/ver.png' width='16' height='16' border='0' title='Ver Grado' /></a>";
                        echo '&nbsp;&nbsp;';
                        echo "<a class='editar_grado' href='" . base_url() . "index.php/educacion/grado/mostrar_editar/"
                        . $idGrado . "' ><img src='" . base_url()
                        . "img/modificar.png' width='16' height='16' border='0' title='Modificar Grado' /></a>";
                        echo '&nbsp;&nbsp;';
                        echo "<a href='#' onclick='eliminar_grado(" . $idGrado
                        . ")'><img src='" . base_url()
                        . "img/eliminar.png' border='0' width='17' height='17' title='Eliminar Grado' /></a>";
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
