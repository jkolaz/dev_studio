<html>
    <head>
        <meta charset="utf-8">
        <title>Mi Jazmincito - EDUSOFT</title>
        <script type="text/javascript" src="<?php echo base_url() ?>js/jquery.js"></script>        
        <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>css/estilos.css" media="screen" />
        <style>
            .table_1{
                width: 95%;
                text-align: center;
                border-bottom: 1px solid;
            }
            #btn{
                font-weight: bold;
                color: #FFF;
                background-color: #696969;
                border: 3px #696969 solid;
                padding: 5px 20px 5px 20px;
                font-family: Calibri, Arial;
                font-size: 13px;
                border-radius: 10px;
            }
            #btn:hover {
                color: #696969;
                background-color: #FFF;
                border: 3px #696969 solid;
            }
        </style>
    </head>
    <body>

        <div align="center">
        </div>
        <br>
        <form method="post" action="<?=base_url()?>index.php/educacion/curso/updateNota">
            <input type="hidden" name="idUsuario" id="idUsuario" value="<?=$idUsuario?>" />
            <input type="hidden" name="idGrado" id="idGrado" value="<?=$idGrado?>" />
            <input type="hidden" name="idCurso" id="idCurso" value="<?=$idCurso?>" />
            <input type="hidden" name="idBimestre" id="idBimestre" value="<?=$idBimestre?>" />
        <table class="tablaLineaSimple table_1" cellpadding="2" cellspacing="2">
            <thead class="cabeceraTablaInicio">
                <tr>
                    <td style="width: 95%; font-weight: bold; text-transform: uppercase;" colspan="3">
                    <?php
                        if($bimestre){
                            echo $bimestre[0]->BIME_nombre." - ";
                        }
                        if($usuario){
                            echo $usuario[0]->USUA_nombres." ".$usuario[0]->USUA_apellidoPaterno." ".$usuario[0]->USUA_apellidoMaterno;
                        }
                    ?>
                    </td>
                </tr>
                <tr style="text-align: center;">
                    <td style="width: 10%; font-weight: bold;">N</td>
                    <td style="width: 60%; font-weight: bold;">CRITERIO</td>
                    <td style="width: 25%; font-weight: bold;">NOTA</td>
                </tr>
            </thead>
            <tbody>
                <?php
                $i=1;
                if($lista){
                    foreach ($lista as $value){
                ?>
                <tr>
                    <td style="text-align: center;"><?=$i?></td>
                    <td style="text-align: justify;"><?=$value->CRIT_nombre?></td>
                    <td style="text-align: right; padding-right: 30px;">
                        <?php
                        if($value->CALD_estado == 1){
                        ?>
                        <input type="text" name="criterio[<?=$value->CRIT_id?>]" id="criterio_<?=$value->CRIT_id?>" value="<?=$value->CALD_nota?>" style="width: 40px;"/>
                        <?php    
                        }else{
                            echo $value->CALD_nota;
                        }
                        ?>
                    </td>
                </tr>
                <?php
                        $i++;
                    }
                }
                ?>
                <tr>
                    <td colspan="2" style="font-weight: bold; text-align: right; background-color: #696969; color: white;">PROMEDIO</td>
                    <td style="font-weight: bold; text-align: right; background-color: #696969; color: white; padding-right: 30px;">0.00</td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="2"></td>
                    <td>
                        <input type="submit" name="btn" id="btn" value="Guardar Nota" />
                    </td>
                </tr>
            </tfoot>
        </table>
        </form>
    </body>
</html>

<?php
//imprimir($CRITERIOS);
//imprimir($DETALLE);
?>
