<?php
$objInstancia = get_instance();
$this->load->model('seguridad/permiso_model');
?>
<html>
    <head>
        <title>Mi Jazmincito | EDUSOFT</title>
        <meta charset="utf-8">
        <script type="text/javascript" src="<?php echo base_url() ?>js/jquery.js"></script>        
        <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>css/estilos.css" media="screen" />
        <script>
            var rol;
            var base_url;
            jQuery(document).ready( function() {
                base_url = $('#base_url').val();
                rol = $('#rol_id').val();
                check_submenu();
                check_menu();
            });
            
            function check_menu(){
                $('.menu').click( function(){
                    var activar;
                    var menu = $(this).val();
                    var sub_menu = "";
                    var sub_menu_activo = "";
                    var sub_menu_desactivo = "";
                    $('.rol_'+menu).each( function(index, value){
                        if($(this).is(':checked')){
                            sub_menu_activo += $(this).val()+',';
                        }else{
                            sub_menu_desactivo += $(this).val()+',';
                        }
                    });
                    if($(this).is(':checked')){
                        $('.rol_'+menu).attr('checked','checked');
                        activar = 1;
                    }else{
                        activar = 0;
                        $('.rol_'+menu).removeAttr('checked');
                    }
                    $.ajax({
                        type: "POST",
                        url: base_url+"index.php/seguridad/permiso/RolMenuPadre",
                        data: {rol: rol, menu: menu, activar: activar, sub_menu_activo: sub_menu_activo, sub_menu_desactivo: sub_menu_desactivo},
                        dataType: "json",
                        success: function(data, textStatus, jqXHR){
                            try{
                                if(data.result == 0){
                                    alert('se produjo un error');
                                }
                            }catch(E){
                                alert('se produjo un error');
                            }
                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                            alert('se produjo un error');
                        }
                    });
                });
            }
            
            function check_submenu(){
                $('.sub_menu').click( function(){
                    var menu = $(this).val();
                    var activar;
                    if($(this).is(':checked')){
                        activar = 1;
                        /*activar permiso*/
                    }else{
                        activar = 0;
                        /*desactivar permiso*/
                    }
                    $.ajax({
                        type: "POST",
                        url: base_url+"index.php/seguridad/permiso/RolMenu",
                        data: {rol: rol, menu: menu, activar: activar},
                        dataType: "json",
                        success: function(data, textStatus, jqXHR){
                            try{
                                if(data.result == 0){
                                    alert('se produjo un error');
                                }
                            }catch(E){
                                alert('se produjo un error');
                            }
                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                            alert('se produjo un error');
                        }
                    });
                });
            }
        </script>
    </head>
    <body>
        <div id="pagina">
            <div id="zonaContenido">
                <div align="center">
                    
                    <div id="tituloForm" class="header"><?php echo $titulo ?></div>

                    <div id="frmResultado" style="width:100%; height:90%; overflow: auto; background-color: #f5f5f5">

                        <div id="datosGenerales">
                            <table class="fuente8" width="98%" cellspacing=0 cellpadding="6" border="0">
                                <tr>
                                    <td>
                                        <input type="hidden" name="base_url" id="base_url" value="<?=base_url()?>"/>
                                        <input type="hidden" name="rol_id" id="rol_id" value="<?=$rol_id?>"/>
                                        <b style="font-size: 16px; font-weight: bold;"> Rol :</b>
                                        <span style="font-size: 16px;">&nbsp; <?php echo $nombreRol ?></span>
                                    </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>
                                        <table>
                                            <?php
                                            foreach ($menu as $menuBase) {
                                                $subMenu = $menuBase->subMenu;
                                                ?>
                                                <tr><td><?php
                                            $menu = $menuBase->MENU_id;
                                            if (isset($codigo)) {
                                                $rolMenu = $objInstancia->permiso_model->busca_permiso($codigo, $menu);
                                                if (count($rolMenu) > 0) {
                                                    echo $text = ($menuBase->MENU_ruta != '') ? '<input type="checkbox" class="menu" checked="true" name="nombre[' . $menu . ']" id="nombre[' . $menu . ']" value="' . $menu . '"><strong>' . $menuBase->MENU_nombre : '</strong><input type="checkbox" class="menu" checked="true" name="nombre[' . $menu . ']" id="nombre[' . $menu . ']" value="' . $menu . '"><strong>' . $menuBase->MENU_nombre . '</strong>';
                                                } else {
                                                    echo $text = ($menuBase->MENU_ruta != '') ? '<input type="checkbox" class="menu" name="nombre[' . $menu . ']" id="nombre[' . $menu . ']" value="' . $menu . '"><strong>' . $menuBase->MENU_nombre : '</strong><input type="checkbox" class="menu" name="nombre[' . $menu . ']" id="nombre[' . $menu . ']" value="' . $menu . '"><strong>' . $menuBase->MENU_nombre . '</strong>';
                                                }
                                            } else {
                                                echo $text = ($menuBase->MENU_ruta != '') ? '<input type="checkbox" class="menu" name="nombre[' . $menu . ']" id="nombre[' . $menu . ']" value="' . $menu . '"><strong>' . $menuBase->MENU_nombre : '</strong><input type="checkbox" class="menu" name="nombre[' . $menu . ']" id="nombre[' . $menu . ']" value="' . $menu . '"><strong>' . $menuBase->MENU_nombre . '</strong>';
                                            }
                                            if (count($subMenu)) {
                                                    ?>
                                                            <table>
                                                                <?php
                                                                foreach ($subMenu as $subMenu) {
                                                                    $subtext = '';
                                                                    $subtext2 = '';
                                                                    $checked = '';
                                                                    $subtext = $subMenu->MENU_nombre;
                                                                    $subtext2 = $subMenu->MENU_id;
                                                                    if (isset($codigo)) {
                                                                        $menu = $menuBase->MENU_id;
                                                                        $rolCodigo = $objInstancia->permiso_model->busca_permiso($codigo, $subtext2);
                                                                        if (count($rolCodigo) > 0) {
                                                                ?>
                                                                <tr>
                                                                    <td>
                                                                        &nbsp;&nbsp;&nbsp;
                                                                        <input type="checkbox" checked="true" value="<?=$subtext2?>" class="rol_<?=$menu?> sub_menu" name="check0[<?=$subtext2?>]" id="check0[<?=$subtext2?>]" /><?=$subtext?>
                                                                    </td>
                                                                </tr>
                                                                <?php
                                                                        } else {
                                                                ?>
                                                                <tr>
                                                                    <td>
                                                                        &nbsp;&nbsp;&nbsp;
                                                                        <input type="checkbox" value="<?=$subtext2?>" class="rol_<?=$menu?> sub_menu" name="check0[<?=$subtext2?>]" id="check0[<?=$subtext2?>]"/><?=$subtext?>
                                                                    </td>
                                                                </tr>
                                                                <?php
                                                                        }
                                                                    } else {
                                                                ?>
                                                                <tr>
                                                                    <td>
                                                                        &nbsp;&nbsp;&nbsp;
                                                                        <input type="checkbox" value="<?=$subtext2?>" class="rol_<?=$menu?> sub_menu" name="check0[<?=$subtext2?>]" id="check0[<?=$subtext2?>]"/><?=$subtext?>
                                                                    </td>
                                                                </tr>
                                                                <?php
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
                    </div>

                </div>
            </div>
        </div>
    </body>
</html>