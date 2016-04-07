<script type="text/javascript" src="<?php echo base_url() ?>js/sistema/rol.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>js/fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>js/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>js/fancybox/jquery.fancybox-1.3.4.css" media="screen" />
<script type="text/javascript" charset="utf-8">
    $(document).ready( function() {
        
    } );
</script>
<script type="text/javascript">
    $(document).ready( function() {
        base_url   = $("#base_url").val();
        $("#nuevo_rol").fancybox( {
            'width'          : 700,
            'height'         : 650,
            'transitionIn'   : 'elastic',
            'transitionOut'  : 'elastic',
            'type'	     : 'iframe'
        } );
        $(".editar_rol").fancybox( {
            'width'          : 700,
            'height'         : 650,
            'transitionIn'   : 'elastic',
            'transitionOut'  : 'elastic',
            'type'	     : 'iframe'
        } ); 
        $(".ver_rol").fancybox( {
            'width'          : 700,
            'height'         : 650,
            'transitionIn'   : 'elastic',
            'transitionOut'  : 'elastic',
            'type'	     : 'iframe'
        } );
    } );
</script>

<br><br>
<div id="botonera">
    <ul href="<?php echo base_url() ?>index.php/seguridad/rol/mostrar_nuevo" id="nuevo_rol" 
        class="lista_botones">
        <li id="nuevo"> Agregar Anio Escolar </li>
    </ul>
</div>

<br>
<div class="header">Menú</div>

<div id="container">
    <div class="demo_jui">
        <table cellpadding="0" cellspacing="0" border="1" class="display" id="rolesd">
            <thead>
                <tr>
                    <th> N </th>
                    <th> NOMBRE </th>
                    <th> RUTA</th>
                    <th> DEPENDENCIAS</th>
                    <th> ESTADO </th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($lista) {
                    $i = 1;
                    foreach ($lista as $objeto) {
                        $sub_menu = 0;
                        if($objeto->SUB_MENU){
                            $sub_menu = count($objeto->SUB_MENU);
                        }
                        $row = $sub_menu+1;
?>
                <tr>
                    <td rowspan="<?=$row?>"><?=$i?></td>
                    <td rowspan="<?=$row?>"><?=$objeto->MENU_nombre?> <b>(<?=$sub_menu?>)</b></td>
                    <td rowspan="<?=$row?>"><b><?=$objeto->MENU_ruta?></b></td>
<?php
                        if($sub_menu == 0){
?>
                    <td>-</td>
                    <td>-</td>
<?php                            
                        }
?>
                </tr>
<?php
                        if($sub_menu > 0){
                            foreach ($objeto->SUB_MENU as $val){
                ?>
                <tr>
                    <td><?=$val->MENU_nombre?></td>
                    <td>-</td>
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
