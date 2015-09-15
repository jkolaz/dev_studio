<?php
$objInstancia = get_instance();

$this->load->model('seguridad/permiso_model');
$this->load->model('seguridad/usuario_model');

$objUsuario = $objInstancia->usuario_model->obtener_usuario_por_login($this->session->userdata('login'));
$idRol = $objUsuario[0]->ROL_id;
$objMenuBase = $objInstancia->permiso_model->obtener_permisos_por_rol($idRol);
?>


<ul class="nav main">
    <li><a href="<?php echo site_url('index/inicio') ?>">Inicio</a></li>
    <?php
    if($objMenuBase){
    foreach ($objMenuBase as $var) {
        $text = ($var->MENU_ruta != '') ?
                '<a href="' . site_url($var->MENU_ruta) . '">' . $var->MENU_nombre . '</a>' :
                '<a href="javascript:;">' . utf8_encode($var->MENU_nombre) . '</a>';
        $enlaces = $var->sub_menus;
        ?>
        <li><?php echo $text ?>
            <?php if (count($enlaces) > 0) { ?>
                <ul>
                    <?php
                    foreach ($enlaces as $enlace) {
                        $subtext = '';
                        if ($enlace->MENU_ruta != '') {
                            $subtext = '<a href="' . site_url($enlace->MENU_ruta) . '">';
                            $subtext .= utf8_encode($enlace->MENU_nombre) . '</a>';
                        } else
                            $subtext = '<a href="javascript:;">' . $enlace->MENU_nombre . '</a>';
                        echo '<li>' . $subtext . '</li>';
                    }
                    ?>
                </ul>
            <?php } ?>
        </li>
    <?php 
    }
                        } ?>

    <div id="salir">   
        <li><a href="<?php echo site_url('index/salir_sistema'); ?>">Salir</a></li>
    </div>
</ul>
