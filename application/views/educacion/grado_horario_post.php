<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>js/fancybox/jquery.fancybox-1.3.4.css" media="screen" />
<script type="text/javascript">
    var validate_permiso = 0;
</script>
<script type="text/javascript" src="<?=$js?>"></script>
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
</style>
<br><br>

<br>
<div class="header">HORARIO</div>

<div id="container">
    <div class="demo_jui">
        <form name="form1" id="form1" action="post" action>
            <table cellpadding="0" cellspacing="0" border="1" class="display" id="menu">
                <thead>
                    <tr>
                        <th> N </th>
                        <th> INICIO </th>
                        <th> FIN </th>
                        <th> LUNES</th>
                        <th> MARTES</th>
                        <th> MIERCOLES</th>
                        <th> JUEVES</th>
                        <th> VIERNES </th>
                    </tr>
                </thead>
                <tbody>
                <?php
                if ($excel) {
                    $i = 1;
                    foreach ($excel as $index=>$value) {
                        if($index >= 3){
                            $inicio = $value['A'];
                            $fin = $value['B'];
                            $curso =  $value['C'];
?>
                    <tr>
                        <td class="number" ><?=$i?></td>
                        <td class="info"><?=$value['A']?></td>
                        <td class="info"><?=$value['B']?></td>
                        <td><?=$value['C']?></td>
                        <td><?=$value['D']?></td>
                        <td><?=$value['E']?></td>
                        <td><?=$value['F']?></td>
                        <td><?=$value['G']?></td>
                    </tr>
<?php
                            $i++;
                        }
                    }
                }
                ?>
                </tbody>
            </table>
        </form>
        <input type="hidden" name="base_url" id="base_url" value="<?php echo base_url() ?>">
    </div>
</div>
<br><br>
