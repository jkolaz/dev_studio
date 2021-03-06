<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>css/estilos.css" media="screen" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>css/nav.css" media="screen" />
        <link href="<?php echo base_url(); ?>css/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>css/css/css.css" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script src="<?php echo base_url(); ?>css/js/bootstrap.min.js"></script>
        <!--<script src="<?php echo base_url(); ?>css/js/docs.min.js"></script>-->
        <link rel="stylesheet" href="<?php echo base_url() ?>css/calendario/calendar-win2k-2.css" type="text/css" media="all" title="win2k-cold-1" />
        <script type="text/javascript" src="<?php echo base_url() ?>js/jquery.js"></script>
        <script type="text/javascript" src="<?php echo base_url() ?>js/jquery-ui.js"></script>
        <title>Mi Jazmincito | <?php echo TITULO ?></title>

        <link rel="stylesheet" href="<?php echo base_url() ?>js/datatable/media/css/demo_page.css" type="text/css" />
        <link rel="stylesheet" href="<?php echo base_url() ?>js/datatable/media/css/demo_table_jui.css" type="text/css" />
        <link rel="stylesheet" href="<?php echo base_url() ?>js/datatable/examples/examples_support/themes/smoothness/jquery-ui-1.8.4.custom.css" type="text/css" />
        <script type="text/javascript" language="javascript" src="<?php echo base_url() ?>js/datatable/media/js/jquery.dataTables.js"></script>

        <script type="text/javascript" src="<?php echo base_url() ?>js/calendario/calendar.js"></script>
        <script type="text/javascript" src="<?php echo base_url() ?>js/calendario/calendar-es.js"></script>
        <script type="text/javascript" src="<?php echo base_url() ?>js/calendario/calendar-setup.js"></script>
        
        <?php
        $class = $this->router->fetch_class();
        switch ($class){
            case 'reporte':
            case 'log':
            case 'grado':
                $method = $this->router->fetch_method();
                switch ($method){
                    case 'index':
                    case 'horario':
                    case 'reporte':
        ?>
        <script type="text/javascript" src="<?php echo base_url() ?>js/validate/jquery.js"></script>
        <script type="text/javascript" src="<?php echo base_url() ?>js/validate/jquery.validate.js"></script>
        <?php
                }
                break;
        }
        ?>
    </head>
    <body style="background:#E8E9EC;">
        <div class="contenedor"><div class="trileft2"></div> <div class="trileft"></div></div>
        <div class="contenedor2"><div class="triright"></div> <div class="triright2"></div></div>
        <div class="container" style="background:white; padding: 0; z-index: 4;" >
            <div align="center"><img src="<?php echo base_url() ?>img/banner1.jpg"></div>

            <?php require_once 'menu.php' ?>     
            <div style="display:inline; margin-right: 8px; padding-left: 20px;">
                Institución: <b>Mi Jazmincito</b>
            </div> 
            Usuario: <b><?= utf8_decode($this->session->userdata('nombreUsuario')) ?></b>
              
            <?php echo $content_for_layout ?>
           
        </div>
<br><br>
    </body>
</html>

                            