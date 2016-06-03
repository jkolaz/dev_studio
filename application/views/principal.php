<?php
$objInstancia = get_instance();
$this->load->model('seguridad/usuario_model');

$objUsuario = $objInstancia->usuario_model->obtener_usuario_por_login($this->session->userdata('login'));
$idRol = $objUsuario[0]->ROL_id;
?>
<script type="text/javascript" src="<?php echo base_url() ?>js/fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>js/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>js/fancybox/jquery.fancybox-1.3.4.css" media="screen" />

<script type="text/javascript">
    $(document).ready( function() {
        base_url   = $("#base_url").val();
        $(".ver_alertas").fancybox( {
            'width'          : 800,
            'height'         : 650,
            'transitionIn'   : 'elastic',
            'transitionOut'  : 'elastic',
            'type'	     : 'iframe'
        } );
    } );
</script>

<br><br><br><br>
<div class="row">
<div class="col-md-4" style="padding-left: 40px;">
    </br>
 <ul class="list-group">
  <li class="list-group-item list-group-item-info"><span class="glyphicon glyphicon-search"></span> Localizacion: Av Cordialidad Mz ZZ 2 Lote 17</li>
  <li style="text-align: left;" class="list-group-item list-group-item-warning"> <span class="glyphicon glyphicon-envelope"></span> Contactenos a : www.jkolaz.com/tesis </li>

  <li class="list-group-item list-group-item-danger"> <span class="glyphicon glyphicon-earphone"></span> Telefono: 997243562</li>
</ul>
</div>
<div class="col-md-8">
<?php
if($idRol == 15){
?>
    <div class="row">
        <div class="col-md-4 centro">
            
                <h4 class="ayuda">Alumnos</h4>
                <a href="<?php echo base_url() . 'index.php/seguridad/usuario/estudiante/R' ?>">
                    <img src="<?php echo base_url() . 'img/alumnos_1.jpg' ?>" 
                         border='0' title='Alumnos' />
                </a>
           </br> 
           </br>
        </div>
        <div class="col-md-4 centro">
            
                <h4 class="ayuda">Matricula</h4>
                <a href="<?php echo base_url() . 'index.php/seguridad/usuario/estudiante/M' ?>">
                    <img src="<?php echo base_url() . 'img/alumnos_1.jpg' ?>" 
                         border='0' title='Alumnos' />
                </a>
           </br> 
           </br>
        </div>
        <div class="col-md-4 centro">
               <h4 class="ayuda"> Padres de familia</h4>
                <a target='_blank' href="<?php echo base_url() . 'index.php/seguridad/usuario/listar_padres_familia/' ?>">
                    <img src="<?php echo base_url() . 'img/padres_1.jpg' ?>" 
                         border='0' title='Padres de familia' />
                </a>
                 </br> 
           </br>
          </div>
    </div>
      <div class="row">
            <div class="col-md-4 centro">
                <h4 class="ayuda">Empleados</h4>
                <a target='_blank' href="<?php echo base_url() . 'index.php/seguridad/usuario/listar_profesores/' ?>">
                    <img src="<?php echo base_url() . 'img/profesor_1.jpg' ?>" 
                         border='0' title='Profesores' />
                </a>
                </br> 
                </br>
             </div>
        <div class="col-md-4 centro">
                <h4 class="ayuda">Notas</h4>
                <a href="#">
                    <img src="<?php echo base_url() . 'img/notas.jpg' ?>" 
                         border='0' title='.....' />
                </a>
                 </br> 
           </br>
           </div>
        <div class="col-md-4 centro">
                <h4 class="ayuda">Cursos</h4>
                <a href="<?php echo base_url() . 'index.php/educacion/curso/listar/' ?>">
                    <img src="<?php echo base_url() . 'img/cursos.jpg' ?>" 
                         border='0' title='Cursos' />
                </a>
                 </br> 
           </br>
             </div>
       </div>
      <div class="row">
        <div class="col-md-4 centro">
                <h4 class="ayuda">Horarios</h4>
                <a href="#">
                    <img src="<?php echo base_url() . 'img/horario_1.jpg' ?>" 
                         border='0' title='Horarios' />
                </a>
                 </br> 
           </br>
       </div>
        <div class="col-md-4 centro">
                <h4 class="ayuda">Reportes</h4>
                <a href="<?php echo base_url() . 'index.php/reporte/Reporte'?>">
                    <img src="<?php echo base_url() . 'img/reportes.png' ?>" 
                         border='0' title='Reportes' />
                </a>
                 </br> 
           </br>
            </div>
        <div class="col-md-4 centro">
             
           </div>
        <div class="col-md-4 centro">
               
            </div>
        
    </div>
<?php
}
?>
</div>
</div>
