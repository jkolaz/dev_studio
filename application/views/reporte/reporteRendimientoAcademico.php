
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
                var prom = totalHoras/iEnd;
                nCells[1].innerHTML = '<b>' + Math.round(prom) + '&nbsp&nbsp</b>';
            }
        } );
    } );
</script>
<script type="text/javascript">
    var refrescar = 0;
    $(document).ready( function() {
        base_url   = $("#base_url").val();
        
        $("#enviar_correo").fancybox( {
            'width'          : 380,
            'height'         : 138,
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
<style>
    #dato_alumno{
        width: 80%;
        font-family: sans-serif;
        font-size: 14px;
    }
    .cab{
        width: 70px;
        height: 25px;
    }
    .valor{
        font-weight: normal;
    }
    a {
        text-decoration: none;
    }
    .btn {
        -moz-border-bottom-colors: none;
        -moz-border-left-colors: none;
        -moz-border-right-colors: none;
        -moz-border-top-colors: none;
        border-image: none;
        border-radius: 4px 4px 4px 4px;
        border-style: solid;
        border-width: 1px;
        box-shadow: 0 1px 0 rgba(255, 255, 255, 0.2) inset, 0 1px 2px rgba(0, 0, 0, 0.05);
        cursor: pointer;
        display: inline-block;
        font-size: 14px;
        line-height: 20px;
        margin-bottom: 0;
        padding: 4px 12px;
        text-align: center;
        vertical-align: middle;
    }
    .btn-info {
        background-color: #49AFCD;
        background-image: linear-gradient(to bottom, #5BC0DE, #2F96B4);
        background-repeat: repeat-x;
        border-color: rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.25);
        color: #FFFFFF;
        text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.25);
    }
    .btn:hover{
        color:#FFFFFF;
        text-decoration:none;
        background-position:0 -15px;
        -webkit-transition:background-position .1s linear;
        -moz-transition:background-position .1s linear;
        -o-transition:background-position .1s linear;
        transition:background-position .1s linear;
    }
    .btn-info:hover{
        color:#fff;
        background-color:#2f96b4;
    }
</style>
<br>
<br>
<div class="header"><?php echo $titulo ?></div>

<div id="container">
    <div class="demo_jui">
        <table id="dato_alumno">
            <tr>
                <th class="cab">Alumno</th>
                <th class="valor"><?=utf8_decode($lista->USUA_nombres.' '.$lista->USUA_apellidoPaterno.' '.$lista->USUA_apellidoMaterno)?></th>
                <th class="cab">Código</th>
                <th class="valor"><?=$lista->USUA_codigo?></th>
            </tr>
            <tr>
                <th class="cab">GRADO</th>
                <th class="valor"><?=utf8_decode($lista->GRAD_abreviatura.' de '.$lista->NIVE_nombre)?></th>
                <th class="cab">PDF</th>
                <th class="valor">
                    <a href="<?=SERVER_PDF.$lista->PDF?>" target="_blanck"><?=$lista->PDF?></a>
                    <a href="<?=base_url() ?>index.php/reporte/Reporte/enviarPDF/<?=$lista->PDF?>" id="enviar_correo" class="btn btn-info">Enviar Reporte</a>
                </th>
            </tr>
        </table>
        <br>
        <table cellpadding="0" cellspacing="0" border="0" class="display" id="cursos">
            <thead>
                <tr>
                    <th rowspan="2">ASIGNATURA</th>
                    <th colspan="4">BIMESTRE</th>
                    <th rowspan="2">PROMEDIO</th>
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
                if(count($lista->CURSOS) > 0){
                    foreach ($lista->CURSOS as $value){
                        $prom = 0;
                ?>
                <tr>
                    <td style="text-align: justify"><?=$value->CURS_nombre?></td>
                    <?php
                    foreach($value->NOTAS as $val){
                    ?>
                    <td style="text-align: center"><?=  number_format($val->CALI_parcial1)?></td>
                    <?php
                        $prom += $val->CALI_parcial1;
                    }
                    ?>
                    <td style="text-align: center"><?= number_format($prom/4)?></td>
                </tr>
                <?php
                    }
                }
                ?>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="5" style="text-align: right; font-weight: bold; padding-right: 55px;"> PROMEDIO GENERAL : </th>
                    <th style="text-align: center"></th>
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
