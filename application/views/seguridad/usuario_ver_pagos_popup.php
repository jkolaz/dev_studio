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
                $('#pagos').dataTable( {
                    //                    "iDisplayLength" : 10,
                    "fnFooterCallback": function ( nRow, aaData, iStart, iEnd, aiDisplay ) {
                        var totalProgramado = 0;
                        var totalCancelado = 0;
                        var totalRetrazado = 0;
                        var totalPendiente = 0;
                        var totalDiasMora = 0;
                        var totalMontoMora = 0;
                        for ( var i=iStart ; i<iEnd ; i++ ) {
                            totalProgramado += aaData[ aiDisplay[i] ][1]*1;
                            totalDiasMora += aaData[ aiDisplay[i] ][4]*1;
                            totalMontoMora += aaData[ aiDisplay[i] ][5]*1;
                            totalCancelado += aaData[ aiDisplay[i] ][6]*1;
                            totalRetrazado += aaData[ aiDisplay[i] ][7]*1;
                            totalPendiente += aaData[ aiDisplay[i] ][8]*1;
                        }
                        var nCells = nRow.getElementsByTagName('th');
                        nCells[1].innerHTML = '<b> S/. ' + parseInt(totalProgramado) + '&nbsp&nbsp</b>';
                        nCells[4].innerHTML = '<b>' + parseInt(totalDiasMora) + '&nbsp&nbsp</b>';
                        nCells[5].innerHTML = '<b> S/. ' + parseInt(totalMontoMora) + '&nbsp&nbsp</b>';
                        nCells[6].innerHTML = '<b> S/. ' + parseInt(totalCancelado) + '&nbsp&nbsp</b>';
                        nCells[7].innerHTML = '<b> S/. ' + parseInt(totalRetrazado) + '&nbsp&nbsp</b>';
                        nCells[8].innerHTML = '<b> S/. ' + parseInt(totalPendiente) + '&nbsp&nbsp</b>';
                    }
                } );
            } );
        </script>
    </head>
    <body>

        <br>
        <div align="center">
            <b><?php echo $titulo ?></b>
        </div>
        <br>
        
        <div align="center">
            <table width="70%" border="0">
                <tr>
                    <td> ALUMNO : </td>
                    <td><b><?php echo formar_nombre_completo($alumno) ?></b></td>
                    <td> &nbsp; </td>
                    <td> CÓDIGO : </td>
                    <td><b><?php echo $alumno->USUA_codigo ?></b></td>
                    <td> &nbsp; </td>
                    <td> ESTADO : </td>
                    <td><b><?php echo describir_estado($alumno->USUA_estado) ?></b></td>
                </tr>
            </table>
        </div>
        <br>

        <div id="container">
            <div class="demo_jui">
                <table cellpadding="0" cellspacing="0" border="0" class="display" id="pagos">
                    <thead>
                        <tr>
                            <th> CUOTA </th>
                            <th> MONTO<br>PROGRAMADO </th>
                            <th> FECHA<br>VENCIMIENTO </th>
                            <th> FECHA<br>PAGO </th>
                            <th> DIAS<br>MORA </th>
                            <th> MONTO<br>MORA </th>
                            <th> PAGADO </th>
                            <th> RETRAZADO </th>
                            <th> PENDIENTE </th>
                            <!--<th> ESTADO </th>-->
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($lista) {
                            $i = 1;
                            foreach ($lista as $objeto) {
                                $fechaPago = $objeto->PAGO_fechaPago;
                                if (!$fechaPago)
                                    $fechaPago = date('Y-m-d');
                                $diasMora = dias_entre_fechas($objeto->CUOT_fechaVencimiento, $fechaPago);
                                $montoMora = $diasMora * $objeto->CUOT_moraDiaria;

                                $total = $objeto->PAGO_montoReal;
                                
                                $montoRetrazado = 0;
                                $montoPendiente = 0;
                                if (!$total) {
                                    if ($objeto->PAGO_estado=='RE')
                                        $montoRetrazado = $objeto->PAGO_montoProgramado + $montoMora;
                                    elseif ($objeto->PAGO_estado=='PE')
                                        $montoPendiente = $objeto->PAGO_montoProgramado;
                                }
                                echo '<tr>';
                                echo "<td align='center'>" . $objeto->CUOT_numero . '</td>';
                                echo "<td align='right'>" . number_format($objeto->PAGO_montoProgramado, 2) . '</td>';
                                echo "<td align='center'>" . dame_fecha_estandar($objeto->CUOT_fechaVencimiento) . '</td>';
                                echo "<td align='center'>" . dame_fecha_estandar($objeto->PAGO_fechaPago) . '</td>';
                                echo "<td align='right'>" . $diasMora . '</td>';
                                echo "<td align='right'>" . number_format($montoMora, 2) . '</td>';
                                
                                echo "<td align='right'>" . number_format($total, 2) . '</td>';
                                echo "<td align='right'>" . number_format($montoRetrazado, 2) . '</td>';
                                echo "<td align='right'>" . number_format($montoPendiente, 2) . '</td>';
                                
//                                echo "<td align='center'>" . describir_estado($objeto->PAGO_estado) . '</td>';
                                echo '</tr>';

                                $i++;
                            }
                        }
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th align="right"> Total : </th>
                            <th align="right"></th>
                            <th align="right"></th>
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

        <br>

    </body>
</html>

<?php
//imprimir($alumno);
//imprimir($lista);
?>
