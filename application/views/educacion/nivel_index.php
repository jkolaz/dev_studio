<script type="text/javascript" src="<?php echo base_url() ?>js/educacion/nivel.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>js/fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>js/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>js/fancybox/jquery.fancybox-1.3.4.css" media="screen" />
<script type="text/javascript" charset="utf-8">
    $(document).ready( function() {
        $('#niveles').dataTable( {
            "fnFooterCallback": function ( nRow, aaData, iStart, iEnd, aiDisplay ) {
                var totalDeudas = 0;
                var totalAlumnos = 0;
                var totalProfesores = 0;
                var totalTutores = 0;
                var totalAuxiliares = 0;
                for ( var i=iStart ; i<iEnd ; i++ ) {
                    totalDeudas += aaData[ aiDisplay[i] ][2]*1;
                    totalAlumnos += aaData[ aiDisplay[i] ][3]*1;
                    totalProfesores += aaData[ aiDisplay[i] ][4]*1;
                    totalTutores += aaData[ aiDisplay[i] ][5]*1;
                    totalAuxiliares += aaData[ aiDisplay[i] ][6]*1;
                }
                var nCells = nRow.getElementsByTagName('th');
                nCells[1].innerHTML = '<b> S/. ' + parseInt(totalDeudas) + '&nbsp&nbsp</b>';
                nCells[2].innerHTML = '<b>' + parseInt(totalAlumnos) + '&nbsp&nbsp</b>';
                nCells[3].innerHTML = '<b>' + parseInt(totalProfesores) + '&nbsp&nbsp</b>';
                nCells[4].innerHTML = '<b>' + parseInt(totalTutores) + '&nbsp&nbsp</b>';
                nCells[5].innerHTML = '<b>' + parseInt(totalAuxiliares) + '&nbsp&nbsp</b>';
            }
        } );
    } );
</script>
<script type="text/javascript">
    $(document).ready( function() {
        base_url   = $("#base_url").val();
        $("#nivel_nuevo_popup").fancybox( {
            'width'          : 700,
            'height'         : 650,
            'transitionIn'   : 'elastic',
            'transitionOut'  : 'elastic',
            'type'	     : 'iframe'
        } );
        $(".nivel_editar_popup").fancybox( {
            'width'          : 700,
            'height'         : 650,
            'transitionIn'   : 'elastic',
            'transitionOut'  : 'elastic',
            'type'	     : 'iframe'
        } );
        $(".nivel_ver_popup").fancybox( {
            'width'          : 800,
            'height'         : 450,
            'transitionIn'   : 'elastic',
            'transitionOut'  : 'elastic',
            'type'	     : 'iframe'
        } );
        $(".nivel_mensajes_popup").fancybox( {
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
    <ul href="<?php echo base_url() ?>index.php/educacion/nivel/mostrar_nuevo" id="nivel_nuevo_popup" 
        class="lista_botones">
        <li id="nuevo"> Agregar Nivel </li>
    </ul>
</div>

<br>
<div class="header"><?php echo $titulo ?></div>

<div id="container">
    <div class="demo_jui">
        <table cellpadding="0" cellspacing="0" border="0" class="display" id="niveles">
            <thead>
                <tr>
                    <th> N </th>
                    <th> NIVEL </th>
                    <th> DEUDAS (S/.)</th>
                    <th> ALUMNOS </th>
                    <th> PROFESORES </th>
                    <th> TUTORES </th>
                    <th> AUXILIARES </th>
                    <th> ACCIONES </th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($lista) {
                    $i = 1;
                    foreach ($lista as $objeto) {
                        $idNivel = $objeto->NIVE_id;
                        $nombreEstado = describir_estado($objeto->NIVE_estado);
                        echo '<tr>';
                        echo "<td align='center'>" . $i . '</td>';
                        echo "<td align='left'>" . $objeto->NIVE_nombre . '</td>';
                        echo "<td align='right'>" . $objeto->NIVE_deudas . '</td>';
                        echo "<td align='right'>" . $objeto->NIVE_alumnos . '</td>';
                        echo "<td align='right'>" . $objeto->NIVE_profesores . '</td>';
                        echo "<td align='right'>" . $objeto->NIVE_tutores . '</td>';
                        echo "<td align='right'>" . $objeto->NIVE_auxiliares . '</td>';
                        
                        echo "<td align='center'>";
                        echo "<a class='nivel_ver_popup' href='" . base_url() . "index.php/educacion/nivel/ver/"
                        . $idNivel . "' ><img src='" . base_url()
                        . "img/ver.png' width='16' height='16' border='0' title='Ver Nivel' /></a>";
                        echo '&nbsp;&nbsp;';
                        echo "<a class='nivel_mensajes_popup' href='" . base_url() . "index.php/educacion/nivel/mensajes/"
                        . $idNivel . "' ><img src='" . base_url()
                        . "img/mensajes.png' width='16' height='16' border='0' title='Ver Observaciones' /></a>";
                        echo '&nbsp;&nbsp;';
                        echo "<a class='nivel_editar_popup' href='" . base_url() . "index.php/educacion/nivel/mostrar_editar/"
                        . $idNivel . "' ><img src='" . base_url()
                        . "img/modificar.png' width='16' height='16' border='0' title='Modificar Nivel' /></a>";
                        echo '&nbsp;&nbsp;';
                        echo "<a href='#' onclick='eliminar_nivel(" . $idNivel
                        . ")'><img src='" . base_url()
                        . "img/eliminar.png' border='0' width='17' height='17' title='Eliminar Nivel' /></a>";
                        echo '</td>';

                        echo '</tr>';
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
                    <th align="right"></th>
                    <th align="right"></th>
                </tr>
            </tfoot>
        </table>
        <input type="hidden" name="base_url" id="base_url" value="<?php echo base_url() ?>">
    </div>
</div>
<br><br>
