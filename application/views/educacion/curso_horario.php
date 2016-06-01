
<script type="text/javascript" src="<?php echo base_url() ?>js/fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>js/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>js/fancybox/jquery.fancybox-1.3.4.css" media="screen" />
<script type="text/javascript" charset="utf-8">
</script>
<br>
<br>
<div class="header"><?php echo $titulo ?></div>

<div id="container">
    <div class="demo_jui">
        <table cellpadding="0" cellspacing="0" border="0" class="display" id="cursos">
            <thead>
                <tr>
                    <th> INICIO </th>
                    <th> FIN </th>
                    <th> LUNES </th>
                    <th> MARTES </th>
                    <th> MIERCOLES </th>
                    <th> JUEVES </th>
                    <th> VIERNES </th>
                </tr>
            </thead>
            <tbody>
                <?php
                $dia_actual = date('Y-m-d');
                $actual = date('Y-m-d H:i:s');
                $dia_num = date('N', strtotime($actual));
                $dia = date('Y-m-d').' 08:00:00';
                $curso = '';
                $hi = strtotime($dia);
                for($i=1; $i <= 8; $i++){
                    $hf = $hi+(40*60);
                    
                    if($i==4){
                        $hf = $hi+(20*60);
                    }
                    if($lista){
                        
                    }
                ?>
                <tr>
                    <td style="text-align: center"><?=date('H:i', $hi)?></td>
                    <td style="text-align: center"><?=date('H:i', $hf)?></td>
                <?php
                    for($j=1; $j <= 5; $j++){
                        $curso = '';
                        foreach($lista as $value){
                            if($i == 4){
                                $curso = 'RECREO';
                            }else{
                                if($j == $value->HOR_num_dia){
                                    if(date('H:i', $hi).':00' == $value->HOR_inicio){
                                        $curso = $value->CURS_nombre;
                                        if($dia == $value->HOR_num_dia){
                                            $curso = '<a title="Asistencia">'.$curso.'</a>';
                                        }
                                        break;
                                    }
                                }
                            }
                        }
                ?>
                    <td style="text-align: left"><?=$curso?></td>
                <?php
                    }
                ?>
                </tr>
                <?php
                    $hi = $hf;
                }
                ?>
            </tbody>
        </table>
        <input type="hidden" name="base_url" id="base_url" value="<?php echo base_url() ?>">
    </div>
</div>
<br>
<br>