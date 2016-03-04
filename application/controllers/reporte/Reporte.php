<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Reporte
 *
 * @author VMC-D02
 */
class Reporte extends CI_Controller{
    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->library('layout', 'layout');
        $this->load->library('pdf');
        $this->pdf = new Pdf();
    }
    
    public function index(){
        $data['action'] = 'rendimientoAcademico';
        $this->layout->view('reporte/reporte', $data);
    }

    public function rendimientoAcademico(){
        if($_SERVER['REQUEST_METHOD'] == "POST"){
            /*DNI PRUEBA : 10874854*/
            $dni = $_POST['txt_dni'];
            
            $idAlumno = 0;
            $this->generatePDFReporteAcademico($idAlumno);
            $this->layout->view('reporte/reporteRendimientoAcademico');
        }else{
            redirect('reporte/Reporte');
        }
    }
    
    public function generatePDFReporteAcademico($id){
        $title = "RENDIMIENTO ACADEMICO";
        $relleno = FALSE;
        $borde = 0;
        $margenIzq = 20;
        $this->pdf->AddPage();
        $this->pdf->AliasNbPages();
        $this->pdf->SetTitle($title);
        $this->pdf->SetLeftMargin($margenIzq);
        $this->pdf->SetRightMargin(15);
        $this->pdf->SetFont('Arial', 'B', 14);
        $this->pdf->setXY(83,30);
        $this->pdf->Image($this->pdf->DIR.'/img/pdf/logo.png');
        $this->pdf->setX($margenIzq);
        $this->pdf->Cell(0,10,$title,$borde,0,'C',$relleno);
        $this->pdf->ln();
        $this->pdf->ln();
        $this->pdf->setX($margenIzq);
        $this->pdf->SetFont('Arial', 'B', 10);
        $this->pdf->Cell(20,6,'ALUMNO: ',$borde,0,'J',$relleno);
        $this->pdf->SetFont('Arial', '', 10);
        $this->pdf->Cell(155,6, utf8_decode('Julio Alcides Salsavilca Huamanyauri'),$borde,0,'J',$relleno);
        $this->pdf->ln();
        $this->pdf->SetFont('Arial', 'B', 10);
        $this->pdf->Cell(20,6, utf8_decode('CÓDIGO: '),$borde,0,'J',$relleno);
        $this->pdf->SetFont('Arial', '', 10);
        $this->pdf->Cell(155,6, utf8_decode('47140697'),$borde,0,'J',$relleno);
        $this->pdf->ln();
        $this->pdf->SetFont('Arial', 'B', 10);
        $this->pdf->Cell(20,6,'GRADO: ',$borde,0,'J',$relleno);
        $this->pdf->SetFont('Arial', '', 10);
        $this->pdf->Cell(155,6, utf8_decode('1° Grado'),$borde,0,'J',$relleno);
        $this->pdf->ln(10);
        $this->pdf->SetFont('Arial', 'B', 9);
        /*Color de fuente*/
        $this->pdf->SetTextColor(255, 255, 255);
        /*borde*/
        $this->pdf->SetDrawColor(200, 200, 200);
        /*relleno*/
        $this->pdf->SetFillColor(0, 0, 0);
        $borde += 1;
        $this->pdf->Cell(63,12,'ASIGNATURA',$borde,0,'C', TRUE);
        $this->pdf->Cell(92,6,'BIMESTRE',$borde, 0,'C', TRUE);
        $this->pdf->Cell(20,12,'PROMEDIO',$borde, 0,'C', TRUE);
        $this->pdf->ln(6);
        $this->pdf->setX(63+$margenIzq);
        $this->pdf->Cell(23, 6,'I',$borde, 0,'C', TRUE);
        $this->pdf->Cell(23, 6,'II',$borde, 0,'C', TRUE);
        $this->pdf->Cell(23, 6,'III',$borde, 0,'C', TRUE);
        $this->pdf->Cell(23, 6,'IV',$borde, 0,'C', TRUE);
        $this->pdf->ln(6);
        $this->pdf->Output("Lista de alumnos.pdf", 'I');
    }
}
