<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of padre
 *
 * @author julio
 */
class Padre extends CI_Controller{
    //put your code here
    
    public function __construct() {
        parent::__construct();
        $this->load->helper(array('url', 'form', 'log'));
        $this->load->library('layout', 'layout');
        $this->load->library('pdf');
        $this->pdf = new Pdf();
        $this->load->model('seguridad/usuario_model', 'USUARIO');
        $this->load->model('matricula/gradousuario_model', 'GXU');
    }
    
    public function hijo(){
        $padre = $this->session->userdata('idUsuario');
        $listaAlumnos = $this->USUARIO->listar_parientes_por_usuario_minimo1($padre, 'P');
        if($listaAlumnos){
            foreach ($listaAlumnos as $id=>$value){
                $grado = $this->GXU->getGradoByUsuario($value->USUA_id);
                if($grado){
                    $listaAlumnos[$id]->GRAD_abreviatura = $grado[0]->GRAD_abreviatura;
                    $listaAlumnos[$id]->NIVE_nombre = $grado[0]->NIVE_nombre;
                }
            }
        }
        $data['titulo'] = 'PADRE FAMILIA';
        $data['alumno'] = $listaAlumnos;
        $this->layout->view(NULL, $data);
    }
    
    function download($id){
        $objUser = $this->USUARIO->getUserById($id);
        if($objUser){
            $obj = $this->USUARIO->getAlumnoNotasNowByDNI($objUser[0]->USUA_dni);
            $this->load->model('configuracion/horario_model', 'HORARIO');
            $objHorario = $this->HORARIO->getHorarioByGrado($obj[0]->GRAD_id);
//            imprimir($objHorario);exit;
            $archivo = uniqid("Notas_".$obj[0]->USUA_dni."_".$obj[0]->GRAD_id."_".date('Y')."_").".pdf";

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
            $this->pdf->Cell(155,6, utf8_decode($obj[0]->USUA_nombres.' '.$obj[0]->USUA_apellidoPaterno.' '.$obj[0]->USUA_apellidoMaterno),$borde,0,'J',$relleno);
            $this->pdf->ln();
            $this->pdf->SetFont('Arial', 'B', 10);
            $this->pdf->Cell(20,6, utf8_decode('CÓDIGO: '),$borde,0,'J',$relleno);
            $this->pdf->SetFont('Arial', '', 10);
            $this->pdf->Cell(155,6, utf8_decode($obj[0]->USUA_codigo),$borde,0,'J',$relleno);
            $this->pdf->ln();
            $this->pdf->SetFont('Arial', 'B', 10);
            $this->pdf->Cell(20,6,'GRADO: ',$borde,0,'J',$relleno);
            $this->pdf->SetFont('Arial', '', 10);
            $this->pdf->Cell(155,6, utf8_decode($obj[0]->GRAD_abreviatura.' de '.$obj[0]->NIVE_nombre),$borde,0,'J',$relleno);
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
            /*Color de fuente*/
            $this->pdf->SetTextColor(0, 0, 0);
            /*borde*/
            $this->pdf->SetDrawColor(0, 0, 0);
            /*relleno*/
            $this->pdf->SetFillColor(255, 255, 255);

            foreach($obj[0]->CURSOS as $value){
                $this->pdf->Cell(63, 6, "  ".utf8_decode($value->CURS_nombre), $borde, 0, 'J', TRUE);
                $prom = 0;
                foreach ($value->NOTAS as $val){
                    $this->pdf->Cell(23, 6, number_format($val->CALI_parcial1), $borde, 0,'C', TRUE);
                    $prom += $val->CALI_parcial1;
                }
                $this->pdf->Cell(20, 6, number_format($prom/4), $borde, 0,'C', TRUE);
                $this->pdf->ln(6);
            }
            $borde = 0;
            if($objHorario){
                $this->pdf->AddPage();
                $this->pdf->AliasNbPages();
                $this->pdf->SetTitle($title);
                $this->pdf->SetLeftMargin($margenIzq);
                $this->pdf->SetRightMargin(15);
                $this->pdf->SetFont('Arial', 'B', 14);
                $this->pdf->setXY(83,30);
                $this->pdf->setX($margenIzq);
                $this->pdf->Cell(0,10,'HORARIO',$borde,0,'C',$relleno);
                $borde += 1;
                $this->pdf->ln(10);
                /*Color de fuente*/
                $this->pdf->SetTextColor(255, 255, 255);
                /*borde*/
                $this->pdf->SetDrawColor(200, 200, 200);
                /*relleno*/
                $this->pdf->SetFillColor(0, 0, 0);
                $this->pdf->SetFont('Arial', 'B', 8);
                $this->pdf->Cell(16,6,'Inicio',$borde,0,'C', TRUE);
                $this->pdf->Cell(16,6,'Fin',$borde, 0,'C', TRUE);
                $this->pdf->Cell(28,6,'Lunes',$borde, 0,'C', TRUE);
                $this->pdf->Cell(28,6,'Martes',$borde, 0,'C', TRUE);
                $this->pdf->Cell(28,6,'Miercoles',$borde, 0,'C', TRUE);
                $this->pdf->Cell(28,6,'Jueves',$borde, 0,'C', TRUE);
                $this->pdf->Cell(28,6,'Viernes',$borde, 0,'C', TRUE);
                
                /*Color de fuente*/
                $this->pdf->SetTextColor(0, 0, 0);
                /*borde*/
                $this->pdf->SetDrawColor(0, 0, 0);
                /*relleno*/
                $this->pdf->SetFillColor(255, 255, 255);
                $this->pdf->SetFont('Arial', '', 8);
                $inicio = '';
                foreach ($objHorario as $valor){
                    $fin = $valor->HOR_fin;
                    if($inicio != $valor->HOR_inicio){
                        $inicio = $valor->HOR_inicio;
                        $this->pdf->ln(6);
                        $this->pdf->Cell(16, 6, $inicio, $borde, 0,'C', TRUE);
                        $this->pdf->Cell(16, 6, $fin, $borde, 0,'C', TRUE);
                    }
                    $this->pdf->Cell(28, 6, utf8_decode($valor->CURS_nombre), $borde, 0,'L', TRUE);;
                }
            }
            $this->tarea = 'Rendimiento Academico';
            createLog("reporte", 'Se generó un reporte de notas ('.$archivo.')', $this->tarea, $this->session->userdata('idUsuario'), "REGISTRO", "ALU-".$obj[0]->USUA_id);
            $this->pdf->Output($archivo, 'D');
            exit;
        }
    }
}
