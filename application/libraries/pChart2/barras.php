<?php

require_once 'class/pData.class.php';
require_once 'class/pDraw.class.php';
require_once 'class/pImage.class.php';

// Datos
$SERVIDOR_A = array(150, 220, 300, 50, 20, 220, 300, 200, 100);
$SERVIDOR_B = array(140, 20, 340, 25, 30, 550, 200, 100, 50);
$MESES = array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Setiembre');

/* Create and populate the pData object */
$datos = new pData();
$datos->addPoints($SERVIDOR_A, 'Servidor A');
$datos->addPoints($SERVIDOR_B, 'Servidor B');
$datos->setAxisName(0, 'Cantidad');
$datos->addPoints($MESES, 'Meses');
$datos->setSerieDescription('Meses', 'Mes');
$datos->setAbscissa('Meses');

/* Create the pChart object */
$imagen = new pImage(700, 230, $datos);
//$imagen->drawGradientArea(0, 0, 700, 230, DIRECTION_VERTICAL, array("StartR" => 240, "StartG" => 240, "StartB" => 240, "EndR" => 180, "EndG" => 180, "EndB" => 180, "Alpha" => 100));
//$imagen->drawGradientArea(0, 0, 700, 230, DIRECTION_HORIZONTAL, array("StartR" => 240, "StartG" => 240, "StartB" => 240, "EndR" => 180, "EndG" => 180, "EndB" => 180, "Alpha" => 20));
$imagen->setFontProperties(array('FontName' => 'fonts/pf_arma_five.ttf', 'FontSize' => 6));

/* Draw the scale  */
$imagen->setGraphArea(50, 30, 680, 200);
$imagen->drawScale(array('CycleBackground' => TRUE, 'DrawSubTicks' => TRUE, 'GridR' => 0, 'GridG' => 0, 'GridB' => 0, 'GridAlpha' => 20));

$imagen->setShadow(FALSE, array('X' => 1, 'Y' => 1, 'R' => 0, 'G' => 0, 'B' => 0, 'Alpha' => 10));

$settings = array('Gradient' => FALSE, 'DisplayPos' => LABEL_POS_TOP, 'DisplayValues' => TRUE,
    'DisplayR' => 0, 'DisplayG' => 0, 'DisplayB' => 0,
    'DisplayShadow' => FALSE, 'Surrounding' => 10);
$imagen->drawBarChart($settings);

$imagen->drawLegend(580, 12, array('Style' => LEGEND_NOBORDER, 'Mode' => LEGEND_HORIZONTAL));

$imagen->autoOutput('shaded.png');

?>
