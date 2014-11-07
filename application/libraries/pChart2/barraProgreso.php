<?php

require_once 'class/pData.class.php';
require_once 'class/pDraw.class.php';
require_once 'class/pImage.class.php';

$myPicture = new pImage(700, 230);

/* Draw the background */
$Settings = array("R" => 170, "G" => 183, "B" => 87, "Dash" => 1, "DashR" => 190, "DashG" => 203, "DashB" => 107);
$myPicture->drawFilledRectangle(0, 0, 700, 230, $Settings);

/* Overlay with a gradient */
$Settings = array("StartR" => 219, "StartG" => 231, "StartB" => 139, "EndR" => 1, "EndG" => 138, "EndB" => 68, "Alpha" => 50);
$myPicture->drawGradientArea(0, 0, 700, 230, DIRECTION_VERTICAL, $Settings);
$myPicture->drawGradientArea(0, 0, 700, 20, DIRECTION_VERTICAL, array("StartR" => 0, "StartG" => 0, "StartB" => 0, "EndR" => 50, "EndG" => 50, "EndB" => 50, "Alpha" => 80));

/* Add a border to the picture */
$myPicture->drawRectangle(0, 0, 699, 229, array("R" => 0, "G" => 0, "B" => 0));

/* Write the picture title */
$myPicture->setFontProperties(array("FontName" => "fonts/Silkscreen.ttf", "FontSize" => 6));
$myPicture->drawText(10, 13, "drawProgress() - Simple progress bars", array("R" => 255, "G" => 255, "B" => 255));

/* Set the font & shadow options */
$myPicture->setFontProperties(array("FontName" => "fonts/Forgotte.ttf", "FontSize" => 10));
$myPicture->setShadow(TRUE, array("X" => 1, "Y" => 1, "R" => 0, "G" => 0, "B" => 0, "Alpha" => 20));

/* Draw a progress bar */
$progressOptions = array("R" => 209, "G" => 31, "B" => 27, "Surrounding" => 20, "BoxBorderR" => 0, "BoxBorderG" => 0, "BoxBorderB" => 0, "BoxBackR" => 255, "BoxBackG" => 255, "BoxBackB" => 255, "RFade" => 206, "GFade" => 133, "BFade" => 30, "ShowLabel" => TRUE);
$myPicture->drawProgress(40, 60, 77, $progressOptions);

/* Draw a progress bar */
$progressOptions = array("Width" => 165, "R" => 209, "G" => 125, "B" => 27, "Surrounding" => 20, "BoxBorderR" => 0, "BoxBorderG" => 0, "BoxBorderB" => 0, "BoxBackR" => 255, "BoxBackG" => 255, "BoxBackB" => 255, "NoAngle" => TRUE, "ShowLabel" => TRUE, "LabelPos" => LABEL_POS_RIGHT);
$myPicture->drawProgress(40, 100, 50, $progressOptions);

/* Draw a progress bar */
$progressOptions = array("Width" => 165, "R" => 209, "G" => 198, "B" => 27, "Surrounding" => 20, "BoxBorderR" => 0, "BoxBorderG" => 0, "BoxBorderB" => 0, "BoxBackR" => 255, "BoxBackG" => 255, "BoxBackB" => 255, "ShowLabel" => TRUE, "LabelPos" => LABEL_POS_LEFT);
$myPicture->drawProgress(75, 140, 25, $progressOptions);

/* Draw a progress bar */
$progressOptions = array("Width" => 400, "R" => 134, "G" => 209, "B" => 27, "Surrounding" => 20, "BoxBorderR" => 0, "BoxBorderG" => 0, "BoxBorderB" => 0, "BoxBackR" => 255, "BoxBackG" => 255, "BoxBackB" => 255, "RFade" => 206, "GFade" => 133, "BFade" => 30, "ShowLabel" => TRUE, "LabelPos" => LABEL_POS_CENTER);
$myPicture->drawProgress(40, 180, 80, $progressOptions);

/* Draw a progress bar */
$progressOptions = array("Width" => 20, "Height" => 150, "R" => 209, "G" => 31, "B" => 27, "Surrounding" => 20, "BoxBorderR" => 0, "BoxBorderG" => 0, "BoxBorderB" => 0, "BoxBackR" => 255, "BoxBackG" => 255, "BoxBackB" => 255, "RFade" => 206, "GFade" => 133, "BFade" => 30, "ShowLabel" => TRUE, "Orientation" => ORIENTATION_VERTICAL, "LabelPos" => LABEL_POS_BOTTOM);
$myPicture->drawProgress(500, 200, 77, $progressOptions);

/* Draw a progress bar */
$progressOptions = array("Width" => 20, "Height" => 150, "R" => 209, "G" => 125, "B" => 27, "Surrounding" => 20, "BoxBorderR" => 0, "BoxBorderG" => 0, "BoxBorderB" => 0, "BoxBackR" => 255, "BoxBackG" => 255, "BoxBackB" => 255, "NoAngle" => TRUE, "ShowLabel" => TRUE, "Orientation" => ORIENTATION_VERTICAL, "LabelPos" => LABEL_POS_TOP);
$myPicture->drawProgress(540, 200, 50, $progressOptions);

/* Draw a progress bar */
$progressOptions = array("Width" => 20, "Height" => 150, "R" => 209, "G" => 198, "B" => 27, "Surrounding" => 20, "BoxBorderR" => 0, "BoxBorderG" => 0, "BoxBorderB" => 0, "BoxBackR" => 255, "BoxBackG" => 255, "BoxBackB" => 255, "ShowLabel" => TRUE, "Orientation" => ORIENTATION_VERTICAL, "LabelPos" => LABEL_POS_INSIDE);
$myPicture->drawProgress(580, 200, 25, $progressOptions);

/* Draw a progress bar */
$progressOptions = array("Width" => 20, "Height" => 150, "R" => 134, "G" => 209, "B" => 27, "Surrounding" => 20, "BoxBorderR" => 0, "BoxBorderG" => 0, "BoxBorderB" => 0, "BoxBackR" => 255, "BoxBackG" => 255, "BoxBackB" => 255, "RFade" => 206, "GFade" => 133, "BFade" => 30, "ShowLabel" => TRUE, "Orientation" => ORIENTATION_VERTICAL, "LabelPos" => LABEL_POS_CENTER);
$myPicture->drawProgress(620, 200, 80, $progressOptions);

/* Render the picture (choose the best way) */
$myPicture->autoOutput("pictures/example.drawProgress.png");


//// Datos
//$SERVIDOR_A = array(150, 220, 300, 50, 20, 220, 300, 200, 100);
//$SERVIDOR_B = array(140, 20, 340, 25, 30, 550, 200, 100, 50);
//$MESES = array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Setiembre');
//
///* Create and populate the pData object */
//$datos = new pData();
//$datos->addPoints($SERVIDOR_A, 'Servidor A');
//$datos->addPoints($SERVIDOR_B, 'Servidor B');
//$datos->setAxisName(0, 'Cantidad');
//$datos->addPoints($MESES, 'Meses');
//$datos->setSerieDescription('Meses', 'Mes');
//$datos->setAbscissa('Meses');
//
///* Create the pChart object */
//$imagen = new pImage(700, 230, $datos);
////$imagen->drawGradientArea(0, 0, 700, 230, DIRECTION_VERTICAL, array("StartR" => 240, "StartG" => 240, "StartB" => 240, "EndR" => 180, "EndG" => 180, "EndB" => 180, "Alpha" => 100));
////$imagen->drawGradientArea(0, 0, 700, 230, DIRECTION_HORIZONTAL, array("StartR" => 240, "StartG" => 240, "StartB" => 240, "EndR" => 180, "EndG" => 180, "EndB" => 180, "Alpha" => 20));
//$imagen->setFontProperties(array('FontName' => 'fonts/pf_arma_five.ttf', 'FontSize' => 6));
//
///* Draw the scale  */
//$imagen->setGraphArea(50, 30, 680, 200);
//$imagen->drawScale(array('CycleBackground' => TRUE, 'DrawSubTicks' => TRUE, 'GridR' => 0, 'GridG' => 0, 'GridB' => 0, 'GridAlpha' => 20));
//
//$imagen->setShadow(FALSE, array('X' => 1, 'Y' => 1, 'R' => 0, 'G' => 0, 'B' => 0, 'Alpha' => 10));
//
//$settings = array('Gradient' => FALSE, 'DisplayPos' => LABEL_POS_TOP, 'DisplayValues' => TRUE,
//    'DisplayR' => 0, 'DisplayG' => 0, 'DisplayB' => 0,
//    'DisplayShadow' => FALSE, 'Surrounding' => 10);
//$imagen->drawBarChart($settings);
//
//$imagen->drawLegend(580, 12, array('Style' => LEGEND_NOBORDER, 'Mode' => LEGEND_HORIZONTAL));
//
//$imagen->autoOutput('shaded.png');
?>
