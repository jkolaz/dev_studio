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
<div class="header" style="line-height: 40px; height: 40px; font-size: 18px;"><?=$curso->CURS_nombre ?></div>

<div id="container">
    <div class="demo_jui">
        <table cellpadding="0" cellspacing="0" border="0" class="display" id="cursos">
            <thead>
                <tr>
                    <th> N </th>
                    <th> ALUMNO </th>
                    <th> PROM<br>BIM 1 </th>
                    <th> PROM<br>BIM 2 </th>
                    <th> PROM<br>BIM 3 </th>
                    <th> PROM<br>BIM 4 </th>
                    <th> PROM<br>FINAL </th>
                    <th> OBS </th>
                    <th> PDF </th>
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
                ?>
                <tr>
                    <td style="text-align: center;"><?=$i?></td>
                    <td style="text-align: justify;"><?=$nombreAlumno?></td>
                    
                    <td style="text-align: center;"><b>17</b></td>
                    <td style="text-align: center;"><b>17</b></td>
                    <td style="text-align: center;"><b>17</b></td>
                    <td style="text-align: center;"><b>17</b></td>
                    <td style="text-align: center;"><b>17</b></td>
                    <td style="text-align: center;">
                        <a class="ver_editar_comentarios" href="<?=base_url()?>index.php/seguridad/usuario/editar_comentarios/<?=$idAlumno?>/<?=$idProfesor?>/<?=$idCurso?>">
                            <img src="<?=base_url()?>/img/mensajes.png" width="16px" height="16px;" border="0" title="Comentar - <?=$nombreAlumno?>"/>
                            (<?=$comentarios?>)
                        </a>
                    </td>
                    <td  style="text-align: center;">
                        <a class="ver_editar_comentarios" href="<?=base_url()?>index.php/seguridad/usuario/editar_comentarios/<?=$idAlumno?>/<?=$idProfesor?>/<?=$idCurso?>">
                            <img src="<?=base_url()?>/img/down.png" width="16px" height="16px;" border="0" title="Descargar Nota - <?=$nombreAlumno?>"/>
                        </a>
                    </td>
                </tr>
                <?php
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
//imprimir($listaAlumnos);
?>
