<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>css/usuario.css" media="screen" />
<script type="text/javascript">
    $(document).ready( function() {
        $("#nivel").change(function(){
            var nivel = $('#nivel').val();
            $.ajax({
                type: "GET",
                cache: false,
                url: "<?=base_url() ?>index.php/educacion/grado/getGradoAjax/"+nivel,
                context: document.body,
                async: false,
                success: function(html)
                {
                    $("#grado").html(html);
                }
            });
        });
        $("#grado").change(function(){
            var grado = $(this).val();
            $.ajax({
                type: "GET",
                cache: false,
                url: "<?=base_url() ?>index.php/educacion/grado/getCursoGrado/"+grado,
                context: document.body,
                async: false,
                success: function(html)
                {
                    $("#cursos").html(html);
                }
            });
        });
        $('.relacion').keyup(function(e){
            //e.preventDefault();
            var tipo = $(this).attr('tipo');
            $.ajax({
                type: "POST",
                cache: false,
                url: "<?=base_url() ?>index.php/seguridad/usuario/relacion",
                data: {tipo: tipo, value: $(this).val()},
                dataType: 'json',
                success: function(data)
                {
                    if(data.return == "1"){
                        $("#padre_mensaje_"+data.tipo).hide();
                        $("#padre_id_"+data.tipo).val(data.key);
                        $("#padre_nombre_"+data.tipo).val(data.nombre);
                        $("#padre_paterno_"+data.tipo).val(data.paterno);
                        $("#padre_materno_"+data.tipo).val(data.materno);
                        $("#padre_fono_"+data.tipo).val(data.telefono);
                        
                        
                        $("#padre_nombre_"+data.tipo).attr('readonly','readonly');
                        $("#padre_paterno_"+data.tipo).attr('readonly','readonly');
                        $("#padre_materno_"+data.tipo).attr('readonly','readonly');
                        $("#padre_fono_"+data.tipo).attr('readonly','readonly');
                        $("#padre_nombre_"+data.tipo).attr('style','background-color: #E8E9EC');
                        $("#padre_paterno_"+data.tipo).attr('style','background-color: #E8E9EC');
                        $("#padre_materno_"+data.tipo).attr('style','background-color: #E8E9EC');
                        $("#padre_fono_"+data.tipo).attr('style','background-color: #E8E9EC');
                    }else{
                        $("#padre_mensaje_"+data.tipo).show();
                        $("#padre_id_"+data.tipo).val("");
                        $("#padre_nombre_"+data.tipo).val("");
                        $("#padre_paterno_"+data.tipo).val("");
                        $("#padre_materno_"+data.tipo).val("");
                        $("#padre_fono_"+data.tipo).val("");
                        
                        $("#padre_nombre_"+data.tipo).removeAttr('readonly');
                        $("#padre_paterno_"+data.tipo).removeAttr('readonly');
                        $("#padre_materno_"+data.tipo).removeAttr('readonly');
                        $("#padre_fono_"+data.tipo).removeAttr('readonly');
                        $("#padre_nombre_"+data.tipo).removeAttr('style');
                        $("#padre_paterno_"+data.tipo).removeAttr('style');
                        $("#padre_materno_"+data.tipo).removeAttr('style');
                        $("#padre_fono_"+data.tipo).removeAttr('style');
                    }
                    
                }
            });
        });
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
    .readonly{
        background-color: #E8E9EC;
    }
</style>
<br><br>
<div class="header">MATRICULA</div>
<div id="container">
    <div class="demo_jui">
    <!-- asa -->
        <form name="form1" id="form1" action="<?=base_url() ?>index.php/<?=$action?>" method="post">
            <table class="tabla" id="usuarios">
                <tbody>
                    <tr>
                        <td>D.N.I. :</td>
                        <td><input type="input" name="dni" id="dni" class="require relacion" maxlength="8"/></td>
                    </tr>
                    <tr>
                        <td>Apellidos :</td>
                        <td><input type="input" name="paterno" id="paterno" class="require readonly" readonly="readonly"/>
                            <input type="input" name="materno" id="materno" class="require readonly" readonly="readonly"/></td>
                    </tr>
                    <tr>
                        <td>Nombre :</td>
                        <td><input type="input" name="nombre" id="nombre" class="require readonly" /></td>
                    </tr>
                    <tr>
                        <td>E-mail :</td>
                        <td><input type="input" name="email" id="email" class="require readonly" readonly="readonly"/></td>
                    </tr>
                    <tr>
                        <td>Sexo</td>
                        <td>
                            <select name="sexo" id="sexo" class="combo" class="require readonly" readonly="readonly" style="background-color: #E8E9EC">
                                <option value="M">Hombre</option>
                                <option value="F">Mujer</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            Datos del Padre
                        </td>
                    </tr>
                    <tr>
                        <td>D.N.I :</td>
                        <td><input type="input" name="padre_dni[0]" id="padre_dni_0" class="require" tipo="PAD" maxlength="8" autocomplete="off" readonly="readonly"/></td>
                        <td><span id="padre_mensaje_0" style="display:none; color: red; font-family: initial, sans-serif; font-size: 9px;">No se encontro ningun registro</span></td>
                    </tr>
                    <tr>
                        <td>Nombre del padre o tutor</td>
                        <td><input type="input" name="padre_nombre[0]" id="padre_nombre_0" class="require readonly" readonly="readonly"/></td>
                    </tr>
                    <tr>
                        <td>Apellidos del padre o tutor</td>
                        <td><input type="input" name="padre_paterno[0]" id="padre_paterno_0" class="require readonly" readonly="readonly"/>
                            <input type="input" name="padre_materno[0]" id="padre_materno_0" class="require readonly" readonly="readonly"/></td>
                    </tr>
                    <tr>
                        <td>
                            Datos de la Madre
                        </td>
                    </tr>
                    <tr>
                        <td>D.N.I :</td>
                        <td><input type="input" name="padre_dni[1]" id="padre_dni_1" class="require" tipo="MAD" maxlength="8" autocomplete="off"/></td>
                        <td><span id="padre_mensaje_1" style="display:none; color: red; font-family: initial, sans-serif; font-size: 9px;">No se encontro ningun registro</span></td>
                    </tr>
                    <tr>
                        <td>Nombre del madre</td>
                        <td><input type="input" name="padre_nombre[1]" id="padre_nombre_1" class="require readonly" readonly="readonly"/></td>
                    </tr>
                    <tr>
                        <td>Apellidos del Madre</td>
                        <td><input type="input" name="padre_paterno[1]" id="padre_paterno_1" class="require readonly" readonly="readonly"/>
                            <input type="input" name="padre_materno[1]" id="padre_materno_1" class="require readonly" readonly="readonly"/></td>
                    </tr>
                    <tr>
                        <td><input type="submit" class="btn add" name="guardar" id="guardar" value="Registrar Matricula"></td>
                        <td><input type="reset" class="btn danger" name="cancelar" id="guardar" value="Cancelar"></td>
                    </tr>
                </tbody>
            </table>
        </form>
        <input type="hidden" name="base_url" id="base_url" value="<?php echo base_url() ?>">
    </div>
</div>