<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>css/usuario.css" media="screen" />
<script type="text/javascript">
    $(document).ready( function() {
        
        $('#txt_dni').focus();
        
        $('#guardar_RA').click(function(e){
            var contador = 0;
            $('.require').each(function(){
                if($(this).val() == "" || $(this).val() == "0"){
                    contador ++;
                    $(this).attr('style', 'border-color: red;');
                }
            });
            if(contador > 0){
                return false;
            }
        });
        $('#form1').validate();
    });
</script>
<br><br>
<div class="header">REPORTES</div>
<div id="container">
    <div class="demo_jui">
    <!-- asa -->
        <form name="form1" id="form1" action="<?=base_url() ?>index.php/reporte/Reporte/<?=$action?>" method="post">
            <table class="tabla" id="usuarios">
                <tbody>
                    <tr>
                        <td>Rendimiento Academico</td>
                        <td>
                            <input type="text" name="txt_dni" id="txt_dni" class="required number" maxlength="8" minlength="8" placeholder="Ingrese DNI del alumno" autocomplete="off"/>
                        </td>
                        <td><input type="submit" class="btn add" name="guardar_RA" id="guardar_RA" value="Generar Reporte"></td>
                        <td><input type="reset" class="btn danger" name="cancelar" id="cancelar" value="Limpiar"></td>
                    </tr>
                </tbody>
            </table>
        </form>
        <input type="hidden" name="base_url" id="base_url" value="<?php echo base_url() ?>">
    </div>
</div>