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
        $("#nuevo").click(function(){
            var url = $(this).attr('href');
            location.href=url;
        });
    } );
</script>

<br><br>
<div id="botonera">
    <ul href="<?php echo base_url() ?>index.php/configuracion/criterio/formulario/nuevo" id="nuevo" 
        class="lista_botones">
        <li id="nuevo"> Agregar Criterio de Evaluación </li>
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
                    <th> NOMBRE </th>
                    <th> ABREVIATURA</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($lista) {
                    $i = 1;
                    foreach ($lista as $objeto) {
?>
                <tr>
                    <td><?=$i?></td>
                    <td><?=$objeto->CRIT_nombre?></td>
                    <td><?=$objeto->CRIT_abreviatura?></td>
                    <td>
                        <a href="<?=base_url()?>index.php/configuracion/criterio/formulario/editar/<?=$objeto->CRIT_id?>">
                            <img src="<?=base_url()?>img/modificar.png" title="Editar <?=$objeto->CRIT_nombre?>" width="16px" />
                        </a>
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
