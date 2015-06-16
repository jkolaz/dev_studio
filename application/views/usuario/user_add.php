<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>css/usuario.css" media="screen" />

<br><br>
<div class="header"><?php echo $titulo ?></div>
<div id="container">
    <div class="demo_jui">
    <!-- asa -->
        <form name="form1" id="form1" action="" method="post">
            <table class="tabla" id="usuarios">
                <tbody>
                    <tr>
                        <td>Nombre :</td>
                        <td><input type="input" name="nombre" id="nombre"/></td>
                    </tr>
                    <tr>
                        <td>Apellidos :</td>
                        <td><input type="input" name="paterno" id="paterno"/>
                            <input type="input" name="materno" id="materno"/></td>
                    </tr>
                    <tr>
                        <td>D.N.I. :</td>
                        <td><input type="input" name="dni" id="dni"/></td>
                    </tr>
                    <tr>
                        <td>Nick :</td>
                        <td><input type="input" name="nick" id="nick"/></td>
                    </tr>
                    <tr>
                        <td>Clave :</td>
                        <td><input type="password" name="pass" id="pass"/></td>
                    </tr>
                    <tr>
                        <td>E-mail :</td>
                        <td><input type="input" name="email" id="email"/></td>
                    </tr>
                    <tr>
                        <td>Sexo</td>
                        <td>
                            <select name="sexo" id="sexo" class="combo">
                                <option value="M">Hombre</option>
                                <option value="F">Mujer</option>
                            </select>
                        </td>
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