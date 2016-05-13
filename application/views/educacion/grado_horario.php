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
        <form name="form1" id="form1" action="<?=base_url() ?>index.php/educacion/curso/<?=$action?>" method="post">
            <input type="hidden" name="curso" id="curso" value="<?=$idGrado?>" />
            <table class="tabla" id="usuarios">
                <tbody>
                    <tr>
                        <td>Archivo:</td>
                        <td><input type="file" name="nombre" id="nombre" class="require" value=""/></td>
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