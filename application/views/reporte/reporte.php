<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>css/usuario.css" media="screen" />
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script src="<?php echo base_url() ?>js/reporte/reporte.js"></script>
<style>
    #informacion{
        color: #494C73;
    }
</style>
<br><br>
<div class="header">REPORTES</div>
<div id="container">
    <div class="demo_jui">
    <!-- asa -->
        <form name="form1" id="form1" action="<?=base_url() ?>index.php/reporte/reporte/<?=$action?>" method="post">
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
                    <tr>
                        <td colspan="4">
                            <!--<img id="project-icon" src="images/transparent_1x1.png" class="ui-state-default" alt="">-->
                            <p id="informacion"></p>
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>
        <input type="hidden" name="base_url" id="base_url" value="<?php echo base_url() ?>">
    </div>
</div>