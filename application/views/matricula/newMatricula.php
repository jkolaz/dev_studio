<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>css/usuario.css" media="screen" />
<script type="text/javascript">
    $(document).ready( function() {
        $("#grado").change(function(){
            var grado = $(this).val();
            $.ajax({
                type: "GET",
                cache: false,
                url: "<?=base_url() ?>index.php/educacion/grado/getCursoGrado/"+grado,
                context: document.body,
                async: false,
                dataType: 'json',
                success: function(html)
                {
                    if(html.result > 0){
                        $("#cursos").html(html.title);
                        var cursos = html.cursos;
                        var tabla   = document.createElement("table");
                        var tblBody = document.createElement("tbody");
                        for(var cont=0;cont < cursos.length; cont++){
                            var hilera = document.createElement("tr");
                            var celda = document.createElement("td");
                            var nombre =cursos[cont]['CURS_nombre'];
                            //var ul = document.createElement("ul");
                            //var li = document.createElement("li");
                            //li.appendChild(document.createTextNode('profesor'));
                            //li.innerHTML = "<input type='checkbox' name='dia[]' class='profesor' >profesor";
                            //ul.appendChild(li);
                            var nombre_td  = document.createTextNode(nombre);
                            celda.appendChild(nombre_td);
                            //celda.appendChild(ul);
                            hilera.appendChild(celda);
                            tblBody.appendChild(hilera);
                        }
                        tabla.appendChild(tblBody);
                        $('#cursos_detalle').html(tabla);
                        tabla.setAttribute("border", "2");
                    }
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
                        if(data.estado===0){
                            var html_nivel = '';
                            html_nivel += '<select name="nivel_cbo" id="nivel_cbo" onchange="cbo_nivel(this.value)" class="require">';
                            html_nivel      += '<option value="">--Seleccione Nivel--</option>';
                            <?php
                            if($nivel){
                                foreach ($nivel as $val){
                            ?>
                            html_nivel      += '<option value="<?=$val->NIVE_id?>"><?=$val->NIVE_nombre?></option>';
                            <?php
                                }
                            }
                            ?>
                            html_nivel += '</select>';
                            
                            var html_grado = ''
                            html_grado += '<select name="grado_cbo" id="grado_cbo" onchange="cbo_grado(this.value)" class="require">';
                            html_grado += '<option value="">--Seleccione Grado--</option>';
                            html_grado += '</select>';
                            
                            $('#tex_tipo_matricula').text('Matricula Nueva');
                            $('#tipo_matricula').val(1);
                            $('#text_nivel').html(html_nivel);
                            $('#nivel').val('');
                            $('#text_grado').html(html_grado);
                            $('#grado').val();
                        }else{
                            $('#tex_tipo_matricula').text('Retificacion de matricula');
                            $('#tipo_matricula').val(3);
                            $('#text_nivel').text(data.nivel);
                            $('#nivel').val(data.nivel_id);
                            $('#text_grado').text(data.grado);
                            $('#grado').val(data.grado_id);
                        }
                        $('#alu_id').val(data.key);
                        $('#paterno').val(data.paterno);
                        $('#materno').val(data.materno);
                        $('#nombre').val(data.nombre);
                        $('#email').val(data.correo);
                        $("#paterno").attr('style','background-color: #E8E9EC');
                        $("#materno").attr('style','background-color: #E8E9EC');
                        $("#nombre").attr('style','background-color: #E8E9EC');
                    }else{
                        $('#alu_id').val('');
                        $('#paterno').val('');
                        $('#materno').val('');
                        $('#nombre').val('');
                        $('#email').val('');
                        $("#paterno").removeAttr('style');
                        $("#materno").removeAttr('style');
                        $("#nombre").removeAttr('style');
                        $('#tex_tipo_matricula').text('');
                        $('#tipo_matricula').val('');
                        $('#text_nivel').text('');
                        $('#nivel').val('');
                        $('#text_grado').text('');
                        $('#grado').val('');
                    }
                    
                }
            });
        });
        $('#guardar').click(function(e){
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
            
    } );
    
    function cbo_nivel(nivel){
        $.ajax({
            type: "GET",
            cache: false,
            url: "<?=base_url() ?>index.php/educacion/grado/getGradoAjax/"+nivel,
            context: document.body,
            async: false,
            success: function(html)
            {
                $("#nivel").val(nivel);
                $("#grado_cbo").html(html);
            }
        });
    }
    function cbo_grado(grado){
        $("#grado").val(grado);
    }
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
                        <td>Tipo Matricula</td>
                        <td>
                            <input type="hidden" name="tipo_matricula" id="tipo_matricula" value="" class="requyire"/>
                            <span style="color: green;" id="tex_tipo_matricula"></span>
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
                    <tr>
                        <td colspan="4" style="color: #0084E3; font-weight: bold; text-align: center;">GRADO ACADEMICO</td>
                    </tr>
                    <tr>
                        <td>Nivel</td>
                        <td>
                            <input name="nivel" type="hidden" id="nivel" class="require"/>
                            <span style="color: green;" id="text_nivel"></span>
                            <!--<select name="nivel" id="nivel" class="require">
                                <option value="">--Seleccione Nivel--</option>
                                <?php
                                foreach ($nivel as $val){
                                ?>
                                <option value="<?=$val->NIVE_id?>"><?=$val->NIVE_nombre?></option>
                                <?php
                                }
                                ?>
                            </select>-->
                        </td>
                        <td>
                            <input type="hidden" name="grado" id="grado" class="require"/>
                            <span style="color: green;" id="text_grado"></span>
                            <!--<select name="grado" id="grado" class="require">
                                <option value="">--Seleccione Grado--</option>
                            </select>-->
                        </td>
                    </tr>
                    <tr>
                        <td id="cursos" colspan="2"></td>
                    </tr>
                    <tr>
                        <td id='cursos_detalle'>
                        </td>
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