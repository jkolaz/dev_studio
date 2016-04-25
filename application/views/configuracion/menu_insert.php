<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>css/usuario.css" media="screen" />
<script type="text/javascript" src="<?php echo base_url() ?>js/validate/jquery.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>js/validate/jquery.validate.js"></script>
<script type="text/javascript">
    var validate_permiso = 1;
</script>
<script src="<?=$js?>"></script>
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
        <form name="form1" id="form1" action="<?=base_url() ?>index.php/configuracion/menu/insert" method="post">
            <input type="hidden" name="txt_MENU_id" id="txt_MENU_id" value="0" />
            <input type="hidden" name="action" id="action" value="<?=$action?>" />
            <input type="hidden" name="txt_MENU_idPadre" id="action" value="<?=$padre?>" />
            <table class="tabla" id="usuarios">
                <tbody>
                    <tr>
                        <td>Nombre:</td>
                        <td colspan="3"><input type="input" style="width: 350px;" class="required" name="txt_MENU_nombre" id="txt_MENU_nombre" class="require input-large" value=""/></td>
                    </tr>
                    <tr>
                        <td>Carpeta:</td>
                        <td><input type="input" name="txt_MENU_carpeta" id="txt_MENU_carpeta"value=""/></td>
                        <td>Clase:</td>
                        <td><input type="input" name="txt_MENU_controlador" id="txt_MENU_controlador" value=""/></td>
                        <td>Metodo:</td>
                        <td><input type="input" name="txt_MENU_funcion" id="txt_MENU_funcion" class="" value=""/></td>
                        <td>Metodo:</td>
                        <td><input type="input" name="txt_MENU_parametro" id="txt_MENU_parametro"  value=""/></td>
                    </tr>
                    <tr>
                        <td>Tipo</td>
                        <td>
                            <input type="radio" class="required" name="txt_MENU_is_public" id="txt_MENU_is_public_1" value="1"/> Publico
                            <br>
                            <input type="radio" class="required" name="txt_MENU_is_public" id="txt_MENU_is_public_0" value="0"/> Privado
                        </td>
                        <td>Tipo Vista</td>
                        <td>
                            <input type="radio" class="required" name="txt_MENU_is_view" id="txt_MENU_is_view_1" value="1"/> Visible
                            <br>
                            <input type="radio" class="required"name="txt_MENU_is_view" id="txt_MENU_is_view_0" value="0"/> No Visible
                        </td>
                    </tr>
                    <tr>
                        <td><input type="submit" class="btn add" name="guardar" id="guardar" value="Guardar"></td>
                        <td><input type="submit" class="btn danger" name="cancelar" id="cancelar" value="Cancelar"></td>
                    </tr>
                </tbody>
            </table>
        </form>
        <input type="hidden" name="base_url" id="base_url" value="<?php echo base_url() ?>">
    </div>
</div>