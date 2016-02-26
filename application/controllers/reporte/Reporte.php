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
        $this->pdf->AddPage();
        $this->pdf->AliasNbPages();
        $this->pdf->SetTitle("RENDIMIENTO ACADEMICO");
        $this->pdf->SetLeftMargin(15);
        $this->pdf->SetRightMargin(15);
        $this->pdf->Output("Lista de alumnos.pdf", 'I');
    }
}
