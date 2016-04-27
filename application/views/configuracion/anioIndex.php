
<script type="text/javascript" src="<?php echo base_url() ?>js/fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>js/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>js/fancybox/jquery.fancybox-1.3.4.css" media="screen" />
<script type="text/javascript" src="<?php echo $js ?>"></script>

<br><br>
<div id="botonera">
    <ul href="<?php echo $this->_controlador ?>nuevoAnio" id="nuevo" 
        class="lista_botones">
        <li id="nuevo"> Agregar Anio Escolar </li>
    </ul>
</div>

<br>
<div class="header"><?php echo $titulo ?></div>

<div id="container">
    <div class="demo_jui">
        <table cellpadding="0" cellspacing="0" border="0" class="display" id="anio">
            <thead>
                <tr>
                    <th> N </th>
                    <th> AÑO </th>
                    <th> INICIO MATRICULA</th>
                    <th> INICIO DE CLASES</th>
                    <th> FIN DE CLASES</th>
                    <th> ESTADO </th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($lista) {
                    $i = 1;
                    foreach ($lista as $objeto) {
                        $objeto->ANI_estado_html = estado_anio($objeto->ANI_estado);
?>
                <tr>
                    <td><?=$i?></td>
                    <td><?=$objeto->ANI_desc?></td>
                    <td><?=$objeto->ANI_inicio_matricula?></td>
                    <td><?=$objeto->ANI_inicio_clases?></td>
                    <td><?=$objeto->ANI_fin_clases?></td>
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
        <input type="hidden" name="controlador" id="controlador" value="<?php echo $this->_controlador ?>">
    </div>
</div>
<br><br>
