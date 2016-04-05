<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>css/usuario.css" media="screen" />
<script type="text/javascript">
    $(document).ready( function() {
        $('#txt_fecha').focus()
        $('#form1').validate();
    });
</script>
<br><br>
<div class="header">Registro de reporte</div>
<div id="container">
    <div class="demo_jui">
    <!-- asa -->
        <form name="form1" id="form1" action="<?=base_url() ?>index.php/seguridad/log/search" method="post">
            <input type="hidden" name="action" id="action" value="<?=$action?>" />
            <table class="tabla" id="usuarios">
                <tbody>
                    <tr>
                        <td>Fecha</td>
                        <td>
                            <input type="text" name="txt_fecha" id="txt_fecha" class="required" placeholder="Ingrese día" autocomplete="off"/>
                        </td>
                        <td><input type="submit" class="btn add" name="guardar_RA" id="guardar_RA" value="Buscar"></td>
                        <td><input type="reset" class="btn danger" name="cancelar" id="cancelar" value="Limpiar"></td>
                    </tr>
                </tbody>
            </table>
        </form>
        <input type="hidden" name="base_url" id="base_url" value="<?php echo base_url() ?>">
    </div>
</div>