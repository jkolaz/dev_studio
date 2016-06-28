<script type="text/javascript" src="<?php echo base_url() ?>js/fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>js/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>js/fancybox/jquery.fancybox-1.3.4.css" media="screen" />
<script type="text/javascript">
    var validate_permiso = 0;
</script>
<script type="text/javascript" src="<?php echo base_url() ?>js/configuracion/menu.js"></script>
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
    .aprobo{
        background-color: #0000FF;
        color: #FFF;
        font-weight: bold;
        text-align: center;
    }
    .desaprobo{
        background-color: #FF0000;
        color: #FFF;
        font-weight: bold;
        text-align: center;
    }
</style>
<br>

<br>
<?php
if ($lista) {
?>
<div class="header"><b><?=$lista[0]->USUA_apellidoPaterno?> <?=$lista[0]->USUA_apellidoMaterno?>, <?=$lista[0]->USUA_nombres?> | <?=$lista[0]->GRAD_abreviatura?> <?=$lista[0]->NIVE_abreviatura?></b></div>

<div id="container">
    <div class="demo_jui">
        <table cellpadding="0" cellspacing="0" border="1" class="display" id="menu">
            <thead>
                <tr>
                    <th rowspan="2"> N </th>
                    <th rowspan="2"> CURSO </th>
                    <th colspan="4"> BIMESTRES</th>
                    <th rowspan="2"> PROMEDIO</th>
                    <th rowspan="2"> ESTADO </th>
                </tr>
                <tr>
                    <th>I</th>
                    <th>II</th>
                    <th>III</th>
                    <th>IV</th>
                </tr>
            </thead>
            <tbody>
                <?php
                
                    if($lista[0]->CURSOS){
                    $i = 1;
                        foreach ($lista[0]->CURSOS as $objeto) {
                        
?>
                <tr>
                    <td class="number"><?=$i?></td>
                    <td class="info"><b><?=$objeto->CURS_nombre?></b></td>
                    <?php
                    $sumatoria = 0;
                    foreach($objeto->NOTAS as $notas){
                    ?>
                    <td><?=round($notas->CALI_parcial1)?></td>
                    <?php
                        $sumatoria += $notas->CALI_parcial1;
                    }
                    $promedio = round($sumatoria/4);
                    $class = 'desaprobo';
                    $texto = 'DESAPROBO';
                    if($promedio > 10){
                        $class = 'aprobo';
                        $texto = 'APROBO';
                    }
                    ?>
                    <td><?=$promedio?></td>
                    <td class="<?=$class?>"><?=$texto?></td>
                </tr>
                <?php
                        }
                    }
                
                ?>
            </tbody>
        </table>
        <input type="hidden" name="base_url" id="base_url" value="<?php echo base_url() ?>">
    </div>
</div>
<?php
}
?>
<br><br>
