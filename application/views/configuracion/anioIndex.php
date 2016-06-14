
<script type="text/javascript" src="<?php echo base_url() ?>js/fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>js/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>js/fancybox/jquery.fancybox-1.3.4.css" media="screen" />
<script type="text/javascript" src="<?php echo $js ?>"></script>

<br>

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
                    <th> ALUMNOS</th>
                    <th> ESTADO </th>
                    <th> ACCIONES </th>
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
                    <td>
                        <?=$i?>
                        <input type="hidden" name="anio_h" id="anio_h" value="<?=$objeto->ANI_id?>"/>
                    </td>
                    <td><?=$objeto->ANI_desc?></td>
                    <td>
                        <?php
                        if($objeto->ANI_estado == 1){
                        ?>
                        <a id="a_inicio_clases" href="javascript:;" ><?=$objeto->ANI_inicio_matricula?></a>
                        <div id="div_inicio_clases" style="height: 80px; display: none;">
                            <input type="text" name="inicio_matricula" id="inicio_matricula" value="" />
                            <br>
                            <label>
                                <button class="btn btn-success">Guardar</button>
                                <button id="cancelar_inicio_clases" class="btn btn-danger">Cancelar</button>
                            </label>
                            <small></small>
                        </div>
                        <?php
                        }else{
                            echo $objeto->ANI_inicio_matricula;
                        }
                        ?>
                    </td>
                    <td>
                        <?php
                        if($objeto->ANI_estado == 1){
                        ?>
                        <a href="javascript:;" onclick="inicio_clases(<?=$objeto->ANI_id?>)"><?=$objeto->ANI_inicio_clases?></a>
                        <?php
                        }else{
                            echo $objeto->ANI_inicio_clases;
                        }
                        ?>
                    </td>
                    <td>
                        <?php
                        if($objeto->ANI_estado == 1){
                        ?>
                        <a href="javascript:;" onclick="fin_clases(<?=$objeto->ANI_id?>)"><?=$objeto->ANI_fin_clases?></a>
                        <?php
                        }else{
                            echo $objeto->ANI_fin_clases;
                        }
                        ?>
                    </td>
                    <td>
                        <?php
                        if($objeto->ANI_estado == 1){
                            echo '---';
                        }else{
                        ?>
                        <a href="<?=base_url()?>index.php/matricula/record/listar/<?=$objeto->ANI_id?>">
                            <img src="<?=base_url()?>img/usuarios.png">
                        </a>
                        <?php
                        }
                        ?>
                    </td>
                    <td><?=$objeto->ANI_estado_html?></td>
                    <td>
                        <?php
                        if($objeto->ANI_estado == 1){
                        ?>
                        <a href="javascript:;" onclick="cerrar_anio(<?=$objeto->ANI_id?>)">Cerrar Año</a>
                        <?php
                        }else{
                            echo '---';
                        }
                        ?>
                    </td>
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
