<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>css/usuario.css" media="screen" />
        <script type="text/javascript" src="<?php echo base_url() ?>js/jquery.js"></script>
        <script type="text/javascript" src="<?php echo base_url() ?>js/validate/jquery.js"></script>
        <script type="text/javascript" src="<?php echo base_url() ?>js/validate/jquery.validate.js"></script>
        <script>
            $(document).ready( function() {

                $('#txt_correo').focus();
                $('#form1').validate();
            });
        </script>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>css/estilos.css" media="screen" />
    </head>
    <body>
        <br><br>
        <div class="header">ENVIAR REPORTE</div>
        <div id="container">
            <div class="demo_jui">
            <!-- asa -->
                <form name="form1" id="form1" action="<?=base_url() ?>index.php/reporte/Reporte/<?=$action?>" method="post">
                    <input type="hidden" name="txt_pdf" value="<?=$pdf?>"/>
                    <table class="tabla" id="usuarios">
                        <tbody>
                            <tr>
                                <td>Correo</td>
                                <td>
                                    <input type="text" name="txt_correo" id="txt_correo" class="required email" placeholder="Ingrese Correo" autocomplete="off"/>
                                </td>
                                <td><input type="submit" class="btn add" name="btn_enviar" id="btn_enviar" value="Enviar"></td>
                            </tr>
                        </tbody>
                    </table>
                </form>
                <input type="hidden" name="base_url" id="base_url" value="<?php echo base_url() ?>">
            </div>
        </div>
    </body>
</html>