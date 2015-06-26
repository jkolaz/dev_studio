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
                        $('#alu_id').val(data.key);
                        $('#paterno').val(data.paterno);
                        $('#materno').val(data.materno);
                        $('#nombre').val(data.nombre);
                        $('#email').val('');
                        $("#paterno").attr('style','background-color: #E8E9EC');
                        $("#materno").attr('style','background-color: #E8E9EC');
                        $("#nombre").attr('style','background-color: #E8E9EC');
                    }else{
                        $('#alu_id').val('');
                        $('#paterno').val('');
                        $('#materno').val('');
                        $('#nombre').val('');
                        $("#paterno").removeAttr('style');
                        $("#materno").removeAttr('style');
                        $("#nombre").removeAttr('style');
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
                        <td>
                            <input type="input" name="dni" id="dni" class="require relacion" maxlength="8" tipo="ALU"/>
                            <input type="hidden" name="alu_id" id="alu_id" value="2"/>
                        </td>
                    </tr>
                    <tr>
                        <td>Apellidos :</td>
                        <td><input type="input" name="paterno" id="paterno" class="require readonly" readonly="readonly"/>
                            <input type="input" name="materno" id="materno" class="require readonly" readonly="readonly"/></td>
                    </tr>
                    <tr>
                        <td>Nombre :</td>
                        <td><input type="input" name="nombre" id="nombre" class="require readonly" readonly="readonly"/></td>
                    </tr>
                    <tr>
                        <td>E-mail :</td>
                        <td><input type="input" name="email" id="email" class="readonly" readonly="readonly"/></td>
                    </tr>
                    <!--<tr>
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
                        <td>
                            Datos de la Madre
                        </td>
                    </tr>
                    <tr>
                        <td>D.N.I :</td>
                        <td><input type="input" name="padre_dni[0]" id="padre_dni_0" class="require readonly" tipo="PAD" maxlength="8" autocomplete="off" readonly="readonly"/></td>
                        <td>D.N.I :</td>
                        <td><input type="input" name="padre_dni[1]" id="padre_dni_1" class="require readonly" tipo="MAD" maxlength="8" autocomplete="off"/></td>
                    </tr>
                    <tr>
                        <td>Nombre del padre</td>
                        <td><input type="input" name="padre_nombre[0]" id="padre_nombre_0" class="require readonly" readonly="readonly"/></td>
                        <td>Nombre del madre</td>
                        <td><input type="input" name="padre_nombre[1]" id="padre_nombre_1" class="require readonly" readonly="readonly"/></td>
                    </tr>
                    <tr>
                        <td>Apellidos del padre</td>
                        <td><input type="input" name="padre_paterno[0]" id="padre_paterno_0" class="require readonly" readonly="readonly"/>
                            <input type="input" name="padre_materno[0]" id="padre_materno_0" class="require readonly" readonly="readonly"/></td>
                        <td>Apellidos del Madre</td>
                        <td><input type="input" name="padre_paterno[1]" id="padre_paterno_1" class="require readonly" readonly="readonly"/>
                            <input type="input" name="padre_materno[1]" id="padre_materno_1" class="require readonly" readonly="readonly"/></td>
                    </tr>-->
                    <tr>
                        <td colspan="4" style="color: #0084E3; font-weight: bold; text-align: center;">GRADO ACADEMICO</td>
                    </tr>
                    <tr>
                        <td>Nivel</td>
                        <td>
                            <select name="nivel" id="nivel" class="require">
                                <option value="">--Seleccione Nivel--</option>
                                <?php
                                foreach ($nivel as $val){
                                ?>
                                <option value="<?=$val->NIVE_id?>"><?=$val->NIVE_nombre?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </td>
                        <td>
                            <select name="grado" id="grado" class="require">
                                <option value="">--Seleccione Grado--</option>
                            </select>
                        </td>
                    </tr>
                    <tr id="cursos">
                        
                    </tr>
                    <tr>
                        <td><input type="submit" class="btn add" name="guardar" id="guardar" value="Registrar Matricula"></td>
                        <td><input type="reset" class="btn danger" name="cancelar" id="cancelar" value="Cancelar"></td>
                    </tr>
                </tbody>
            </table>
        </form>
        <input type="hidden" name="base_url" id="base_url" value="<?php echo base_url() ?>">
    </div>
</div>