<html>
    <head>
        <script type="text/javascript" src="<?php echo base_url() ?>js/jquery.js"></script>        
        <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>css/estilos.css" media="screen" />
    </head>
    <body>
        
        <?php
//        imprimir($listaPadres);
        ?>

        <br>
        <div align="center">
            <b><?php echo $titulo ?></b>
        </div>
        <br>
        <?php
        if ($listaPadres) {
            echo "<table width='95%' align='center' border=1 cellpadding=2 cellspacing=0 class='tablaLineaSimple'>";

            echo "<thead class='cabeceraTablaInicio'>";
            echo "<tr align='center'>";
            echo "<td width='25%'><b>  </b></td>";
            echo "<td><b> PADRE </b></td>";
            echo "<td><b> MADRE </b></td>";
            echo '</tr>';
            echo '</thead>';

            echo '<tr>';
            echo "<td align='center' class='cabeceraTablaInicio'><b> NOMBRES : </b></td>";
            $listaPadres->padre ? $nombrePadre = formar_nombre_completo($listaPadres->padre): $nombrePadre = '-';
            echo "<td align='center'>" . $nombrePadre . "</td>";
            $listaPadres->madre ? $nombreMadre = formar_nombre_completo($listaPadres->madre): $nombreMadre = '-';
            echo "<td align='center'>" . $nombreMadre . "</td>";
            echo '</tr>';

            echo '<tr>';
            echo "<td align='center' class='cabeceraTablaInicio'><b> USUARIO : </b></td>";
            $listaPadres->padre ? $loginPadre = $listaPadres->padre->USUA_login : $loginPadre = '-';
            echo "<td align='center'>" . $loginPadre . "</td>";
            $listaPadres->madre ? $loginMadre = $listaPadres->madre->USUA_login : $loginMadre = '-';
            echo "<td align='center'>" . $loginMadre . "</td>";
            echo '</tr>';

            echo '<tr>';
            echo "<td align='center' class='cabeceraTablaInicio'><b> DNI : </b></td>";
            $listaPadres->padre ? $dniPadre = $listaPadres->padre->USUA_dni : $dniPadre = '-';
            echo "<td align='center'>" . $dniPadre . "</td>";
            $listaPadres->madre ? $dniMadre = $listaPadres->madre->USUA_dni : $dniMadre = '-';
            echo "<td align='center'>" . $dniMadre . "</td>";
            echo '</tr>';

            echo '<tr>';
            echo "<td align='center' class='cabeceraTablaInicio'><b> TELÉFONOS : </b></td>";
            $listaPadres->padre ? $telefonosPadre = $listaPadres->padre->USUA_telefonos : $telefonosPadre = '-';
            echo "<td align='center'>" . $telefonosPadre . "</td>";
            $listaPadres->madre ? $telefonosMadre = $listaPadres->madre->USUA_telefonos : $telefonosMadre = '-';
            echo "<td align='center'>" . $telefonosMadre . "</td>";
            echo '</tr>';

            echo '<tr>';
            echo "<td align='center' class='cabeceraTablaInicio'><b> EMAIL : </b></td>";
            $listaPadres->padre ? $emailPadre = $listaPadres->padre->USUA_email : $emailPadre = '-';
            echo "<td align='center'>" . $emailPadre . "</td>";
            $listaPadres->madre ? $emailMadre = $listaPadres->madre->USUA_email : $emailMadre = '-';
            echo "<td align='center'>" . $emailMadre . "</td>";
            echo '</tr>';
            
            echo '<tr>';
            echo "<td align='center' class='cabeceraTablaInicio'><b> FECHA REGISTRO : </b></td>";
            $listaPadres->padre ? $registroPadre = $listaPadres->padre->USUA_fechaRegistro : $registroPadre = '-';
            echo "<td align='center'>" . $registroPadre . "</td>";
            $listaPadres->madre ? $registroMadre = $listaPadres->madre->USUA_fechaRegistro : $registroMadre = '-';
            echo "<td align='center'>" . $registroMadre . "</td>";
            echo '</tr>';
            
            echo '<tr>';
            echo "<td align='center' class='cabeceraTablaInicio'><b> FECHA ÚLTIMA MODIF : </b></td>";
            $listaPadres->padre ? $modificacionPadre = $listaPadres->padre->USUA_fechaModificacion : $modificacionPadre = '-';
            echo "<td align='center'>" . $modificacionPadre . "</td>";
            $listaPadres->madre ? $modificacionMadre = $listaPadres->madre->USUA_fechaModificacion : $modificacionMadre = '-';
            echo "<td align='center'>" . $modificacionMadre . "</td>";
            echo '</tr>';
            
            echo '<tr>';
            echo "<td align='center' class='cabeceraTablaInicio'><b> ESTADO : </b></td>";
            $listaPadres->padre ? $estadoPadre = describir_estado($listaPadres->padre->USUA_estado) : $estadoPadre = '-';
            echo "<td align='center'>" . $estadoPadre . "</td>";
            $listaPadres->madre ? $estadoMadre = describir_estado($listaPadres->madre->USUA_estado) : $estadoMadre = '-';
            echo "<td align='center'>" . $estadoMadre . "</td>";
            echo '</tr>';

            echo '</table>';
            echo '<br>';
        } else {
            echo 'El alumno no tiene registrados a sus padres';
        }
        ?>
        
        <br>
        <div align="center">
            <b><?php echo 'ALUMNO' ?></b>
        </div>
        <br>
        <?php
        echo "<table width='95%' align='center' border=1 cellpadding=2 cellspacing=0 class='tablaLineaSimple'>";
        echo "<thead class='cabeceraTablaInicio'>";
        echo "<tr align='center'>";
        echo "<td width='10%'><b> CÓDIGO </b></td>";
        echo "<td width='15%'><b> APELLIDO<br>PATERNO </b></td>";
        echo "<td width='15%'><b> APELLIDO<br>MATERNO </b></td>";
        echo "<td width='20%'><b> NOMBRES </b></td>";
        echo "<td width='10%'><b> USUARIO </b></td>";
        echo "<td width='8%'><b> GRADO<br>NIVEL </b></td>";
        echo "<td width='10%'><b> ESTADO </b></td>";
        echo '</tr>';
        echo '</thead>';
        $nombreEstado = describir_estado($alumno->USUA_estado);
        echo '<tr>';
        echo "<td align='center'>" . $alumno->USUA_codigo . "</td>";
        echo "<td align='center'>" . utf8_encode($alumno->USUA_apellidoPaterno) . "</td>";
        echo "<td align='center'>" . utf8_encode($alumno->USUA_apellidoMaterno) . "</td>";
        echo "<td align='center'>" . utf8_encode($alumno->USUA_nombres) . "</td>";
        echo "<td align='center'>" . $alumno->USUA_login . "</td>";
        echo "<td align='center'>" . $alumno->GRAD_abreviatura . ' ' . $alumno->NIVE_abreviatura . "</td>";
        echo "<td align='center'>" . $nombreEstado . "</td>";
        echo '<tr>';
        echo '</table>';
        ?>

        <br><br>
        <div align="center">
            <b><?php echo 'HERMANOS' ?></b>
        </div>
        <br>
        <?php
        echo "<table width='95%' align='center' border=1 cellpadding=2 cellspacing=0 class='tablaLineaSimple'>";
        echo "<thead class='cabeceraTablaInicio'>";
        echo "<tr align='center'>";
        echo "<td width='10%'><b> CÓDIGO </b></td>";
        echo "<td width='15%'><b> APELLIDO<br>PATERNO </b></td>";
        echo "<td width='15%'><b> APELLIDO<br>MATERNO </b></td>";
        echo "<td width='20%'><b> NOMBRES </b></td>";
        echo "<td width='10%'><b> USUARIO </b></td>";
        echo "<td width='10%'><b> GRADO<br>NIVEL </b></td>";
        echo "<td width='10%'><b> ESTADO </b></td>";
        echo '</tr>';
        echo '</thead>';
        if ($listaHermanos) {
            foreach ($listaHermanos as $hermano) {
                $nombreEstado = describir_estado($hermano->USUA_estado);
                echo '<tr>';
                echo "<td align='center'>" . $hermano->USUA_codigo . "</td>";
                echo "<td align='center'>" . utf8_encode($hermano->USUA_apellidoPaterno) . "</td>";
                echo "<td align='center'>" . utf8_encode($hermano->USUA_apellidoMaterno) . "</td>";
                echo "<td align='center'>" . utf8_encode($hermano->USUA_nombres) . "</td>";
                echo "<td align='center'>" . $hermano->USUA_login . "</td>";
                echo "<td align='center'>" . $hermano->GRAD_abreviatura . ' ' . $hermano->NIVE_abreviatura . "</td>";
                echo "<td align='center'>" . $nombreEstado . "</td>";
                echo '<tr>';
            }
        }
        echo '</table>';
        ?>
        <br>
    </body>
</html>

<?php
//imprimir($alumno);
?>