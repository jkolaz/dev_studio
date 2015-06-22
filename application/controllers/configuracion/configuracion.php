<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of configuracion
 *
 * @author VMC-D02
 */
class Configuracion extends CI_Controller{
    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->library('layout', 'layout');
        $this->load->helper(array('url', 'form', 'utilitarios'));
    }
    public function getAnioEscolar(){
        $this->load->model('configuracion/anio_model', 'anio');
        $lista = $this->anio->getAnio();
        $data['lista'] = $lista;
        $data['titulo'] = 'Años Escolares';
        $this->layout->view('configuracion/anioIndex', $data);
    }
}
