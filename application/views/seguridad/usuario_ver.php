<script type="text/javascript" src="<?php echo base_url() ?>js/educacion/nivel.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>js/fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>js/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>js/fancybox/jquery.fancybox-1.3.4.css" media="screen" />

<script type="text/javascript" charset="utf-8">
    $(document).ready( function() {
        $('#cursos').dataTable( {
        } );
    } );
</script>

<script type="text/javascript">
    $(document).ready( function() {
        base_url   = $("#base_url").val();
        $(".ver_parciales").fancybox( {
            'width'          : 450,
            'height'         : 320,
            'transitionIn'   : 'elastic',
            'transitionOut'  : 'elastic',
            'type'	     : 'iframe'
        } );
        $(".ver_comentarios").fancybox( {
            'width'          : 450,
            'height'         : 320,
            'transitionIn'   : 'elastic',
            'transitionOut'  : 'elastic',
            'type'	     : 'iframe'
        } );
        $(".ver_documentos").fancybox( {
            'width'          : 550,
            'height'         : 300,
            'transitionIn'   : 'elastic',
            'transitionOut'  : 'elastic',
            'type'	     : 'iframe'
        } );
        $(".ver_foto").fancybox( {
            'width'          : 370,
            'height'         : 470,
            'transitionIn'   : 'elastic',
            'transitionOut'  : 'elastic',
            'type'	     : 'iframe'
        } );
        $('#fancybox-close').click(function(){
            
                document.location.reload();
        });
    } );
</script>

<br><br><br>

<?php
$idAlumno = $alumno->USUA_id;
$idGrado = $alumno->GRAD_id;
$imagen = base_url(). 'fotos/' . $alumno->USUA_login.".jpg";
$file_headers = @get_headers($imagen);
if($file_headers[0] == 'HTTP/1.1 404 Not Found') {
    $imagen = base_url(). 'fotos/nodisponible.jpg';
}
?>

<table width="90%" border="0" style="padding-left: 10px;">
    <tr>
        <!--<td valign="top">
            <table border="1">
                <tr>
                    <td>
                        <a class='ver_foto' 
                           href="<?php echo base_url() . 'index.php/seguridad/usuario/ver_foto/' . $alumno->USUA_login ?>">
                            <img width="128px"
                                 title="<?php echo formar_nombre_completo($alumno) ?>"
                                 src="<?=$imagen?>" />
                        </a>
                    </td>
                </tr>
            </table>
        </td>     -->   
        <td valign="top">
            <table border="0">
                <tr>
                    <td> Alumno </td>
                    <td> : </td>
                    <td><b> <?php echo formar_nombre_completo($alumno) ?> </b></td>
                </tr>
                <tr>
                    <td> Usuario </td>
                    <td> : </td>
                    <td><b> <?php echo $alumno->USUA_login ?> </b></td>
                </tr>
                <tr>
                    <td> DNI </td>
                    <td> : </td>
                    <td><b> <?php echo $alumno->USUA_dni ?> </b></td>
                </tr>
                <tr>
                    <td> Correo </td>
                    <td> : </td>
                    <td><b> <?php echo $alumno->USUA_email ?> </b></td>
                </tr>
                <tr>
                    <td> Sexo </td>
                    <td> : </td>
                    <td><b> <?php echo describir_sexo($alumno->USUA_sexo) ?> </b></td>
                </tr>
                <!--<tr>
                    <td> Fecha de nacimiento </td>
                    <td> : </td>
                    <td><b> <?php echo dame_fecha_estandar($alumno->USUA_fechaNacimiento) ?> </b></td>
                </tr>
                <tr>
                    <td> Edad </td>
                    <td> : </td>
                    <td><b> <?php echo '7 años' ?> </b></td>
                </tr>
                <tr>
                    <td> --- </td>
                    <td> : </td>
                    <td><b> <?php echo '-' ?> </b></td>
                </tr>
                <tr>
                    <td> --- </td>
                    <td> : </td>
                    <td><b> <?php echo '-' ?> </b></td>
                </tr>
                <tr>
                    <td> --- </td>
                    <td> : </td>
                    <td><b> <?php echo '-' ?> </b></td>
                </tr>-->
            </table>
        </td>
        <td valign="top">
            <table>
                <tr>
                    <td> C&oacute;digo </td>
                    <td> : </td>
                    <td><b> <?php echo $alumno->USUA_codigo ?> </b></td>
                </tr>
                <tr>
                    <td> Grado </td>
                    <td> : </td>
                    <td><b> <?= $grado->GRAD_nombre ?> </b></td>
                </tr>
                <tr>
                    <td> Nivel </td>
                    <td> : </td>
                    <td><b> <?=$grado->NIVE_nombre ?> </b></td>
                </tr>
                <!--<tr>
                    <td> Orden de m&eacute;rito </td>
                    <td> : </td>
                    <td><b> <?php echo $alumno->USUA_ordenMerito ?> </b></td>
                </tr>
                <tr>
                    <td> Estado </td>
                    <td> : </td>
                    <td><b> <?php echo describir_estado($alumno->USUA_estado) ?> </b></td>
                </tr>-->
            </table>
            <br>

            <?php
            if ($documentosPendientes) {
                $texto = "DOCUMENTOS PENDIENTES ($documentosPendientes)";
            } else {
                $texto = 'El alumno no tiene documentos pendientes';
            }
            ?>
            <!--
            <table>
                <tr>
                    <td>
                        <a class='ver_documentos' 
                           href="<?php echo base_url() . 'index.php/educacion/documento/ver/' . $idAlumno . '/' . $idGrado ?>">
                               <?php echo $texto ?>
                        </a>
                    </td>
                </tr>
            </table>
            -->
        </td>
    </tr>
</table>

<br>
<div class="header"><?php echo 'CURSOS' ?></div>

<div id="container">
    <div class="demo_jui">
        <table cellpadding="0" cellspacing="0" border="0" class="display" id="cursos">
            <thead>
                <tr>
                    <th> N </th>
                    <th> CURSO </th>
                    <th> B1 </th>
                    <th> B2 </th>
                    <th> B3 </th>
                    <th> B4 </th>
                    <th> PROFESOR </th>
                    <th> OBS </th>
                    <th> TIPO </th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($listaCursos) {
                    $i = 1;
                    foreach ($listaCursos as $objeto) {
                        $NOTAS = $objeto->notas;
                        $idCurso = $objeto->CURS_id;
                        $idProfesor = $objeto->idProfesor;
                ?>
                <tr>
                    <td style="text-align: center;"><?=$i?></td>
                    <td style="text-align: left;"><?=$objeto->CURS_nombre?></td>
                    <td style="text-align: right;">
                        <a class="ver_parciales" href="<?=base_url()?>index.php/educacion/curso/ver_detalle_curso/<?=$NOTAS[1]['id']?>" title="<?=$objeto->CURS_nombre?> - B1 - Promedio = <?=  validar_parciales_bimestre($NOTAS, 1)?>">
                            <?=  validar_parciales_bimestre($NOTAS, 1)?>
                        </a>
                    </td>
                    <td style="text-align: right;">
                        <a class="ver_parciales" href="<?=base_url()?>index.php/educacion/curso/ver_detalle_curso/<?=$NOTAS[2]['id']?>" title="<?=$objeto->CURS_nombre?> - B2 - Promedio = <?=  validar_parciales_bimestre($NOTAS, 2)?>">
                            <?=  validar_parciales_bimestre($NOTAS, 2)?>
                        </a>
                    </td>
                    <td style="text-align: right;">
                        <a class="ver_parciales" href="<?=base_url()?>index.php/educacion/curso/ver_detalle_curso/<?=$NOTAS[3]['id']?>" title="<?=$objeto->CURS_nombre?> - B3 - Promedio = <?=  validar_parciales_bimestre($NOTAS, 3)?>">
                            <?=  validar_parciales_bimestre($NOTAS, 3)?>
                        </a>
                    </td>
                    <td style="text-align: right;">
                        <a class="ver_parciales" href="<?=base_url()?>index.php/educacion/curso/ver_detalle_curso/<?=$NOTAS[4]['id']?>" title="<?=$objeto->CURS_nombre?> - B4 - Promedio = <?=  validar_parciales_bimestre($NOTAS, 4)?>">
                            <?=  validar_parciales_bimestre($NOTAS, 4)?>
                        </a>
                    </td>
                    <td style="text-align: justify; padding-left: 20px;">
                        <?=$objeto->profesor?>
                    </td>
                    <td style="text-align: center;">
                    <?php
                    if($objeto->comentarios){
                    ?>
                        <a class="ver_comentarios" href="<?=base_url()?>index.php/seguridad/usuario/ver_comentarios/<?=$idAlumno?>/<?=$idProfesor?>/<?=$idGrado?>">
                            <img src="<?=base_url()?>img/mensajes.png" width="16" height="16" title="Ver los comentarios del profesor" />
                        </a>
                    <?php
                    }
                    ?>
                    </td>
                    <td style="text-align: center">
                        <?=describir_estado($objeto->CURS_estado)?>
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

<?php
//imprimir($listaCursos);
?>
