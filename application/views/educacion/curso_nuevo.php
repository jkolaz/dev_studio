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
<div class="header"><?=$titulo?></div>
<div id="container">
    <div class="demo_jui">
    <!-- asa -->
        <form name="form1" id="form1" action="<?=base_url() ?>index.php/educacion/curso/<?=$action?>" method="post">
            <input type="hidden" name="curso" id="curso" value="<?=$idCurso?>" />
            <table class="tabla" id="usuarios">
                <tbody>
                    <tr>
                        <td>Nombre Curso:</td>
                        <td><input type="input" name="nombre" id="nombre" class="require" value="<?=$curso->CURS_nombre?>"/></td>
                    </tr>
                    <tr>
                        <td>Abreviatura:</td>
                        <td><input type="input" name="abreviatura" id="abreviatura" class="" value="<?=$curso->CURS_abreviatura?>"/></td>
                    </tr>
                    <tr>
                        <td>Horas academicas</td>
                        <td><input type="input" name="hora" id="hora" class="require" value="<?=$curso->CURS_horas?>"/></td>
                    </tr>
                    <?php
                    if($grado){
                        ?>
                    <tr>
                        <td>Grado :</td>
                        <td>
                            <select name="grado" id="grado" class="require">
                                <option value="">Seleccionar</option>
                            <?php
                            $select = "";
                            foreach ($grado as $value){
                                $select = "";
                                if($value->GRAD_id == $curso->GRAD_id){
                                    $select = "selected";
                                }
                            ?>
                                <option value="<?=$value->GRAD_id?>" <?=$select?> ><?=$value->GRAD_nombre?></option>
                            <?php
                            }
                            ?>
                            </select>
                        </td>
                    </tr>
                    <?php
                    }
                    ?>
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