<?php

class Grado extends CI_Controller {

    public function __construct() {
        parent :: __construct();
        $this->load->helper(array('url', 'form', 'utilitarios'));
        $this->load->library('form_validation', 'pagination', 'html');
        $this->load->model('educacion/grado_model');
        $this->load->model('educacion/curso_model');
        $this->load->model('layout/menu_model');
        $this->load->library('layout', 'layout');
    }

    public function index() {
        $this->listar();
    }

    public function listar() {
        $data['titulo'] = 'GRADOS';
        $lista = $this->grado_model->listar_grados();
        $data['lista'] = $lista;
        $this->layout->view('educacion/grado_index', $data);
    }

    public function mostrar_nuevo() {
        $data['titulo'] = 'REGISTRAR ROL';
        $data['modo'] = 'N';
        $data['nombreRol'] = '';
        $data['codigo'] = '';
        $data['menu'] = $this->menu_model->obtener_menu();
        $this->load->view('3_lecturas/rol_nuevo', $data);
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

    public function mostrar_editar($codigoRol) {
        $datosRol = $this->rol_model->obtener_rol($codigoRol);
        $data['titulo'] = 'EDITAR ROL';
        $data['modo'] = 'E';
        $data['nombreRol'] = $datosRol[0]->ROL_descripcion;
        $data['codigo'] = $datosRol[0]->ROL_codigo;
        $data['menu'] = $this->menu_model->obtener_menu();
        $this->load->view('3_lecturas/rol_nuevo', $data);
    }

    public function ver($codigoRol) {
        $datosRol = $this->rol_model->obtener_rol($codigoRol);
        $data['titulo'] = 'VER ROL';
        $data['modo'] = 'E';
        $data['nombreRol'] = $datosRol[0]->ROL_descripcion;
        $data['codigo'] = $datosRol[0]->ROL_codigo;
        $data['menu'] = $this->menu_model->obtener_menu();
        $this->load->view('3_lecturas/rol_ver', $data);
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
    
    public function getGradoAjax($nivel = 0){
        $objGrado = $this->grado_model->listar_grados_por_nivel($nivel);
        $option = '<option value="0">--Seleccione Grado--</option>';
        if(is_array($objGrado)){
            foreach ($objGrado as $value){
                $option .= '<option value="'.$value->GRAD_id.'">'.$value->GRAD_nombre.'</option>';
            }
        }
        echo $option;
    }
    public function getCursoGrado($grado = 0){
        $result = 0;
        if($grado > 0){
            $curso = $this->curso_model->getCursoGrado($grado);
            //imprimir($curso);
            $title = "";
            $cursos_td = array();
            if(is_array($curso)){
                $result = 1;
                $title = 'CURSOS A LLEVAR:';
                foreach ($curso as $i=>$value){
                    $cursos_td[$i]['CURS_id'] = $value->CURS_id;
                    $cursos_td[$i]['CURS_nombre'] = $value->CURS_nombre;
                    $cursos_td[$i]['CURS_profesores'] = array();
                    $cursos_td[$i]['CURS_profesores'] = array();
                }

            }else{
                $result = 2;
                $title = "Seleccione un grado";
            }
        }
        echo json_encode(array("result"=>$result, "title"=>$title, "cursos"=>$cursos_td));
    }
}
?>
