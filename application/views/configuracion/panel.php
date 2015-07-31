<script type="text/javascript" src="<?php echo base_url() ?>js/fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>js/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>js/fancybox/jquery.fancybox-1.3.4.css" media="screen" />
<script type="text/javascript" src="<?php echo base_url() ?>js/configuracion/panel.js"></script>
<input type="hidden" name="base_url" id="base_url" value="<?=  base_url()?>">
<br><br>
<div id="botonera">
    <ul href="<?php echo base_url() ?>index.php/seguridad/rol/mostrar_nuevo" id="nuevo_rol" 
        class="lista_botones">
        <li id="nuevo"> Agregar Anio Escolar </li>
    </ul>
</div>

<br>
<div class="header"><?php echo $titulo ?></div>

<div id="container">
    <div class="demo_jui">
        <table cellpadding="0" cellspacing="0" border="0" class="display" id="roles">
            <thead>
                <tr>
                    <th> N </th>
                    <th> SECCIÓN </th>
                    <?=$thRol?>
                    <th> ESTADO</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($panel) {
                    $i = 1;
                    foreach ($panel as $objeto) {
                        $objeto->ANI_estado_html = estado_panel($objeto->PAN_id, $objeto->PAN_estado, $objeto->PAN_permanente);
?>
                <tr>
                    <td><?=$i?></td>
                    <td style="font-weight:bold; text-transform: uppercase;"><?=$objeto->PAN_nombre?></td>
<?php
                    foreach ($objeto->roles as $rol){
?>
                    <td><?=checkbox_rol($rol->nombre, 'seleccionar',$objeto->PAN_id, $rol->id, $rol->check, $objeto->PAN_permanente)?></td>
<?php
                    }
?>
                    <td><?=$objeto->ANI_estado_html?></td>
                </tr>
<?php
                        $i++;
                    }
                }
                ?>
            </tbody>
        </table>
        <input type="hidden" name="base_url" id="base_url" value="<?php echo base_url() ?>">
    </div>
</div>
<br><br>
