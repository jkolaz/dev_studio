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
                $('#documentos').dataTable( {
                    "iDisplayLength" : 10
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

        <div id="container">
            <div class="demo_jui">
                <table cellpadding="0" cellspacing="0" border="0" class="display" id="documentos">
                    <thead>
                        <tr>
                            <th> N </th>
                            <th> CURSO </th>
                            <th> DOCUMENTO </th>
                            <th> FECHA DE ENTREGA </th>
                            <th> ESTADO </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($listaDocumentos) {
                            $i = 1;
                            foreach ($listaDocumentos as $objeto) {
                                if ($objeto->DXEN_fechaEntrega) {
                                    $fecha = dame_fecha_estandar($objeto->DXEN_fechaEntrega);
                                    $estado = 'ENTREGADO';
                                } else {
                                    $fecha = '-';
                                    $estado = 'PENDIENTE';
                                }
                                echo '<tr>';
                                echo "<td align='center'>" . $i . '</td>';
                                echo "<td align='left'>" . utf8_encode($objeto->CURS_nombre) . '</td>';
                                echo "<td align='left'>" . utf8_encode($objeto->DOCU_nombre) . '</td>';
                                echo "<td align='center'>" . $fecha . '</td>';
                                echo "<td align='center'>" . $estado . '</td>';
                                echo '</tr>';
                                $i++;
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <input type="hidden" name="base_url" id="base_url" value="<?php echo base_url() ?>">

        <br>

    </body>
</html>

<?php
//imprimir($listaDocumentos);
?>
