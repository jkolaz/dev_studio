<?php
$objInstancia = get_instance();
$this->load->model('3_lecturas/permiso_model');
?>
<html>
    <head>
        <script type="text/javascript" src="<?php echo base_url() ?>js/jquery.js"></script>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>css/estilos.css" media="screen" />
        <script type="text/javascript" src="<?php echo base_url() ?>js/sistema/rol.js"></script>
    </head>
    <body>
        <div id="pagina">
            <div id="zonaContenido">
                <div align="center">

                    <div id="tituloForm" class="header"><?php echo $titulo ?></div>
			<!-- asa -->
                    <div id="frmResultado" style="width:100%; height:90%; overflow: auto; background-color: #f5f5f5">
                        <form id="frmRol" name="frmRol" method="post" 
                              action="<?php echo base_url() ?>index.php/3_lecturas/rol/insertar">
                            <div id="datosGenerales">
                                <table class="fuente8" width="98%" cellspacing=0 cellpadding="6" border="0">
                                    <tr>
                                        <td>
                                            <b> Rol </b> &nbsp; <input name="nombreRol" id="nombreRol" class="cajaMedia"
                                                                       placeholder="Ingresar nombre del rol" 
                                                                       value="<?php echo $nombreRol ?>" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <table>
                                                <?php
                                                foreach ($menu as $menuBase) {
                                                    $subMenu = $menuBase->subMenu;
                                                    ?>
                                                    <tr><td><?php
                                                $menu = $menuBase->MENU_codigo;
                                                if (isset($codigo)) {
                                                    $rolMenu = $objInstancia->permiso_model->busca_permiso($codigo, $menu);
                                                    if (count($rolMenu) > 0) {
                                                        echo $text = ($menuBase->MENU_url != '') ?
                                                        '<input type="checkbox" checked="true" name="nombre['
                                                        . $menu . ']" id="nombre[' . $menu . ']" value="'
                                                        . $menu . '"><strong>' . $menuBase->MENU_descripcion :
                                                        '</strong><input type="checkbox" checked="true" name="nombre['
                                                        . $menu . ']" id="nombre[' . $menu . ']" value="' . $menu
                                                        . '"><strong>' . $menuBase->MENU_descripcion . '</strong>';
                                                    } else {
                                                        echo $text = ($menuBase->MENU_url != '') ?
                                                        '<input type="checkbox"  name="nombre[' . $menu
                                                        . ']" id="nombre[' . $menu . ']" value="' . $menu
                                                        . '"><strong>' . $menuBase->MENU_descripcion :
                                                        '</strong><input type="checkbox" name="nombre[' . $menu
                                                        . ']" id="nombre[' . $menu . ']" value="' . $menu
                                                        . '"><strong>' . $menuBase->MENU_descripcion . '</strong>';
                                                    }
                                                } else {
                                                    echo $text = ($menuBase->MENU_url != '') ?
                                                    '<input type="checkbox"  name="nombre[' . $menu
                                                    . ']" id="nombre[' . $menu . ']" value="' . $menu
                                                    . '"><strong>' . $menuBase->MENU_descripcion :
                                                    '</strong><input type="checkbox" name="nombre[' . $menu
                                                    . ']" id="nombre[' . $menu . ']" value="' . $menu
                                                    . '"><strong>' . $menuBase->MENU_descripcion . '</strong>';
                                                }
                                                if (count($subMenu)) {
                                                        ?>
                                                                <table>
                                                                    <?php
                                                                    foreach ($subMenu as $subMenu) {
                                                                        $subtext = '';
                                                                        $subtext2 = '';
                                                                        $checked = '';
                                                                        $subtext = $subMenu->MENU_descripcion;
                                                                        $subtext2 = $subMenu->MENU_codigo;
                                                                        if (isset($codigo)) {
                                                                            $menu = $menuBase->MENU_codigo;
                                                                            $rolCodigo = $objInstancia->permiso_model->busca_permiso($codigo, $subtext2);
                                                                            if (count($rolCodigo) > 0) {
                                                                                echo '<tr><td width="300">&nbsp;&nbsp;&nbsp;<input type="checkbox" checked="true" value="' . $subtext2 . '" name="checkO[' . $subtext2 . ']" id="checkO[' . $subtext2 . ']">' . $subtext . '</tr></td>';
                                                                            } else {
                                                                                echo '<tr><td width="300">&nbsp;&nbsp;&nbsp;<input type="checkbox" value="' . $subtext2 . '" name="checkO[' . $subtext2 . ']" id="checkO[' . $subtext2 . ']">' . $subtext . '</tr></td>';
                                                                            }
                                                                        } else {
                                                                            echo '<tr><td width="300">&nbsp;&nbsp;&nbsp;<input type="checkbox" value="' . $subtext2 . '" name="checkO[' . $subtext2 . ']" id="checkO[' . $subtext2 . ']">' . $subtext . '</tr></td>';
                                                                        }
                                                                    }
                                                                    ?>
                                                                </table>
                                                                <?php
                                                            }
                                                            ?></td>
                                                    </tr>
                                                    <?php
                                                }
                                                ?>
                                            </table>
                                        </td>
                                    </tr>

                                </table>
                            </div>
                            <input type="hidden" name="base_url" id="base_url" value="<?php echo base_url() ?>">
                            <input type="hidden" name="codigo" id="codigo" value="<?php echo $codigo ?>">
                            <input type="hidden" name="modo" id="modo" value="<?php echo $modo ?>">
                        </form>
                    </div>
                    <br>
                    <ul id="guardarRol" class="lista_botones"><li id="aceptar"> Aceptar </li></ul>

                </div>
            </div>
        </div>
    </body>
</html>