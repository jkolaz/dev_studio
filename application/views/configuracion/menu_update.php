<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>css/usuario.css" media="screen" />
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
        <form name="form1" id="form1" action="<?=base_url() ?>index.php/configuracion/menu/update/<?=$menu->MENU_id?>" method="post">
            <input type="hidden" name="txt_MENU_id" id="txt_MENU_id" value="<?=$menu->MENU_id?>" />
            <input type="hidden" name="action" id="action" value="<?=$action?>" />
            <table class="tabla" id="usuarios">
                <tbody>
                    <tr>
                        <td>Nombre:</td>
                        <td colspan="3"><input type="input" style="width: 350px;" class="required" name="txt_MENU_nombre" id="txt_MENU_nombre" class="require input-large" value="<?=$menu->MENU_nombre?>"/></td>
                    </tr>
                    <tr>
                        <td>Carpeta:</td>
                        <td><input type="input" class="required" name="txt_MENU_carpeta" id="txt_MENU_carpeta" class="require" value="<?=$menu->MENU_carpeta?>"/></td>
                        <td>Clase:</td>
                        <td><input type="input" class="required" name="txt_MENU_controlador" id="txt_MENU_controlador" class="require" value="<?=$menu->MENU_controlador?>"/></td>
                        <td>Metodo:</td>
                        <td><input type="input" class="required" name="txt_MENU_funcion" id="txt_MENU_funcion" class="require" value="<?=$menu->MENU_funcion?>"/></td>
                        <td>Metodo:</td>
                        <td><input type="input" name="txt_MENU_parametro" id="txt_MENU_parametro" class="require" value="<?=$menu->MENU_parametro?>"/></td>
                    </tr>
                    <tr>
                        <td>Tipo</td>
                        <td>
                            <input type="radio" class="required" name="txt_MENU_is_public" id="txt_MENU_is_public_1" <?= ($menu->MENU_is_public == 1)?'checked':'';?> value="1"/> Publico
                            <br>
                            <input type="radio" class="required" name="txt_MENU_is_public" id="txt_MENU_is_public_0" <?= ($menu->MENU_is_public == 0)?'checked':'';?> value="0"/> Privado
                        </td>
                        <td>Tipo Vista</td>
                        <td>
                            <input type="radio" class="required" name="txt_MENU_is_view" id="txt_MENU_is_view_1" <?= ($menu->MENU_is_view == 1)?'checked':'';?> value="1"/> Visible
                            <br>
                            <input type="radio" class="required"name="txt_MENU_is_view" id="txt_MENU_is_view_0" <?= ($menu->MENU_is_view == 0)?'checked':'';?>value="0"/> No Visible
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