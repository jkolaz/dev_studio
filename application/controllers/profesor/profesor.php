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
        $this->load->model('educacion/alumnocurso_model', 'AlumnoCurso');
        $this->load->library('layout', 'layout');
    }
    public function index($id){
        $obCursoAlumno = $this->AlumnoCurso->getAlumnoByCurso($id);
//        echo "<pre>";
//        print_r($obCursoAlumno);
//        echo "</pre>";
        $curso = $this->Curso->obtener_curso($id);
        $data['titulo'] = $curso[0]->CURS_nombre;
        $data['lista'] = $obCursoAlumno;
        $this->layout->view('profesor/alumno', $data);
    }
}
