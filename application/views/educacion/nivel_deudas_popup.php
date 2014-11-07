<html>
    <head>
        <script type="text/javascript" src="<?php echo base_url() ?>js/jquery.js"></script>        
        <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>css/estilos.css" media="screen" />

        <link rel="stylesheet" href="<?php echo base_url() ?>js/datatable/media/css/demo_page.css" type="text/css" />
        <link rel="stylesheet" href="<?php echo base_url() ?>js/datatable/media/css/demo_table_jui.css" type="text/css" />
        <link rel="stylesheet" href="<?php echo base_url() ?>js/datatable/examples/examples_support/themes/smoothness/jquery-ui-1.8.4.custom.css" type="text/css" />
        <script type="text/javascript" language="javascript" src="<?php echo base_url() ?>js/datatable/media/js/jquery.dataTables.js"></script>

        <script type="text/javascript" charset="utf-8">
            $(document).ready( function() {
                $('#grados').dataTable( {
                    "iDisplayLength" : 10,
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
    </head>
    <body>

        <div align="center">
            <b><?php echo $titulo ?></b>
        </div>
        <br>

        <div id="container">
            <div class="demo_jui">
                <table cellpadding="0" cellspacing="0" border="0" class="display" id="grados">
                    <thead>
                        <tr>
                            <th> N </th>
                            <th> GRADO </th>
                            <th> DEUDAS (S/.) </th>
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
                                $idGrado = $objeto->GRAD_id;
                                $nombreGrado = utf8_encode($objeto->GRAD_nombre . ' (' . $objeto->GRAD_abreviatura . ')');

                                echo '<tr>';
                                echo "<td align='center'>" . $i . '</td>';
                                echo "<td align='left'>" . $nombreGrado . '</td>';
                                echo "<td align='right'>" . $objeto->GRAD_deudas . '</td>';
                                echo "<td align='right'>" . $objeto->GRAD_alumnos . '</td>';
                                echo "<td align='right'>" . $objeto->GRAD_profesores . '</td>';
                                echo "<td align='right'>" . $objeto->GRAD_tutores . '</td>';
                                echo "<td align='right'>" . $objeto->GRAD_auxiliares . '</td>';

                                echo "<td align='center'>";
                                echo "<a target='_blank' href='" . base_url() . 'index.php/educacion/grado/ver/' . $idGrado . "' >";
                                echo "<img src='" . base_url() . "img/ver.png' width='16' height='16' border='0' title='Ver Detalle' />";
                                echo "</a>";
                                echo '&nbsp;&nbsp;';
                                echo "<a class='nivel_mensajes_popup' href='" . base_url() . "index.php/educacion/nivel/mensajes/"
                                . $idGrado . "' ><img src='" . base_url()
                                . "img/mensajes.png' width='16' height='16' border='0' title='Ver Observaciones' /></a>";
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
            </div>
        </div>
        <input type="hidden" name="base_url" id="base_url" value="<?php echo base_url() ?>">

        <?php
//        if ($lista) {
//            echo "<table width='95%' align='center' border=1 cellpadding=2 cellspacing=0 class='tablaLineaSimple'>";
//            echo "<thead class='cabeceraTablaInicio'>";
//            echo "<tr align='center'>";
//            echo "<td width='3%'><b> N </b></td>";
//            echo "<td width='15%'><b> GRADO </b></td>";
//            echo "<td width='15%'><b> DEUDAS (S/.) </b></td>";
//            echo "<td width='8%'><b> ALUMNOS </b></td>";
//            echo "<td width='8%'><b> PROFESORES </b></td>";
//            echo "<td width='8%'><b> TUTORES </b></td>";
//            echo "<td width='8%'><b> AUXILIARES </b></td>";
//            echo '</tr>';
//            echo '</thead>';
//            $i = 1;
//            foreach ($lista as $objeto) {
//                $idGrado = $objeto->GRAD_id;
//                $nombreGrado = utf8_encode($objeto->GRAD_nombre . ' (' . $objeto->GRAD_abreviatura . ')');
//                echo '<tr>';
//                echo "<td align='center'>$i</td>";
//                echo "<td align='left'>" . $nombreGrado . '</td>';
//                echo "<td align='right'>" . $objeto->GRAD_deudas . '</td>';
//                echo "<td align='right'>" . $objeto->GRAD_alumnos . '</td>';
//                echo "<td align='right'>" . $objeto->GRAD_profesores . '</td>';
//                echo "<td align='right'>" . $objeto->GRAD_tutores . '</td>';
//                echo "<td align='right'>" . $objeto->GRAD_auxiliares . '</td>';
//                echo '<tr>';
//
//                $i++;
//            }
//            
//            echo '<tr>';
//            echo '<td></td>';
//            echo "<td align='right'>Total :</td>";
//            echo "<td align='right'><b>" . $objeto->NIVE_deudas . "</b></td>";
//            echo "<td align='right'><b>" . $objeto->NIVE_alumnos . "</b></td>";
//            echo "<td align='right'><b>" . $objeto->NIVE_profesores . "</b></td>";
//            echo "<td align='right'><b>" . $objeto->NIVE_tutores . "</b></td>";
//            echo "<td align='right'><b>" . $objeto->NIVE_auxiliares . "</b></td>";
//            echo '</tr>';
//            
//            echo '</table>';
//        }
        ?>

        <br>

    </body>
</html>
