<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of profesor
 *
 * @author julio
 */
class Profesor extends CI_Controller{
    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->helper(array('url', 'form', 'utilitarios'));
        $this->load->library('form_validation', 'pagination', 'html');
        $this->load->model('educacion/curso_model', 'Curso');
        $this->load->model('matricula/bimestre_model', 'Bimestre');
        $this->load->model('nota/calificacion_model', 'Calificacion');
        $this->load->model('educacion/alumnocurso_model', 'AlumnoCurso');
        $this->load->library('layout', 'layout');
    }
    public function index($id){
        $obCursoAlumno = $this->AlumnoCurso->getAlumnoByCurso($id);
        foreach ($obCursoAlumno as $index => $value){
            foreach ($this->Bimestre->getBimestre() as $index1 => $value1){
                $notaBimestre = $this->Calificacion->getCalifiacion($value->USUA_id, $value->GRAD_id, $value->CURS_id, $value1->BIME_id);
                //print_r($notaBimestre);
                $stdNotaBimestre = new stdClass();
                $stdNotaBimestre->BIME_id = $value1->BIME_id;
                $stdNotaBimestre->CALI_parcial1 = 0;
                if(is_array($notaBimestre)){
                    foreach ($notaBimestre as $bime){
                        $stdNotaBimestre->CALI_parcial1 = $bime->CALI_parcial1;
                    }
                }
                $obCursoAlumno[$index]->nota[] = $stdNotaBimestre;
            }
        }
//        echo "<pre>";
//        print_r($obCursoAlumno);
//        echo "</pre>";
        $curso = $this->Curso->obtener_curso($id);
        $data['titulo'] = $curso[0]->CURS_nombre;
        $data['lista'] = $obCursoAlumno;
        $this->layout->view('profesor/alumno', $data);
    }
}
