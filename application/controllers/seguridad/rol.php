<?php

class Rol extends CI_Controller {

    public function __construct() {
        parent :: __construct();
        $this->load->helper(array('url', 'form', 'utilitarios'));
        $this->load->library('form_validation', 'pagination', 'html');
        $this->load->model('seguridad/rol_model');
//        $this->load->model('seguridad/permiso_model');
        $this->load->model('layout/menu_model');
        $this->load->library('layout', 'layout');
    }

    public function index() {
        $this->listar();
    }

    public function listar() {
        $data['titulo'] = 'ROLES';
        $lista = $this->rol_model->listar_roles();
        $data['lista'] = $lista;
        $this->layout->view('seguridad/rol_index', $data);
    }

    public function formulario($tipo, $id=0) {
        $titulo = "";
        $idRol = $id;
        $action = "";
        switch ($tipo){
            case "nuevo":
                $rol = new stdClass();
                $rol->ROL_id = 0;
                $rol->ROL_nombre = "";
                $titulo = "REGISTRAR ROL";
                $action = "insert";
                break;
            case "editar":
                $rol = null;
                if($id > 0){
                    $objRol = $this->rol_model->obtener_rol($id);
                    if($objRol){
                        $rol = $objRol[0];
                    }else{
                        redirect('seguridad/rol/listar');
                    }
                    $titulo = "EDITAR ROL";
                    $action = "update";
                }else{
                    redirect('seguridad/rol/listar');
                }
                break;
        }
        $data['rol']    = $rol;
        $data['titulo'] = $titulo;
        $data['idRol']  = $idRol;
        $data['action'] = $action;
        $data['menu'] = $this->menu_model->obtener_menu();
        $this->layout->view('seguridad/rol_nuevo', $data);
    }

    public function insertar() {
        $nombre = $this->input->post('nombreRol');
        $menuPadre = $this->input->post('nombre');
        $menuHijo = $this->input->post('checkO');
        
        $objetoRol = new stdClass();
        $objetoRol->ROL_descripcion = strtoupper($nombre);
        $rol = $this->rol_model->insertar_rol($objetoRol);

        if (is_array($menuPadre)) {
            foreach ($menuPadre as $valorPadre) {
                if ($valorPadre != '') {
                    $objetoPermisoPadre = new stdClass();
                    $objetoPermisoPadre->ROL_codigo = $rol;
                    $objetoPermisoPadre->MENU_codigo = $valorPadre;
                    $this->permiso_model->insertar_permiso($objetoPermisoPadre);
                }
            }
        }
        
        if (is_array($menuHijo)) {
            foreach ($menuHijo as $valorHijo) {
                if ($valorHijo != '') {
                    $objetoPermisoHijo = new stdClass();
                    $objetoPermisoHijo->ROL_codigo = $rol;
                    $objetoPermisoHijo->MENU_codigo = $valorHijo;
                    $this->permiso_model->insertar_permiso($objetoPermisoHijo);
                }
            }
        }
    }

    public function ver($codigoRol) {
        $datosRol           = $this->rol_model->obtener_rol($codigoRol);
        $data['titulo']     = 'VER ROL';
        $data['modo']       = 'E';
        $data['nombreRol']  = $datosRol[0]->ROL_nombre;
        $data['codigo']     = $datosRol[0]->ROL_id;
        $data['menu']       = $this->menu_model->obtener_menu();
        $data['rol_id']     = $codigoRol;
        $this->load->view('seguridad/rol_ver', $data);
    }

    public function modificar() {
        $nombre = $this->input->post('nombreRol');
        $rol = $this->input->post('codigo');
        
        $objeto = new stdClass();
        $objeto->ROL_descripcion = strtoupper($nombre);
        $this->rol_model->modificar_rol($objeto, $rol);
        $menuPadre = $this->input->post('nombre');
        $menuHijo = $this->input->post('checkO');
        $this->permiso_model->eliminar_permiso($rol);
        
        if (is_array($menuPadre)) {
            foreach ($menuPadre as $valorPadre) {
                if ($valorPadre != '') {
                    $objetoPermisoPadre = new stdClass();
                    $objetoPermisoPadre->ROL_codigo = $rol;
                    $objetoPermisoPadre->MENU_codigo = $valorPadre;
                    $this->permiso_model->insertar_permiso($objetoPermisoPadre);
                }
            }
        }
        
        if (is_array($menuHijo)) {
            foreach ($menuHijo as $valorHijo) {
                if ($valorHijo != '') {
                    $objetoPermisoHijo = new stdClass();
                    $objetoPermisoHijo->ROL_codigo = $rol;
                    $objetoPermisoHijo->MENU_codigo = $valorHijo;
                    $this->permiso_model->insertar_permiso($objetoPermisoHijo);
                }
            }
        }
    }

    public function eliminar($idRol) {
        $this->rol_model->eliminar_rol($idRol);
        redirect('seguridad/rol/listar');
    }
    
    public function request(){
        $tipo = $this->input->post('action', true);
        $nombre = $this->input->post('nombre', true);
        $id = $this->input->post('rol', true);
        $user = $this->session->userdata('idUsuario');
        $datos = array();
        $datos['ROL_nombre'] = $nombre;
        if(isset($tipo)){
            switch ($tipo){
                case "insert":
                    $datos['ROL_fechaRegistro'] = date('Y-m-d H:i:s');
                    $datos['ROL_usuarioRegistro'] = $user;
                    $this->rol_model->insertar_rol($datos);
                    redirect('seguridad/rol/listar');
                    break;
                case "update":
                    $datos['ROL_fechaModificacion'] = date('Y-m-d H:i:s');
                    $datos['ROL_usuarioModificacion'] = $user;
                    $this->rol_model->modificar_rol($datos, $id);
                    redirect('seguridad/rol/listar');
                    break;
                default:
                    redirect('seguridad/rol/listar');
            }
        }else{
            redirect('seguridad/rol/listar');
        }
    }
    
    public function update($tipo, $id){
        $user = $this->session->userdata('idUsuario');
        $data = array();
        if($tipo == "activar"){
            $data['ROL_estado'] = "AC";
        }else{
            $data['ROL_estado'] = "BL";
        }
        $data['ROL_fechaModificacion'] = date('Y-m-d H:i:s');
        $data['ROL_usuarioModificacion'] = $user;
        $this->rol_model->modificar_rol($data, $id);
        //imprimir($data);exit;
        redirect('seguridad/rol/listar');
    }

}

?>