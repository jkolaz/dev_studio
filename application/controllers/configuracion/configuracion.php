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
    private static $__session;
    public function __construct() {
        parent::__construct();
        $this->load->library('layout', 'layout');
        $this->load->helper(array('url', 'form', 'utilitarios'));
        self::$__session = $this->session->userdata;
    }
    public function getAnioEscolar(){
        $this->load->model('configuracion/anio_model', 'anio');
        $lista = $this->anio->getAnio();
        $data['lista'] = $lista;
        $data['titulo'] = 'Años Escolares';
        $this->layout->view('configuracion/anioIndex', $data);
    }
    public function panel(){
        $this->load->model('configuracion/panel_model', 'PANEL');
        $this->load->model('seguridad/rol_model', 'ROL');
        $this->load->model('configuracion/permiso_panel_model', 'PERMISOPANEL');
        $PERMISOPANEL = $this->PERMISOPANEL;
        $PANEL = $this->PANEL;
        $ROL = $this->ROL;
        if(self::$__session['idRol'] == 1){
            $ruta = getcwd().'\application\controllers';
            if(is_dir($ruta)){
                if ($dh = opendir($ruta)) {
                    while (($file = readdir($dh)) !== false) {
                        $sub_carpeta = $ruta."/" .  $file;
                        if (is_dir($sub_carpeta) && $file!="." && $file!=".."){
                            $where = array();
                            $where['PAN_nombre'] = $file;
                            $getPanel = $PANEL->getRowByCols($where);
                            if($getPanel == 0){
                                $PANEL->_PAN_nombre = $file;
                                $PANEL->insert();
//                                if($PANEL->_PAN_id > 0){
//                                    $arrPanel[] = $PANEL->_PANid;
//                                }
                            }else{
//                                if($dh1 = opendir($sub_carpeta)){
//                                    while(($file1 = readdir($dh1)) !== false){
//                                        $sub_carpeta1 = $sub_carpeta."/".$file1;
//                                        if(is_dir($sub_carpeta1) && $file1 != "." && $file1 != ".."){
//                                            $arrPanel[] = $sub_carpeta1;
//                                        }else{
//                                            $archivo = explode(".", $file1);
//                                            if($archivo[1] == "php"){
//                                                $arrPanel[] = $file1;
//                                            }
//                                        }
//                                    }
//                                    closedir($dh1);
//                                }
                            }
                        }else{
                            
                        }
                    }
                    closedir($dh);
                }
                $rol['ROL_estado'] = "AC";
                $arrRol = $ROL->getRowByCols($rol);
                $thRol = '';
                foreach ($arrRol as $rol){
                    $thRol .= '<th  style="font-weight:bold; text-transform: uppercase;">'.$rol->ROL_nombre.'</th>';
                }
                $data['thRol'] = $thRol;
                $arrPanel = $PANEL->getRowByCols();
                foreach ($arrPanel as $indice=>$panel){
                    $arrPanel[$indice]->roles = array();
                    foreach ($arrRol as $roles){
                        $arrPanel[$indice]->roles[$roles->ROL_id] = new stdClass();
                        $arrPanel[$indice]->roles[$roles->ROL_id]->id = $roles->ROL_id;
                        $arrPanel[$indice]->roles[$roles->ROL_id]->nombre = $roles->ROL_nombre;
                        $arrPanel[$indice]->roles[$roles->ROL_id]->check = 0;
                        $PERMISOPANEL->_ROL_id = $roles->ROL_id;
                        $PERMISOPANEL->_PAN_id = $panel->PAN_id;
                        $rowPERMISOPANEL = $PERMISOPANEL->getRowByCols();
                        if(is_array($rowPERMISOPANEL) && count($rowPERMISOPANEL) > 0){
                            $arrPanel[$indice]->roles[$roles->ROL_id]->check = 1; 
                        }
                    }
                }
//                echo "<pre>";
//                print_r($arrPanel);
//                echo "</pre>";
                $data['panel'] = $arrPanel;
                $data['titulo'] = 'CONFIGURACIÓN';
                $this->layout->view('configuracion/panel',$data);
            }else{
                redirect('index/principal');
            }
        }else{
            redirect('index/principal');
        }
    }
    
    function panelRol(){
        $this->load->model('configuracion/permiso_panel_model', 'PERMISOPANEL');
        $PERMISOPANEL = $this->PERMISOPANEL;
        $result = 0;
        $activar = $this->input->post('activar', TRUE);
        $rol = $this->input->post('rol', TRUE);
        $panel = $this->input->post('panel', TRUE);
        $PERMISOPANEL->_ROL_id = $rol;
        $PERMISOPANEL->_PAN_id = $panel;
        if($activar == 1){
            if($PERMISOPANEL->insertar() > 0){
                $result = 1;
            }
        }else{
            if($PERMISOPANEL->delete() > 0){
                $result = 1;
            }
        }
        echo json_encode(array('result'=>$result));
    }
}
