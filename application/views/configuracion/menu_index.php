<script type="text/javascript" src="<?php echo base_url() ?>js/configuracion/menu.js"></script>
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
        <table cellpadding="0" cellspacing="0" border="1" class="display" id="menu">
            <thead>
                <tr>
                    <th> N </th>
                    <th> NOMBRE </th>
                    <th> N° </th>
                    <th> DEPENDENCIAS</th>
                    <th> RUTA</th>
                    <th> PUBLICO</th>
                    <th> VISTA</th>
                    <th> ESTADO </th>
                    <th> ACCIONES </th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($lista) {
                    $i = 1;
                    foreach ($lista as $objeto) {
                        $sub_menu = 0;
                        if(is_array($objeto->SUB_MENU)){
                            $sub_menu = count($objeto->SUB_MENU);
                            $row = $sub_menu+2;
                        }else{
                            $row = $sub_menu+1;
                        }                  
?>
                <tr>
                    <td class="number" rowspan="<?=$row?>"><?=$i?></td>
                    <td class="info" rowspan="<?=$row?>"><?=$objeto->MENU_nombre?></b></td>
                    <td class="info" rowspan="<?=$row?>"><?=$sub_menu?></td>
                    
<?php
                        if($sub_menu == 0){
?>
                    <td class="padre">PADRE</td>
                    <td class="padre"><b><?=$objeto->MENU_ruta?></td>
                    <td class="padre"><?=estado_publico($objeto->MENU_is_public)?></td>
                    <td class="padre"><?=estado_publico($objeto->MENU_is_view)?></td>
                    <td class="padre">-</td>
                    <td class="padre">
                        <a href="javascript:;" onclick="editar(<?=$objeto->MENU_id?>)">
                            <img src="<?=base_url()?>img/modificar.png" width="16px" height="16px" border="0" title="Editar menú" /> Editar
                        </a><br>
                        <a href="javascript:;" onclick="desactivar(<?=$objeto->MENU_id?>, 'desactivar')">
                            <img src="<?=base_url()?>img/eliminar.png" width="16px" height="16px" border="0" title="Desactivar menú" /> Desactivar
                        </a>
                    </td>
<?php                            
                        }
?>
                </tr>
<?php
                        if($sub_menu > 0){
?>
                <tr>
                    <td class="padre">PADRE</td>
                    <td class="padre"><b><?=$objeto->MENU_ruta?></b></td>
                    <td class="padre"><?=estado_publico($objeto->MENU_is_public)?></td>
                    <td class="padre"><?=estado_publico($objeto->MENU_is_view)?></td>
                    <td class="padre">-</td>
                    <td class="padre">
                        <a href="javascript:;" onclick="editar(<?=$objeto->MENU_id?>)">
                            <img src="<?=base_url()?>img/modificar.png" width="16px" height="16px" border="0" title="Editar menú" /> Editar
                        </a><br>
                        <a href="javascript:;" onclick="desactivar(<?=$objeto->MENU_id?> ,'desactivar')">
                            <img src="<?=base_url()?>img/eliminar.png" width="16px" height="16px" border="0" title="Desactivar menú" /> Desactivar
                        </a>
                    </td>
                </tr>
<?php
                            foreach ($objeto->SUB_MENU as $val){
                ?>
                <tr>
                    <td><?=$val->MENU_nombre?></td>
                    <td><b><?=$val->MENU_ruta?></b></td>
                    <td><?=estado_publico($val->MENU_is_public)?></td>
                    <td><?=estado_publico($val->MENU_is_view)?></td>
                    <td>-</td>
                    <td>
                        <a href="javascript:;" onclick="editar(<?=$val->MENU_id?>)">
                            <img src="<?=base_url()?>img/modificar.png" width="16px" height="16px" border="0" title="Editar menú" /> Editar
                        </a><br>
                        <a href="javascript:;" onclick="desactivar(<?=$val->MENU_id?>, 'desactivar')">
                            <img src="<?=base_url()?>img/eliminar.png" width="16px" height="16px" border="0" title="Desactivar menú" /> Desactivar
                        </a>
                    </td>
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
