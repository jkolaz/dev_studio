<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of tipo_matricula
 *
 * @author julio
 */
class Tipo_matricula extends CI_Controller{
    //put your code here
    private static $__session;
    public function __construct() {
        parent::__construct();
        $this->load->library('layout', 'layout');
        $this->load->helper(array('url', 'form', 'utilitarios'));
        $this->load->model('configuracion/tipo_matricula_model','TIPO_MATRICULA');
        self::$__session = $this->session->userdata;
        //imprimir(self::$__session);
        if(!isset(self::$__session['idUsuario'])){
            redirect('index/principal');
        }
    }
    
    public function index(){
        $data = array();
        $data['lista'] = $this->TIPO_MATRICULA->getTipoMatricula();
        $data['titulo'] = "LISTA DE TIPO DE MATRCULA";
        $this->layout->view('configuracion/tipo_matricula', $data);
    }
    
    public function nuevo(){
        redirect('configuracion/tipo_matricula');
    }
}
