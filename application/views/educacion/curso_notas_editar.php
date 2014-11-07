<script type="text/javascript" src="<?php echo base_url() ?>js/educacion/grado.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>js/fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>js/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>js/fancybox/jquery.fancybox-1.3.4.css" media="screen" />

<script type="text/javascript" charset="utf-8">
    $(document).ready( function() {
        $('#cursos').dataTable( {
            "iDisplayLength" : 50
        } );
    } );
</script>

<script type="text/javascript">
    $(document).ready( function() {
        base_url   = $("#base_url").val();
        $("#ver_editar_comentarios").fancybox( {
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
    <ul href="<?php echo base_url() ?>index.php/educacion/curso/mostrar_nuevo" id="grabar_curso" 
        class="lista_botones">
        <li id="aceptar"> Grabar Notas </li>
    </ul>
</div>

<br>
<div class="header"><?php echo utf8_encode($curso->CURS_nombre) ?></div>

<div id="container">
    <div class="demo_jui">
        <table cellpadding="0" cellspacing="0" border="0" class="display" id="cursos">
            <thead>
                <tr>
                    <th> N </th>
                    <th> ALUMNO </th>

                    <th> M1 </th>
                    <th> M2 </th>
                    <th> PROM<br>BIM 1 </th>

                    <th> M1 </th>
                    <th> PC1 </th>
                    <th> PC2 </th>
                    <th> PC3 </th>
                    <th> PC4 </th>
                    <th> PROM<br>BIM 2 </th>

                    <th> PROM<br>BIM 3 </th>

                    <th> PROM<br>BIM 3 </th>

                    <th> OBS </th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($listaAlumnos) {
                    $i = 1;
                    foreach ($listaAlumnos as $objeto) {
                        $idAlumno = $objeto->USUA_id;
                        $nombreAlumno = formar_nombre_completo($objeto);
                        $idCurso = $objeto->CURS_id;
                        $comentarios = $objeto->comentarios;
                        echo '<tr>';
                        echo "<td align='center'>" . $i . '</td>';
                        echo "<td align='left'>" . $nombreAlumno . '</td>';

                        echo "<td align='center'>" . 18 . '</td>';
                        echo "<td align='center'>" . 16 . '</td>';
                        echo "<td align='center'><b>" . 17 . '</b></td>';

                        echo "<td align='center'>" . 17 . '</td>';
                        echo "<td align='center'><input type='text' class='cajaNota' value=" . 17 . '></td>';
                        echo "<td align='center'><input type='text' class='cajaNota' value=" . 16 . '></td>';
                        echo "<td align='center'><input type='text' class='cajaNota' value=" . 17 . '></td>';
                        echo "<td align='center'><input type='text' class='cajaNota' value=" . 18 . '></td>';
                        echo "<td align='center'><b>" . 17 . '</b></td>';

                        echo "<td align='center'><b>" . '-' . '</b></td>';

                        echo "<td align='center'><b>" . '-' . '</b></td>';

                        echo "<td align='center'>";
                        echo "<a class='ver_editar_comentarios' href='" . base_url()
                        . "index.php/seguridad/usuario/editar_comentarios/$idAlumno/$idProfesor/$idCurso' ><img src='"
                        . base_url() . "img/mensajes.png' width='16' height='16' border='0' title='Comentar - $nombreAlumno' /></a>($comentarios)";
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

<?php
imprimir($listaAlumnos);
//imprimir($idAlumno);
//imprimir($idProfesor);
//imprimir($idCurso);
?>
