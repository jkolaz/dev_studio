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
    } );
</script>
<style>
    #cursos{
        color: #0063DC;
    }
</style>
<br><br>
<div class="header"><?php echo $titulo ?></div>
<div id="container">
    <div class="demo_jui">
        <form name="form1" id="form1" action="<?=base_url() ?>index.php/seguridad/usuario/insertAlumno" method="post">
            <table class="tabla" id="usuarios">
                <tbody>
                    <tr>
                        <td>Nombre :</td>
                        <td><input type="input" name="nombre" id="nombre"/></td>
                    </tr>
                    <tr>
                        <td>Apellidos :</td>
                        <td><input type="input" name="paterno" id="paterno"/>
                            <input type="input" name="materno" id="materno"/></td>
                    </tr>
                    <tr>
                        <td>D.N.I. :</td>
                        <td><input type="input" name="dni" id="dni"/></td>
                    </tr>
                    <tr>
                        <td>E-mail :</td>
                        <td><input type="input" name="email" id="email"/></td>
                    </tr>
                    <tr>
                        <td>Sexo</td>
                        <td>
                            <select name="sexo" id="sexo" class="combo">
                                <option value="M">Hombre</option>
                                <option value="F">Mujer</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Nivel</td>
                        <td>
                            <select name="nivel" id="nivel" class="combo">
                                <option value="0">--Seleccione Nivel--</option>
                                <?php
                                foreach ($nivel as $value){
                                ?>
                                <option value="<?=$value->NIVE_id?>"><?=$value->NIVE_nombre?></option>
                                <?php    
                                }
                                ?>
                            </select>
                        </td>
                        <td>Grado</td>
                        <td>
                            <select name="grado" id="grado" class="combo">
                                <option value="0">--Seleccione Grado--</option>
                            </select>
                        </td>
                    </tr>
                    <tr id="cursos">
                        <td>Seleccione un grado</td>
                    </tr>
                    <tr>
                        <td>Datos de los Padres</td>
                    </tr>
                    <tr>
                        <td>D.N.I :</td>
                        <td><input type="input" name="padre_dni" id="padre_dni"/></td>
                    <tr>
                        <td>Nombre del padre o tutor</td>
                        <td><input type="input" name="padre_nombre" id="padre_nombre"/></td>
                    </tr>
                    <tr>
                        <td>Apellidos del padre o tutor</td>
                        <td><input type="input" name="padre_paterno" id="padre_paterno"/>
                            <input type="input" name="padre_materno" id="padre_materno"/></td>
                    </tr>
                    <tr>
                        <td>Número de Telefono</td>
                        <td><input type="input" name="padre_fono" id="padre_fono"/></td>
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