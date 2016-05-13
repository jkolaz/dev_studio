<!DOCTYPE html>
<html lang="en">
  <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    	<title>Mi Jazmincito | inicio</title>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.js"></script>
        <link rel="stylesheet" href="<?php echo base_url(); ?>css/estilos.css" type="text/css">
    <link href="<?php echo base_url(); ?>css/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>css/css/css.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>css/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>css/js/docs.min.js"></script>
    
    </head>
    <body style="background: #6699F7;">
        <div class="container fondo">

<div class="row">
     <div class="col-md-3">
  </div>
    <div class="col-md-3"   >
    </br>
    <ul class="list-group">
  <li class="list-group-item list-group-item-info"><span class="glyphicon glyphicon-search"></span> Localización: Av Cordialidad Mz ZZ C 2 Lote 17</li>
  <li style="text-align: left;" class="list-group-item list-group-item-warning"> <span class="glyphicon glyphicon-envelope"></span> Contactenos a : www.jkolaz.com/tesis </li>

  <li class="list-group-item list-group-item-danger"> <span class="glyphicon glyphicon-earphone"></span> Telefono: 997243562</li>
</ul>


    </div>
    <div class="col-md-3" style="background: #6699F7;">

    <form name="frmLogin" method="post" action="<?php echo base_url() . 'index.php/index/ingresar_sistema' ?>">


        <h1 style="color:white">I. E. P. Mi Jazmincito</h1>
        <div class="input-group">
        <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
        <?php echo $valores[0] ?>

    </div>
    </br>
    <div class="input-group">
        <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
        <?php echo $valores[1] ?>
    </div>
</br>
    <input name="ingresar" class="btn btn-success" type="submit"  value="Ingresar" /> 
    <input name="cancelar" class="btn btn-danger" type="reset"  value="Limpiar" />
    </br>
     </form>
    </br>
    </div>

 <div class="col-md-3">
  </div>



    </div>
    </div>



               
           








        </div>
    </body> 
</html>

                            