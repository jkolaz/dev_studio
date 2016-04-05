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
        $this->load->helper(array('url', 'form', 'utilitarios', 'file'));
        $this->load->model('seguridad/usuario_model', 'USUARIO');
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
        $fecha = str_replace('-', '_', $post['txt_fecha']);
        $p_file = PATH_ADMIN . "application/logs/" . $post['action']."/".$fecha.".txt";
        if (file_exists($p_file)) {
            $a_data_file = read_file($p_file);
            $a_data_file = explode('||',$a_data_file);
            $a_data_file = array_reverse($a_data_file);
        }  else {
            $a_data_file = "";
        }
        $aFile = array();
        foreach ($a_data_file as $value){
            if(trim($value) != ""){
                $aValue = explode('|', $value);
                $adm = trim($aValue[1]);
                if($adm > 0){
                    $objAdmin = $this->USUARIO->getUserById($adm);
                    if($objAdmin){
                        $value .= ' | '.$objAdmin[0]->USUA_nombres." ". $objAdmin[0]->USUA_apellidoPaterno." ".$objAdmin[0]->USUA_apellidoMaterno;
                    }
                }
                $user = explode('-',trim($aValue[7]));
                if (isset($user[1]) && $user[1] > 0){
                    $objUser = $this->USUARIO->getUserById($user[1]);
                    if($objUser){
                        $value .= ' | '.$user[0].' : '.$objUser[0]->USUA_nombres." ". $objUser[0]->USUA_apellidoPaterno." ".$objUser[0]->USUA_apellidoMaterno;
                    }
                }else{
                    $value .= ' | -';
                }
                $aFile[] = trim($value);
            }
        }
        $data['titulo'] = 'Log de reporte';
        $data['lista'] = $aFile;
        $this->layout->view('seguridad/log_list_reporte', $data);
    }
}
