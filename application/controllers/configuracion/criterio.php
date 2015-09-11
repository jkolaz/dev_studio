<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of criterio
 *
 * @author julio
 */
class Criterio extends CI_Controller{
    //put your code here
    private static $__session;
    
    public function __construct() {
        parent::__construct();
        $this->load->model('educacion/criterio_model', 'Criterio');
        $this->load->library('layout', 'layout');
        $this->load->helper(array('url', 'form', 'utilitarios'));
        self::$__session = $this->session->userdata;
    }
    
    public function index(){
        if(isset(self::$__session['idUsuario']) && self::$__session['idUsuario'] != ""){
            $objCriterio = $this->Criterio->getCriterio();
            $data['lista'] = $objCriterio;
            $data['titulo'] = 'Criterio de Evaluación';
            $this->layout->view('configuracion/criterio_index', $data);
        }else{
            redirect(base_url());
        }
    }
    public function formulario($tipo,$id=0){
        $data = array();
        $data['idCriterio'] = $id;
        $titulo = "";
        $action = "";
        switch($tipo){
            case "nuevo":
                $objCriterio = new stdClass();
                $objCriterio->CRIT_id = 0;
                $objCriterio->CRIT_nombre = "";
                $objCriterio->CRIT_abreviatura = "";
                $titulo = "Nuevo Criterio de Evaluación";
                $action = "nuevo";
                break;
            case "editar":
                if($id > 0){
                    $objCriterio = new stdClass();
                    $criterio = $this->Criterio->getCriterioById($id);
                    if($criterio){
                        foreach ($criterio as $value){
                            $objCriterio = $value;
                        }
                    }
                    $action = "editar";
                    $titulo = "Editar Criterio de Evaluación";
                }else{
                    redirect('configuracion/criterio');
                }
                break;
            default :
                $objCriterio = NULL;
                redirect('configuracion/criterio');
        }
        $data['titulo'] = $titulo;
        $data['action'] = $action;
        $data['criterio'] = $objCriterio;
        $this->layout->view('configuracion/form_criterio', $data);
    }
    public function update(){
        $action = $this->input->post('action',true);
        $criterio = $this->input->post('criterio',true);
        $nombre = $this->input->post('nombre',true);
        $abreviatura = $this->input->post('abreviatura',true);
        $campos = array();
        $campos['CRIT_nombre'] = $nombre;
        $campos['CRIT_abreviatura'] = $abreviatura;
        switch ($action){
            case "nuevo":
                $this->Criterio->insertar($campos);
                break;
            case "editar":
                $this->Criterio->update($criterio, $campos);
                break;
            default :
                redirect('configuracion/criterio');
        }
        redirect('configuracion/criterio');
    }
}
