<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of matricula
 *
 * @author VMC-D02
 */
class Matricula extends CI_Controller{
    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->library('layout', 'layout');
        $this->siLogin();
    }
    public function newMatricula(){
        $data['action'] = "matricula/matricula/insertMatricula";
        $data['titulo'] = 'REGISTRO DE  MATRICULA';
        $this->layout->view('matricula/newMAtricula',$data);
    }
    public function insertMatricula(){
        
    }

    public function siLogin(){
        $idUsuario = $this->session->userdata('idUsuario');
        if(!isset($idUsuario) || $idUsuario == ""){
            $data['URL_back'] = $this->session->CI->uri->uri_string;
            $this->session->set_userdata($data);
            redirect('index/inicio');
        }
    }
}
