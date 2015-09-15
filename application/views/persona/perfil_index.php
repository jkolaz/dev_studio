<script type="text/javascript" src="<?php echo base_url() ?>js/educacion/grado.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>js/fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>js/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>js/fancybox/jquery.fancybox-1.3.4.css" media="screen" />

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
        $(".ver_foto").fancybox( {
            'width'          : 350,
            'height'         : 240,
            'transitionIn'   : 'elastic',
            'transitionOut'  : 'elastic',
            'type'	     : 'iframe'
        } );
    } );
</script>

<?php
$idUser = $usuario->USUA_id;
$imagen = base_url(). 'fotos/' . $usuario->USUA_login.".jpg";
$file_headers = @get_headers($imagen);
if($file_headers[0] == 'HTTP/1.1 404 Not Found') {
    $imagen = base_url(). 'fotos/nodisponible.jpg';
}
?>

<br><br>
<div class="header"><?php echo $titulo ?></div>
<br>
<table width="90%" border="0">
    <tr>
        <td valign="top">
            <table border="1">
                <tr>
                    <td>
                        <a class='ver_foto' 
                           href="<?=$imagen?>">
                            <img width="128px"
                                 title="<?php echo formar_nombre_completo($usuario) ?>"
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
                    <td><b> <?php echo formar_nombre_completo($usuario) ?> </b></td>
                </tr>
                <tr>
                    <td> Usuario </td>
                    <td> : </td>
                    <td><b> <?php echo $usuario->USUA_login ?> </b></td>
                </tr>
                <tr>
                    <td> DNI </td>
                    <td> : </td>
                    <td><b> <?php echo $usuario->USUA_dni ?> </b></td>
                </tr>
                <tr>
                    <td> Correo </td>
                    <td> : </td>
                    <td>
                        <b> <?php echo $usuario->USUA_email ?> </b>
                        <a>
                            (Edit)
                        </a>
                    </td>
                </tr>
                <tr>
                    <td> Sexo </td>
                    <td> : </td>
                    <td><b> <?php echo describir_sexo($usuario->USUA_sexo) ?> </b></td>
                </tr>
                <tr>
                    <td> Fecha de nacimiento </td>
                    <td> : </td>
                    <td>
                        <b> <?php echo dame_fecha_estandar($usuario->USUA_fechaNacimiento) ?> </b>
                        <a>
                            (Edit)
                        </a>
                    </td>
                </tr>
            </table>
        </td>
        <td valign="top">
            <table>
                <tr>
                    <td> C&oacute;digo UGEL </td>
                    <td> : </td>
                    <td><b> <?php echo $usuario->USUA_codigo ?> </b></td>
                </tr>
                <tr>
                    <td> Grado </td>
                    <td> : </td>
                    <td><b> <?php echo 'Magister' ?> </b></td>
                </tr>
                <tr>
                    <td> Estado </td>
                    <td> : </td>
                    <td><b> <?php echo describir_estado($usuario->USUA_estado) ?> </b></td>
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
<?php
//imprimir($lista);
?>
