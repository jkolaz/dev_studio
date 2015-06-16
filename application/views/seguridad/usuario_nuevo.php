<html>
    <head>
        <script type="text/javascript" src="<?php echo base_url() ?>js/jquery.js"></script>        
        <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>css/estilos.css" media="screen" />
        <script type="text/javascript" src="<?php echo base_url() ?>js/sistema/usuario.js"></script>
    </head>
    <body>
        <div id="pagina">
            <div id="zonaContenido">
                <div align="center">
                    <!-- asa -->
                    <div class="header"><?php echo $titulo ?></div>

                    <div id="frmResultado" style="width:100%; height:83%; overflow: auto; background-color: #f5f5f5">
                        <form id="frmUsuario" name="frmUsuario" method="post" 
                              action="<?php echo base_url() ?>index.php/3_lecturas/usuario/insertar">
                            <table width="100%" cellspacing="0" cellpadding="5" border="0">
                                <tr>
                                    <td><b> Nombre2s : </b></td>
                                    <td>
                                        <input placeholder="Ingresar nombres" class="cajaGrande" type="text" 
                                               name="nombre" value="<?php echo $nombre ?>" />
                                    </td>
                                </tr> 
                                <tr>
                                    <td><b> Apellido Paterno : </b></td>
                                    <td><input placeholder="Ingresar apellido paterno" class="cajaGrande" type="text"
                                               name="apellidoPaterno" value="<?php echo $apellidoPaterno ?>" /></td>
                                </tr>  
                                <tr>
                                    <td><b> Apellido Materno : </b></td>
                                    <td>
                                        <input placeholder="Ingresar apellido materno" class="cajaGrande" type="text" 
                                               name="apellidoMaterno" value="<?php echo $apellidoMaterno ?>" />
                                    </td>
                                </tr>  
                                <tr>
                                    <td><b> Nombre de Usuario : </b></td>
                                    <td>
                                        <input placeholder="Ingresar nombre de usuario" class="cajaMedia " type="text" 
                                               name="usuario" id="usuario" value="<?php echo $usuario ?>" />
                                    </td>
                                </tr>
                                <tr>    
                                    <td><b> Clave : </b></td>
                                    <td>
                                        <input placeholder="Ingresar clave"  class="cajaMedia " type="password" 
                                               name="clave" id="clave" value="" />
                                    </td>
                                </tr>
                                <tr>
                                    <td><b> Rol : </b></td>
                                    <td>
                                        <select name="rol" id="rol">
                                            <option value="">::Seleccionar::</option>
                                            <?php foreach ($roles as $valor) { ?>
                                                <option <?php if ($codigoRol = $valor->ROL_codigo) echo 'selected' ?>
                                                    value="<?php echo $valor->ROL_codigo ?>"><?php echo $valor->ROL_descripcion ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </td>
                                </tr>  
                            </table>
                            <input type="hidden" name="codigo" id="codigo" value="<?php echo $codigo ?>">
                            <input type="hidden" name="modo" id="modo" value="<?php echo $modo ?>">
                            <input type="hidden" name="base_url" id="base_url" value="<?php echo base_url() ?>">
                        </form>
                    </div>
                    <br>
                    <ul id="guardarUsuario" class="lista_botones"><li id="aceptar">Grabar</li></ul>
                </div>
            </div>
        </div>
    </body>
</html>