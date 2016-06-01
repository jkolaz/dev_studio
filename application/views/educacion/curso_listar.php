
<script type="text/javascript" src="<?php echo base_url() ?>js/fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>js/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>js/fancybox/jquery.fancybox-1.3.4.css" media="screen" />
<script type="text/javascript" charset="utf-8">
    $(document).ready( function() {
        $('#cursos').dataTable( {
            "fnFooterCallback": function ( nRow, aaData, iStart, iEnd, aiDisplay ) {
                var totalHoras = 0;
                for ( var i=iStart ; i<iEnd ; i++ ) {
                    totalHoras += aaData[ aiDisplay[i] ][5]*1;
                }
                var nCells = nRow.getElementsByTagName('th');
                nCells[1].innerHTML = '<b>' + parseInt(totalHoras) + '&nbsp&nbsp</b>';
            }
        } );
    } );
</script>
<script type="text/javascript">
    var refrescar = 0;
    $(document).ready( function() {
        base_url   = $("#base_url").val();
        
        $(".ver_curso").fancybox( {
            'width'          : 700,
            'height'         : 650,
            'transitionIn'   : 'elastic',
            'transitionOut'  : 'elastic',
            'type'	     : 'iframe'
        } );
        $(".criterio").fancybox( {
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

<br>
<?php
if($rol == 1){
?>
<br>
<div id="botonera">
    <ul href="<?php echo base_url() ?>index.php/educacion/curso/mostrar_nuevo" id="nuevo_curso" 
        class="lista_botones">
        <li id="nuevo"> Agregar Curso </li>
    </ul>
</div>
<?php
}
?>
<br>
<div class="header"><?php echo $titulo ?></div>

<div id="container">
    <div class="demo_jui">
        <table cellpadding="0" cellspacing="0" border="0" class="display" id="cursos">
            <thead>
                <tr>
                    <th> N </th>
                    <th> NIVEL </th>
                    <th> GRADO </th>
                    <th> CURSO </th>
                    <th> CRITERIOS <br> DE EVALUACIÓN </th>
                    <th> HORARIO </th>
                    <th> ESTADO </th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($lista) {
                    $i = 1;
                    foreach ($lista as $objeto) {
                        $idCurso = $objeto->CURS_id;
                        $nombreEstado = describir_estado($objeto->CURS_estado);
                ?>
                <tr>
                    <td style="text-align: center"><?=$i?></td>
                    <td style="text-align: center"><?=$objeto->NIVE_nombre?></td>
                    <td style="text-align: center"><?=$objeto->GRAD_nombre?></td>
                    <td style="text-align: left">
                        <a href="<?=base_url()?>index.php/profesor/profesor/index/<?=$objeto->CURS_id?>">
                            <?=$objeto->CURS_nombre?>
                        </a>
                    </td>
                    <td style="text-align: left">
                        <a class="criterio" href="<?=base_url()?>index.php/profesor/profesor/criterio/<?=$objeto->ASIG_id?>">
                            <img src="<?=base_url()?>img/pedidos.png" title="Criterios de Evaluacion - <?=$objeto->CURS_nombre?>">
                        </a>
                    </td>
                    <td style="text-align: center">
                        <a class="horario" href="<?=base_url()?>index.php/educacion/curso/horario/<?=$objeto->CURS_id?>">
                            <img src="<?=base_url()?>img/calendar.png" title="Horario - <?=$objeto->CURS_nombre?>">
                        </a>
                    </td>
                    <td style="text-align: center"><?=$nombreEstado?></td>
                </tr>
                <?php
                        $i++;
                    }
                }
                ?>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="5" align="right"> Total : </th>
                    <th align="right"></th>
                    <th align="right"></th>
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
