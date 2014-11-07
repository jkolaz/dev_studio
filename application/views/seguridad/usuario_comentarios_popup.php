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
                $('#observaciones').dataTable( {
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
                <table cellpadding="0" cellspacing="0" border="0" class="display" id="observaciones">
                    <thead>
                        <tr>
                            <th> N </th>
                            <th> OBSERVACIÓN </th>
                            <th> FECHA </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($listaObservaciones) {
                            $i = 1;
                            foreach ($listaObservaciones as $var) {
                                echo '<tr>';
                                echo "<td align='center'>" . $i . '</td>';
                                echo "<td align='left'>" . utf8_encode($var['texto']) . '</td>';
                                echo "<td align='center'>" . $var['fecha'] . '</td>';
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
