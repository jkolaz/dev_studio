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
        $this->load->model('educacion/asignacion_model', 'Asignado');
        $this->load->model('matricula/bimestre_model', 'Bimestre');
        $this->load->model('nota/calificacion_model', 'Calificacion');
        $this->load->model('educacion/alumnocurso_model', 'AlumnoCurso');
        $this->load->library('layout', 'layout');
    }
    public function index($id){
        $obCursoAlumno = $this->AlumnoCurso->getAlumnoByCurso($id);
        if($obCursoAlumno){
            foreach ($obCursoAlumno as $index => $value){
                foreach ($this->Bimestre->getBimestre() as $index1 => $value1){
                    $notaBimestre = $this->Calificacion->getCalifiacion($value->USUA_id, $value->GRAD_id, $value->CURS_id, $value1->BIME_id);
                    $stdNotaBimestre = new stdClass();
                    $stdNotaBimestre->BIME_id = $value1->BIME_id;
                    $stdNotaBimestre->CALI_parcial1 = 0;
                    if(is_array($notaBimestre)){
                        foreach ($notaBimestre as $bime){
                            if($bime->CALI_parcial1 != 0){
                            $stdNotaBimestre->CALI_parcial1 = $bime->CALI_parcial1;
                            }
                        }
                    }
                    $obCursoAlumno[$index]->nota[] = $stdNotaBimestre;
                }
            }
        }
        $data['asignado'] = $id;
        $curso = $this->Curso->obtener_curso($id);
        $data['titulo'] = $curso[0]->CURS_nombre;
        $data['lista'] = $obCursoAlumno;
        $this->layout->view('profesor/alumno', $data);
    }
    
    public function criterio($id){
        $asignado = $this->Asignado->getAsignado($id);
        $listaCriterios = $this->Curso->listar_criterios();
        if($asignado){
            $criterio = $asignado[0]->ASIG_criterio;
            if($criterio == "" || $criterio == "[]"){
                $newCriterio = array();
                foreach ($listaCriterios as $value){
                    $newCriterio[] = $value->CRIT_id;
                }
                if(count($newCriterio) > 0){
                    $newCriterioJson = json_encode($newCriterio);
                    $this->Asignado->updateCriterio($id, $newCriterioJson);
                    $criterio = $newCriterioJson;
                }
            }
            $arreglo = json_decode($criterio);
            foreach ($listaCriterios as $index=>$crit){
                foreach ($arreglo as $val){
                    $listaCriterios[$index]->check = 0;
                    
                    if($val == $crit->CRIT_id){
                        $listaCriterios[$index]->check = 1;
                        break;
                    }
                }
                
            }
            $curso = $this->Curso->obtener_curso($asignado[0]->CURS_id);
            $data['curso'] = $curso[0]->CURS_nombre;
            $data['asignado'] = $asignado[0]->ASIG_id;
            $data['criterio'] = $listaCriterios;
            $this->load->view('profesor/criterio_evaluacion', $data);
        }
    }
    public function criterioUpdate(){
        $result = 0;
        $asignado_id = $this->input->post('asignado',true);
        $criterio = $this->input->post('criterio',true);
        $activo = $this->input->post('activar',true);
        $asignado = $this->Asignado->getAsignado($asignado_id);
        if($asignado){
            $arreglo = json_decode($asignado[0]->ASIG_criterio);
            $newArreglo = array();
            if($activo == 1){//activar criterio
                $cont = 0;
                foreach ($arreglo as $val){
                    $newArreglo[] = $val;
                }
                if(!in_array($criterio, $newArreglo)){
                    $newArreglo[] = $criterio;
                }
            }else{//desactivar criterio
                foreach ($arreglo as $value){
                    if($value != $criterio){
                        $newArreglo[] = $value;
                    }
                }
                
            }
            $this->Asignado->updateCriterio($asignado_id, json_encode($newArreglo));
            $result = 1;
        }
        echo json_encode(array('result'=>$result));
    }
}
