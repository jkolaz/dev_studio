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
        $(".ver_documentos").fancybox( {
            'width'          : 600,
            'height'         : 450,
            'transitionIn'   : 'elastic',
            'transitionOut'  : 'elastic',
            'type'	     : 'iframe'
        } );
    } );
</script>

<?php
$idProfesor = $profesor->USUA_id;
$imagen = base_url(). 'fotos/' . $profesor->USUA_login.".jpg";
$file_headers = @get_headers($imagen);
if($file_headers[0] == 'HTTP/1.1 404 Not Found') {
    $imagen = base_url(). 'fotos/nodisponible.jpg';
}
?>

<br><br><br>
<table width="90%" border="0">
    <tr>
        <td valign="top">
            <table border="1">
                <tr>
                    <td>
                        <a class='ver_foto' 
                           href="<?php echo base_url() . 'index.php/seguridad/usuario/ver_foto/' . $profesor->USUA_login ?>">
                            <img width="128px"
                                 title="<?php echo formar_nombre_completo($profesor) ?>"
                                 src="<?=$imagen?>" />
                        </a>
                    </td>
                </tr>
            </table>
        </td>
        <td valign="top">
            <table border="0">
                <tr>
                    <td> Profesor </td>
                    <td> : </td>
                    <td><b> <?php echo formar_nombre_completo($profesor) ?> </b></td>
                </tr>
                <tr>
                    <td> Usuario </td>
                    <td> : </td>
                    <td><b> <?php echo $profesor->USUA_login ?> </b></td>
                </tr>
                <tr>
                    <td> DNI </td>
                    <td> : </td>
                    <td><b> <?php echo $profesor->USUA_dni ?> </b></td>
                </tr>
                <tr>
                    <td> Correo </td>
                    <td> : </td>
                    <td><b> <?php echo $profesor->USUA_email ?> </b></td>
                </tr>
                <tr>
                    <td> Sexo </td>
                    <td> : </td>
                    <td><b> <?php echo describir_sexo($profesor->USUA_sexo) ?> </b></td>
                </tr>
                <tr>
                    <td> Fecha de nacimiento </td>
                    <td> : </td>
                    <td><b> <?php echo dame_fecha_estandar($profesor->USUA_fechaNacimiento) ?> </b></td>
                </tr>
            </table>
        </td>
        <td valign="top">
            <table>
                <tr>
                    <td> C&oacute;digo UGEL </td>
                    <td> : </td>
                    <td><b> <?php echo $profesor->USUA_codigo ?> </b></td>
                </tr>
                <tr>
                    <td> Grado </td>
                    <td> : </td>
                    <td><b> <?php echo 'Magister' ?> </b></td>
                </tr>
                <tr>
                    <td> Estado </td>
                    <td> : </td>
                    <td><b> <?php echo describir_estado($profesor->USUA_estado) ?> </b></td>
                </tr>
            </table>
            <br>

            <?php
//            if ($documentosPendientes) {
//                $texto = "DOCUMENTOS PENDIENTES ($documentosPendientes)";
//            } else {
//                $texto = 'El alumno no tiene documentos pendientes';
//            }
            ?>
            <!--<table>
                <tr>
                    <td>
                        <a class='ver_documentos' 
                           href="<?php echo base_url() . 'index.php/educacion/documento/profesor_documento/' . $idProfesor ?>">
                               <?php echo $texto ?>
                        </a>
                    </td>
                </tr>
            </table>-->
        </td>
    </tr>
</table>

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
                    <th> ESTADO </th>
                    <th> ACCIONES </th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($listaCursos) {
                    $i = 1;
                    foreach ($listaCursos as $objeto) {
                        $idCurso = $objeto->CURS_id;
                        $nombreEstado = describir_estado($objeto->CURS_estado);
                ?>
                <tr>
                    <td style="text-align: center;"><?=$i?></td>
                    <td style="text-align: justify;"><?=$objeto->NIVE_nombre?></td>
                    <td style="text-align: justify;"><?=$objeto->GRAD_nombre?></td>
                    <td style="text-align: justify;"><?=$objeto->CURS_nombre?></td>
                    <td style="text-align: center;"><?=$objeto->CURS_horas?></td>
                    <td style="text-align: center;"><?=$nombreEstado?></td>
                    <td style="text-align: center;">
                        <a target="_blank" href="<?=base_url()?>index.php/educacion/curso/editar/<?=$objeto->ASIG_id?>">
                            <img src="<?=base_url()?>img/ver.png" height="16px" width="16px" border="0" title="Ver curso"/>
                        </a>&nbsp;&nbsp;
                        <a class="editar_curso" href="<?=base_url()?>index.php/educacion/curso/mostrar_editar/<?=$idCurso?>">
                            <img src="<?=base_url()?>img/modificar.png" height="16px" width="16px" border="0" title="Ver curso"/>
                        </a>&nbsp;&nbsp;
                        <a href="javascript:;" onclick="eliminar_curso(<?=$objeto->ASIG_id?>)">
                            <img src="<?=base_url()?>img/eliminar.png" height="16px" width="16px" border="0" title="Eliminar curso"/>
                        </a>
                    </td>
                </tr>
                <?php
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
