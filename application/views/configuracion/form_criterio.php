<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>css/usuario.css" media="screen" />
<script type="text/javascript">
    $(document).ready( function() {
        
        $('#guardar').click(function(){
            var contador = 0;
            $('.require').each(function(){
                if($(this).val() == ""){
                    contador ++;
                    $(this).attr('style', 'border-color: red;');
                }
            });
            if(contador > 0){
                return false;
            }
        });
        $('#cancelar').click( function(){
            var url = '<?=base_url()?>index.php/configuracion/criterio';
            location.href=url;
        }); 
    } );
</script>
<style>
    #cursos{
        color: #0063DC;
    }
</style>
<br><br>
<div class="header"><?=$titulo?></div>
<div id="container">
    <div class="demo_jui">
    <!-- asa -->
        <form name="form1" id="form1" action="<?=base_url() ?>index.php/configuracion/criterio/update" method="post">
            <input type="hidden" name="criterio" id="criterio" value="<?=$idCriterio?>" />
            <input type="hidden" name="action" id="action" value="<?=$action?>" />
            <table class="tabla" id="usuarios">
                <tbody>
                    <tr>
                        <td>Nombre Curso:</td>
                        <td><input type="input" name="nombre" id="nombre" class="require" value="<?=$criterio->CRIT_nombre?>"/></td>
                    </tr>
                    <tr>
                        <td>Abreviatura:</td>
                        <td><input type="input" name="abreviatura" id="abreviatura" class="require" value="<?=$criterio->CRIT_abreviatura?>"/></td>
                    </tr>
                    <tr>
                        <td><input type="submit" class="btn add" name="guardar" id="guardar" value="Guardar"></td>
                        <td><input type="submit" class="btn danger" name="cancelar" id="cancelar" value="Cancelar"></td>
                    </tr>
                </tbody>
            </table>
        </form>
        <input type="hidden" name="base_url" id="base_url" value="<?php echo base_url() ?>">
    </div>
</div>