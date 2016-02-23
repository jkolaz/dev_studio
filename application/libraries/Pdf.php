<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Pdf
 *
 * @author VMC-D02
 */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    // Incluimos el archivo fpdf
    require_once APPPATH."/third_party/fpdf/fpdf.php";
 
    //Extendemos la clase Pdf de la clase fpdf para que herede todas sus variables y funciones
class Pdf extends FPDF {
    
    var $DIR;
    
    public function __construct() {
        parent::__construct();
        
        $this->DIR = $_SERVER['DOCUMENT_ROOT'];
        
    }
    // El encabezado del PDF
    public function Header(){
        $this->Image($this->DIR.'/img/pdf/logo_miniatura.png',10,8,50);
        $this->SetFont('Arial','B',13);
        $this->Cell(30);
        $this->Cell(120,10,'ESCUELA X'.$this->DIR,0,0,'C');
        $this->Ln('5');
        $this->SetFont('Arial','B',8);
        $this->Cell(30);
        $this->Cell(120,10,'INFORMACION DE CONTACTO',0,0,'C');
        $this->Ln(20);
    }
    // El pie del pdf
    public function Footer(){
        $this->SetY(-15);
        $this->SetFont('Arial','I',8);
        $this->Cell(0,10,'I. E. P. Mi Jazmincito - Pagina '.$this->PageNo().'/{nb}',0,0,'C');
    }
}
