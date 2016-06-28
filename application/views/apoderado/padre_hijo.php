<script type="text/javascript" src="<?php echo base_url() ?>js/sistema/usuario.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>js/fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>js/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>js/fancybox/jquery.fancybox-1.3.4.css" media="screen" />
<script type="text/javascript" charset="utf-8">
    $(document).ready( function() {
        oTable = $('#usuarios').dataTable( {
        } );
    } );
</script>
<br>
<div class="header"><?php echo $titulo ?></div>

<div id="container">
    <div class="demo_jui">
        <table cellpadding="0" cellspacing="0" border="0" class="display" id="usuarios">
            <thead>
                <tr>
                    <th> N </th>
                    <th> APELLIDO<br>PATERNO </th>
                    <th> APELLIDO<br>MATERNO </th>
                    <th> NOMBRES </th>
                    <th> GRADO </th>
                    <th> ACCIONES </th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($alumno) {
                    $i = 1;
                    foreach ($alumno as $objeto) {
                ?>
                <tr>
                    <td><?=$i?></td>
                    <td><?=$objeto->USUA_apellidoPaterno?></td>
                    <td><?=$objeto->USUA_apellidoMaterno?></td>
                    <td><?=$objeto->USUA_nombres?></td>
                    <td><?=$objeto->GRAD_abreviatura?> <?=$objeto->NIVE_nombre?></td>
                    <td>
                    <?php
                    if($objeto->matricula > 0){
                    ?>
                        <a href="<?=  base_url()?>index.php/apoderado/padre/nota/<?=$objeto->USUA_id?>" title="ver notas y horario">
                            Notas
                        </a>&nbsp;&nbsp;
                        <a href="<?=  base_url()?>index.php/apoderado/padre/download/<?=$objeto->USUA_id?>" title="Descarga notas y horario">
                            <img src="<?=base_url()?>img/down.png" width="16" height="16"/>
                        </a>
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
    </div>
</div>
<br><br>
