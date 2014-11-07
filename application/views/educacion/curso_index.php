<script type="text/javascript" src="<?php echo base_url() ?>js/educacion/grado.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>js/fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>js/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>js/fancybox/jquery.fancybox-1.3.4.css" media="screen" />
<script type="text/javascript" charset="utf-8">
    $(document).ready( function() {
        $('#cursos').dataTable( {
            "fnFooterCallback": function ( nRow, aaData, iStart, iEnd, aiDisplay ) {
                var totalHoras = 0;
                for ( var i=iStart ; i<iEnd ; i++ ) {
                    totalHoras += aaData[ aiDisplay[i] ][4]*1;
                }
                var nCells = nRow.getElementsByTagName('th');
                nCells[1].innerHTML = '<b>' + parseInt(totalHoras) + '&nbsp&nbsp</b>';
            }
        } );
    } );
</script>
<script type="text/javascript">
    $(document).ready( function() {
        base_url   = $("#base_url").val();
        $("#nuevo_curso").fancybox( {
            'width'          : 700,
            'height'         : 650,
            'transitionIn'   : 'elastic',
            'transitionOut'  : 'elastic',
            'type'	     : 'iframe'
        } );
        $(".editar_curso").fancybox( {
            'width'          : 700,
            'height'         : 650,
            'transitionIn'   : 'elastic',
            'transitionOut'  : 'elastic',
            'type'	     : 'iframe'
        } ); 
        $(".ver_curso").fancybox( {
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
    <ul href="<?php echo base_url() ?>index.php/educacion/curso/mostrar_nuevo" id="nuevo_curso" 
        class="lista_botones">
        <li id="nuevo"> Agregar Curso </li>
    </ul>
</div>

<br>
<div class="header"><?php echo $titulo ?></div>

<div id="container">
    <div class="demo_jui">
        <table cellpadding="0" cellspacing="0" border="0" class="display" id="cursos">
            <thead>
                <tr>
                    <th> N </th>
                    <th> NIVEL </th>
                    <th> GRADO </th>
                    <th> CURSO </th>
                    <th> HORAS </th>
                    <th> PROFESORES </th>
                    <th> ESTADO </th>
                    <th> ACCIONES </th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($lista) {
                    $i = 1;
                    foreach ($lista as $objeto) {
                        $idCurso = $objeto->CURS_id;
                        $nombreEstado = describir_estado($objeto->CURS_estado);
                        echo '<tr>';
                        echo "<td align='center'>" . $i . '</td>';
                        echo "<td align='center'>" . $objeto->NIVE_nombre . '</td>';
                        echo "<td align='center'>" . $objeto->GRAD_nombre . '</td>';
                        echo "<td align='left'>" . utf8_encode($objeto->CURS_nombre) . '</td>';
                        echo "<td align='center'>" . $objeto->CURS_horas . '</td>';
                        echo "<td align='center'>" . $objeto->profesores . '</td>';
                        echo "<td align='center'>" . $nombreEstado . '</td>';

                        echo "<td align='center'>";
                        echo "<a class='ver_curso' href='" . base_url() . "index.php/educacion/curso/ver/"
                        . $idCurso . "' ><img src='" . base_url()
                        . "img/ver.png' width='16' height='16' border='0' title='Ver Curso' /></a>";
                        echo '&nbsp;&nbsp;';
                        echo "<a class='editar_curso' href='" . base_url() . "index.php/educacion/curso/mostrar_editar/"
                        . $idCurso . "' ><img src='" . base_url()
                        . "img/modificar.png' width='16' height='16' border='0' title='Modificar Curso' /></a>";
                        echo '&nbsp;&nbsp;';
                        echo "<a href='#' onclick='eliminar_curso(" . $idCurso
                        . ")'><img src='" . base_url()
                        . "img/eliminar.png' border='0' width='17' height='17' title='Eliminar Curso' /></a>";
                        echo '</td>';

                        echo '</tr>';
                        $i++;
                    }
                }
                ?>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="4" align="right"> Total : </th>
                    <th align="center"></th>
                    <th align="center"></th>
                    <th align="center"></th>
                    <th align="center"></th>
                </tr>
            </tfoot>
        </table>
        <input type="hidden" name="base_url" id="base_url" value="<?php echo base_url() ?>">
    </div>
</div>
<br><br>

<?php
//imprimir($lista);
?>
