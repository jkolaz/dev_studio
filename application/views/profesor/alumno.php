<script type="text/javascript" src="<?php echo base_url() ?>js/fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>js/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>js/fancybox/jquery.fancybox-1.3.4.css" media="screen" />
<script type="text/javascript" charset="utf-8">
    $(document).ready( function() {
        $('#cursos').dataTable( {
            
        } );
    } );
</script>
<script type="text/javascript">
    var refrescar = 0;
    $(document).ready( function() {
        base_url   = $("#base_url").val();
        $(".ver_nota").fancybox( {
            'width'          : 450,
            'height'         : 420,
            'transitionIn'   : 'elastic',
            'transitionOut'  : 'elastic',
            'type'	     : 'iframe'
        } );
        $(".ver_curso").fancybox( {
            'width'          : 700,
            'height'         : 650,
            'transitionIn'   : 'elastic',
            'transitionOut'  : 'elastic',
            'type'	     : 'iframe'
        } );
        $(".profesores").fancybox( {
            'width'          : 1050,
            'height'         : 650,
            'transitionIn'   : 'elastic',
            'transitionOut'  : 'elastic',
            'type'	     : 'iframe'
        } );
        $('#nuevo_curso').click(function(){
            location.href = $(this).attr('href');
        });
        $('#fancybox-close').click(function(){
            if(refrescar == 1){
                refrescar = 0;
                document.location.reload();
            }
        });
    } );
    function refreshPage(param){
        refrescar = param;
    }
</script>

<br><br>
<div id="botonera">
    <ul href="<?php echo base_url() ?>index.php/educacion/curso/mostrar_nuevo" id="nuevo_curso" 
        class="lista_botones">
        <li id="nuevo"> Agregar Curso </li>
    </ul>
</div>

<br>
<div class="header"><?php echo $titulo ?></div>

<div id="container">
    <div class="demo_jui">
        <table cellpadding="0" cellspacing="0" border="0" class="display" id="cursos">
            <thead>
                <tr>
                    <th> N </th>
                    <th> APELLIDOS </th>
                    <th> NOMBRES </th>
                    <th> B1 </th>
                    <th> B2 </th>
                    <th> B3 </th>
                    <th> B4 </th>
                    <th> PG </th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($lista) {
                    $i = 1;
                    foreach ($lista as $objeto) {
                ?>
                <tr>
                    <td style="text-align: center"><?=$i?></td>
                    <td style="text-align: justify; text-transform: uppercase;">
                        <?=$objeto->USUA_apellidoPaterno?> <?=$objeto->USUA_apellidoMaterno?>
                    </td>
                    <td style="text-align: justify"><?=$objeto->USUA_nombres?></td>
                <?php
                        $notaBimestre = 0;
                        $cantBimestre = count($objeto->nota);
                        foreach ($objeto->nota as $nota){
                ?>
                    <td style="text-align: left">
                        <a class="ver_nota" href="<?=base_url()?>index.php/educacion/curso/ver_detalle/<?=$objeto->USUA_id?>/<?=$objeto->GRAD_id?>/<?=$objeto->CURS_id?>/<?=$nota->BIME_id?>">
                            <?=$nota->CALI_parcial1?>
                        </a>
                    </td>
                <?php
                            $notaBimestre += $nota->CALI_parcial1;
                        }
                ?>
                    <td style="text-align: left"><?=grupo_nota(number_format($notaBimestre/$cantBimestre, 2))?></td>
                </tr>
                <?php
                        $i++;
                    }
                }
                ?>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="8" align="right"> </th>
                </tr>
            </tfoot>
        </table>
        <input type="hidden" name="base_url" id="base_url" value="<?php echo base_url() ?>">
    </div>
</div>
<br><br>

<?php
//imprimir($lista);
?>

