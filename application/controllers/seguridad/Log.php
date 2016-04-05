<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Log
 *
 * @author julio
 */
class Log extends CI_Controller{
    //put your code here
    
    public function __construct(){
        parent::__construct();
        $this->load->library('layout', 'layout');
        $this->load->helper(array('url', 'form', 'utilitarios'));
    }
    
    public function reporte(){
        $data['action'] = 'reporte';
        $this->layout->view('seguridad/log_reporte', $data);
    }
    
    public function search(){
        $redirect = 'seguridad/log/reporte';
        if(!isset($_POST)){
            redirect($redirect);
        }
        $type = $_POST['action'];
        switch ($type){
            case "reporte":
                $this->searchReporte($_POST);
                break;
            default :
                redirect($redirect);
        }
    }
    
    public function searchReporte($post){
        imprimir($post);
    }
}
