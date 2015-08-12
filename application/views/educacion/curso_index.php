<script type="text/javascript" src="<?php echo base_url() ?>js/educacion/grado.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>js/fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>js/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>js/fancybox/jquery.fancybox-1.3.4.css" media="screen" />
<script type="text/javascript" charset="utf-8">
    $(document).ready( function() {
        $('#cursos').dataTable( {
            "fnFooterCallback": function ( nRow, aaData, iStart, iEnd, aiDisplay ) {
                var totalHoras = 0;
                for ( var i=iStart ; i<iEnd ; i++ ) {
                    totalHoras += aaData[ aiDisplay[i] ][4]*1;
                }
                var nCells = nRow.getElementsByTagName('th');
                nCells[1].innerHTML = '<b>' + parseInt(totalHoras) + '&nbsp&nbsp</b>';
            }
        } );
    } );
</script>
<script type="text/javascript">
    $(document).ready( function() {
        base_url   = $("#base_url").val();
        
        $(".ver_curso").fancybox( {
            'width'          : 700,
            'height'         : 650,
            'transitionIn'   : 'elastic',
            'transitionOut'  : 'elastic',
            'type'	     : 'iframe'
        } );
        $(".profesores").fancybox( {
            'width'          : 1024,
            'height'         : 650,
            'transitionIn'   : 'elastic',
            'transitionOut'  : 'elastic',
            'type'	     : 'iframe'
        } );
        $('#nuevo_curso').click(function(){
            location.href = $(this).attr('href');
        });
    } );
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
                    <th> NIVEL </th>
                    <th> GRADO </th>
                    <th> CURSO </th>
                    <th> HORAS </th>
                    <th> PROFESORES </th>
                    <th> ESTADO </th>
                    <th>&nbsp;&nbsp;</th>
                    <th>&nbsp;&nbsp;</th>
                    <th>&nbsp;&nbsp;</th>
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
                    <td style="text-align: left"><?=$objeto->CURS_nombre?></td>
                    <td style="text-align: center"><?=$objeto->CURS_horas?></td>
                    <td style="text-align: center">
                        <a href="<?=base_url()?>index.php/educacion/curso/verProfesores/<?=$idCurso?>" class="profesores">
                            <img src="<?=base_url()?>img/persona.GIF" width="16px" height="16px"/>
                            <?=$objeto->profesores?>
                        </a>
                    </td>
                    <td style="text-align: center"><?=$nombreEstado?></td>
                    <td style="text-align: center">
                        <a class="ver_curso" href="<?=base_url()?>index.php/educacion/curso/ver/<?=$idCurso?>">
                            <img src="<?=base_url()?>img/ver.png" width="16px" height="16px" border="0" title="Ver Curso" 
                        </a>
                    </td>
                    <td>
                        <a class="editar_curso" href="<?=base_url()?>index.php/educacion/curso/mostrar_editar/<?=$idCurso?>">
                            <img src="<?=base_url()?>img/modificar.png" width="16px" height="16px" border="0" title="Modificar Curso" />
                        </a>
                    </td>
                    <td>
                        <a href="javascript:;" onclick="eliminar_curso(<?=$idCurso?>)">
                            <img src="<?=base_url()?>img/eliminar.png" border="0" width="16px" height="16px" title="Eliminar Curso" />
                        </a>
                    </td>
                </tr>
                <?php
                        $i++;
                    }
                }
                ?>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="4" align="right"> Total : </th>
                    <th align="right"></th>
                    <th align="right"></th>
                    <th align="center"></th>
                    <th align="center"></th>
                    <th align="center"></th>
                    <th align="center"></th>
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
