<?php
class Permiso extends CI_Controller{
    public function __construct() {
        parent::__construct();
        $this->load->library('layout', 'layout');
        $this->load->model('seguridad/permiso_model');
        $this->load->model('seguridad/rol_model');
        $this->load->model('layout/menu_model');
    }
    public function permisos($id){
        $arrRol = $this->rol_model->obtener_rol($id);
        if(isset($arrRol)){
            $data['rol_nombre'] = $arrRol[0]->ROL_nombre;
            $this->layout->view('seguridad/permiso_add',$data);
        }else{
            redirect('seguridad/rol/listar');
        }
    }
}