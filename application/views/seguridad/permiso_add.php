<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>css/permiso.css" media="screen" />

<br><br>
<div class="header"><?php echo $rol_nombre ?></div>
<div id="container">
    <div class="demo_jui">
        <form name="form1" id="form1" action="" method="post">
            <table class="tabla" id="usuarios">
                <tbody>
                    <tr>
                        <td>Nombre :</td>
                        <td><input type="input" name="nombre" id="nombre"/></td>
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