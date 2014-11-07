<html>
    <head>
        <script type="text/javascript" src="<?php echo base_url() ?>js/jquery.js"></script>        
        <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>css/estilos.css" media="screen" />
    </head>
    <body>

        <div align="center">
            <b><?php echo 'Primer Parcial' ?></b>
        </div>
        <br>

        <?php
        if (array_key_exists(1, $DETALLE) && $DETALLE[1]) {
            echo "<table width='95%' align='center' border=1 cellpadding=2 cellspacing=0 class='tablaLineaSimple'>";
            echo "<thead class='cabeceraTablaInicio'>";
            echo "<tr align='center'>";
            echo "<td width='10%'><b> N </b></td>";
            echo "<td width='60%'><b> CRITERIO </b></td>";
            echo "<td width='25%'><b> NOTA </b></td>";
            echo '</tr>';
            echo '</thead>';
            $i = 1;
            foreach ($DETALLE[1] as $idCriterio => $nota) {
                echo '<tr>';
                echo "<td align='center'>$i</td>";
                echo "<td align='left'>" . utf8_encode($CRITERIOS[$idCriterio]) . '</td>';
                echo "<td align='center'>$nota</td>";
                echo '<tr>';
                $i++;
            }
            echo '<tr>';
            echo "<td align='right' colspan=2> Promedio : </td>";
            echo "<td align='center'><b>" . round(array_sum($DETALLE[1]) / sizeof($DETALLE[1])) . '</b></td>';
            echo '</tr>';
            echo '</table>';
        }
        ?>
        <br><br>

        <div align="center">
            <b><?php echo 'Segundo Parcial' ?></b>
        </div>
        <br>
        <?php
        if (array_key_exists(2, $DETALLE) && $DETALLE[2]) {
            echo "<table width='95%' align='center' border=1 cellpadding=2 cellspacing=0 class='tablaLineaSimple'>";
            echo "<thead class='cabeceraTablaInicio'>";
            echo "<tr align='center'>";
            echo "<td width='10%'><b> N </b></td>";
            echo "<td width='60%'><b> CRITERIO </b></td>";
            echo "<td width='25%'><b> NOTA </b></td>";
            echo '</tr>';
            echo '</thead>';
            $i = 1;
            foreach ($DETALLE[2] as $idCriterio => $nota) {
                echo '<tr>';
                echo "<td align='center'>$i</td>";
                echo "<td align='left'>" . utf8_encode($CRITERIOS[$idCriterio]) . '</td>';
                echo "<td align='center'>$nota</td>";
                echo '<tr>';
                $i++;
            }
            echo '<tr>';
            echo "<td align='right' colspan=2> Promedio : </td>";
            echo "<td align='center'><b>" . round(array_sum($DETALLE[2]) / sizeof($DETALLE[2])) . '</b></td>';
            echo '</tr>';
            echo '</table>';
        }
        ?>

    </body>
</html>

<?php
//imprimir($CRITERIOS);
//imprimir($DETALLE);
?>
