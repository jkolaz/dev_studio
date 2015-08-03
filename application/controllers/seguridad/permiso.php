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
    public function RolMenu(){
        $result = 0;
        $rol = $this->input->post('rol', TRUE);
        $menu = $this->input->post('menu', TRUE);
        $activar = $this->input->post('activar', TRUE);
        $arrPermiso = $this->permiso_model->busca_permiso($rol, $menu);
        if($activar == 1){
            /*activar*/
            if(!$arrPermiso){
                $where['ROL_id'] = $rol;
                $where['MENU_id'] = $menu;
                $this->permiso_model->insertar_permiso($where);
            }
            $result = 1;
        }else{
            if(is_array($arrPermiso) && count($arrPermiso) > 0){
                $this->permiso_model->eliminar_permiso_unico($arrPermiso[0]->ROL_id, $menu);
            }
            $result = 2;
        }
        echo json_encode(array('result'=>$result));
    }
    public function RolMenuPadre(){
        $result = 0;
        $rol = $this->input->post('rol', TRUE);
        $menu = $this->input->post('menu', TRUE);
        $activar = $this->input->post('activar', TRUE);
        $sub_menu_activo = $this->input->post('sub_menu_activo', TRUE);
        $sub_menu_desactivo = $this->input->post('sub_menu_desactivo', TRUE);
        $arrPermiso = $this->permiso_model->busca_permiso($rol, $menu);
        if($activar == 1){
            /*activar*/
            if(!$arrPermiso){
                $where['ROL_id'] = $rol;
                $where['MENU_id'] = $menu;
                $this->permiso_model->insertar_permiso($where);
                foreach (explode(',', $sub_menu_desactivo) as $desactivo){
                    if($desactivo > 0){
                        $arrPermiso1 = $this->permiso_model->busca_permiso($rol, $desactivo);
                        if(!$arrPermiso1){
                            $where1['ROL_id'] = $rol;
                            $where1['MENU_id'] = $desactivo;
                            $this->permiso_model->insertar_permiso($where1);
                        }
                    }
                }
            }
            $result = 1;
        }else{
            if(is_array($arrPermiso) && count($arrPermiso) > 0){
                foreach (explode(',', $sub_menu_activo) as $activo){
                    if($activo){
                        $arrPermiso2 = $this->permiso_model->busca_permiso($rol, $activo);
                        if(is_array($arrPermiso2) && count($arrPermiso2) > 0){
                            $this->permiso_model->eliminar_permiso_unico($arrPermiso[0]->ROL_id, $activo);
                        }
                    }
                }
                $this->permiso_model->eliminar_permiso_unico($arrPermiso[0]->ROL_id, $menu);
            }
            $result = 2;
        }
        echo json_encode(array('result'=>$result));
    }
}