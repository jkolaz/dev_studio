<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>css/usuario.css" media="screen" />
<script type="text/javascript">
    $(document).ready( function() {
        $('#guardar').click(function(e){
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
            
    } );
</script>
<style>
    #cursos{
        color: #0063DC;
    }
</style>
<br><br>
<div class="header">MATRICULA</div>
<div id="container">
    <div class="demo_jui">
    <!-- asa -->
        <form name="form1" id="form1" action="<?=base_url() ?>index.php/seguridad/usuario/insertprofesor" method="post">
            <table class="tabla" id="usuarios">
                <tbody>
                    <tr>
                        <td>Nombre :</td>
                        <td><input type="input" name="nombre" id="nombre" class="require"/></td>
                    </tr>
                    <tr>
                        <td>Apellidos :</td>
                        <td><input type="input" name="paterno" id="paterno" class="require"/>
                            <input type="input" name="materno" id="materno" class="require"/></td>
                    </tr>
                    <tr>
                        <td>D.N.I. :</td>
                        <td><input type="input" name="dni" id="dni" class="require"/></td>
                    </tr>
                    <tr>
                        <td>E-mail :</td>
                        <td><input type="input" name="email" id="email" class="require"/></td>
                    </tr>
                    <tr>
                        <td>Sexo</td>
                        <td>
                            <select name="sexo" id="sexo" class="combo" class="require">
                                <option value="M">Hombre</option>
                                <option value="F">Mujer</option>
                            </select>
                        </td>
                    </tr>
                    
                    <tr>
                        <td><input type="submit" class="btn add" name="guardar" id="guardar" value="Guardar"></td>
                        <td><input type="reset" class="btn danger" name="cancelar" id="guardar" value="Cancelar"></td>
                    </tr>
                </tbody>
            </table>
        </form>
        <input type="hidden" name="base_url" id="base_url" value="<?php echo base_url() ?>">
    </div>
</div>