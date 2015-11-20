
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
    <ul href="<?php echo base_url() ?>index.php/configuracion/tipo_matricula/nuevo" id="nuevo_curso" 
        class="lista_botones">
        <li id="nuevo"> Agregar Tipo Matricula </li>
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
                    <th> NOMBRE </th>
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
                        $idTM = $objeto->tm_id;
                        $nombreEstado = describir_estado($objeto->tm_estado);
                ?>
                <tr>
                    <td style="text-align: center"><?=$i?></td>
                    <td style="text-align: center"><?=$objeto->tm_nombre?></td>
                    
                    <td style="text-align: center"><?=$nombreEstado?></td>
                    <td style="text-align: center">
                        <a class="ver_curso" href="<?=base_url()?>index.php/educacion/curso/ver/<?=$idTM?>">
                            <img src="<?=base_url()?>img/ver.png" width="16px" height="16px" border="0" title="Ver Curso" 
                        </a>
                    </td>
                    <td>
                        <a class="editar_curso" href="<?=base_url()?>index.php/educacion/curso/mostrar_editar/<?=$idTM?>">
                            <img src="<?=base_url()?>img/modificar.png" width="16px" height="16px" border="0" title="Modificar Curso" />
                        </a>
                    </td>
                    <td>
                        <a href="javascript:;" onclick="eliminar_curso(<?=$idTM?>)">
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
                    <th align="right" colspan="2"> Total : </th>
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
