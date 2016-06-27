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
        <script>
            $(document).ready( function(){
                var nota = 0;
                var criterio = 5;
                $('.criterio').each( function(index, value){
                    nota += parseFloat($(this).val());
                });
                $('#prom').val(Math.round((nota/criterio).toFixed(2)));
                $('.criterio').keypress( function(e){
                    //alert(e.which);
                    if(e.which < 8){
                        return false;
                    }else if(e.which > 8 && e.which < 35){
                        return false;
                    }else if(e.which > 40 && e.which < 46){
                        return false;
                    }else if(e.which > 46 && e.which < 48){
                        return false;
                    }else if(e.which > 57 && e.which < 110){
                        return false;
                    }else if(e.which > 110 && e.which > 190){
                        return false;
                    }else if(e.which > 190){
                        return false;
                    }
                });
                
                $('#btn').click(function(){
                    var contador = 0;
                    $('.criterio').each( function(index, value){
                        if($(this).val() < 0 || $(this).val() > 20){
                            contador ++;
                            $('#criterio_'+$(this).attr('id_nota')).attr('style', 'border-color: red; width: 40px;');
                        }
                        
                    });
                    if(contador > 0){
                        return false;
                    }
                });
            });
        </script>
    </head>
    <body>

        <div align="center">
        </div>
        <br>
        <form method="post" action="<?=base_url()?>index.php/educacion/curso/updateNotaNew">
            <input type="hidden" name="idCalificacion" id="idCalificacion" value="<?=$calificacion[0]->CALI_id?>" />
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
                        <input type="text" class="criterio" id_nota="<?=$value->CALD_id?>" name="criterio[<?=$value->CALD_id?>]" id="criterio_<?=$value->CALD_id?>" value="<?=$value->CALD_nota?>" style="width: 40px;" <?=$readonly?>/>
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
                    <td style="font-weight: bold; text-align: right; background-color: #696969; color: white; padding-right: 30px;">
                        <input type="text" name="prom" id="prom" value="0.00" readonly="readonly" style="width: 40px;"/>
                    </td>
                </tr>
            </tbody>
            <?php
            if($rol==2){
            ?>
            <tfoot>
                <tr>
                    <td colspan="2"></td>
                    <td>
                        <input type="submit" name="btn" id="btn" value="Guardar Nota" />
                    </td>
                </tr>
            </tfoot>
            <?php
            }
            ?>
        </table>
        </form>
    </body>
</html>

