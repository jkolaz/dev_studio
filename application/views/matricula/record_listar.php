<script type="text/javascript" src="<?php echo base_url() ?>js/fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>js/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>js/fancybox/jquery.fancybox-1.3.4.css" media="screen" />
<style>
    #menu th{
        background-color: #494C73;
        font-weight: bold;
        color: #EBEFFC;
        text-align: center;
        padding: 10px;
        font-size: 12px;
    }
    .padre{
        background-color: #B2B7D6;
        color: #494C73;
        font-weight: bold;
        border-top: 1px #000; 
    }
    .info{
        background-color: #A5A9CF;
        color: #404366;
        font-weight: bold;
    }
    .cabecera{
        background-color: #7BA5C8;
        color: #404366;
        font-weight: bold;
    }
    .number{
        background-color: #494C73;
        color: #EBEFFC;
        font-weight: bold;
    }
    .padre a{
        font-weight: bold;
        color: white;
    }
    a{
        font-weight: bold;
        text-decoration: none;
        color: #B2B7D6;
    }
</style>
<br><br>
<div class="header">RECORD ACADEMICO</div>

<div id="container">
    <div class="demo_jui">
        <table cellpadding="0" cellspacing="0" border="1" class="display" id="menu">
            <thead>
                <tr>
                    <th> N </th>
                    <th> GRADO </th>
                    <th> N° ALUMNOS </th>
                    <th colspan="3"> DETALLES</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($GRADOS) {
                    $i = 1;
                    foreach ($GRADOS as $objeto) {
                        $cant = count($objeto->ALUMNOS);
                        $cant_row=$cant+1;
                        if($cant > 0){
                            $cant_row += 1;
                        }
?>
                <tr>
                    <td class="number" rowspan="<?=$cant_row?>"><?=$i?></td>
                    <td class="info" rowspan="<?=$cant_row?>"><b><?=$objeto->GRAD_nombre?></b></td>
                    <td class="info" rowspan="<?=$cant_row?>"><?=$cant?></td>
                <?php
                    if($cant == 0){
                ?>
                    <td colspan="3" class="info">No hay alumnos registrados en este grado.</td>
                <?php
                    }
                ?>
                </tr>
                <?php
                        if($cant > 0){
                ?>
                <tr>
                    <td class="cabecera">APELLIDOS Y NOMBRE(S)</td>
                    <td class="cabecera">D.N.I</td>
                    <td class="cabecera">ESTADO</td>
                </tr>
                <?php
                            foreach ($objeto->ALUMNOS as $value){
                                $estado = estado_record($value->GXU_status);
                                
                ?>
                <tr>
                    <td><?=$value->USUA_apellidoPaterno?> <?=$value->USUA_apellidoMaterno?>, <?=$value->USUA_nombres?></td>
                    <td><?=$value->USUA_dni?></td>
                    <td><?=$estado?></td>
                </tr>
                <?php
                            }
                        }
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
