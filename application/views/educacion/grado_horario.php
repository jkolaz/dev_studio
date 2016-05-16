<script type="text/javascript">
    var validate_permiso = 1;
</script>
<script type="text/javascript" src="<?=$js?>"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>css/usuario.css" media="screen" />
<style>
    #cursos{
        color: #0063DC;
    }
</style>
<br><br>
<div class="header"><?=$titulo?></div>
<div id="container">
    <div class="demo_jui">
    <!-- asa -->
    <form name="form1" id="form1" action="<?=base_url() ?>index.php/educacion/grado/horario/<?=$idGrado?>" method="post" enctype="multipart/form-data">
            <input type="hidden" name="txt_grado" id="txt_grado" value="<?=$idGrado?>" />
            <input type="hidden" name="action" id="action" value="<?=$action?>" />
            <table class="tabla" id="usuarios">
                <tbody>
                    <tr>
                        <td>Archivo:</td>
                        <td><input type="file" name="txt_horario" id="txt_horario" class="required" value=""/></td>
                    </tr>
                    <tr>
                        <td><input type="submit" class="btn add" name="guardar" id="guardar" value="Guardar"></td>
                        <td><input type="reset" class="btn danger" name="cancelar" id="guardar" value="Cancelar"></td>
                    </tr>
                </tbody>
            </table>
        </form>
        <input type="hidden" name="base_url" id="base_url" value="<?php echo base_url() ?>">
    </div>
</div>