<?php

class Curso extends CI_Controller {

    public function __construct() {
        parent :: __construct();
        $this->load->helper(array('url', 'form', 'utilitarios'));
        $this->load->library('form_validation', 'pagination', 'html');
        $this->load->model('educacion/curso_model');
        $this->load->model('educacion/grado_model');
        $this->load->model('seguridad/usuario_model');
        $this->load->model('layout/menu_model');
        $this->load->library('layout', 'layout');
    }

    public function index() {
        $this->listar();
    }

    public function listar() {
        $data['titulo'] = 'CURSOS';
        $lista = $this->curso_model->listar_cursos();
        if ($lista) {
            foreach ($lista as $curso) {
                $idCurso = $curso->CURS_id;
                $listaProfesores = $this->curso_model->listar_profesores_por_curso($idCurso);
                $curso->profesores = pasar_lista_usuarios_a_cadena($listaProfesores);
            }
        }
        $data['lista'] = $lista;
        $this->layout->view('educacion/curso_index', $data);
    }

    public function ver($idNivel) {
        $lista = $this->grado_model->listar_grados_por_nivel($idNivel);
        $data['titulo'] = 'NIVEL - ' . $lista[0]->NIVE_nombre;
        $data['lista'] = $lista;
        $this->load->view('educacion/nivel_deudas_popup', $data);
    }

    public function editar($idCurso, $idProfesor) {
        $curso = $this->curso_model->obtener_curso($idCurso);
        $data['curso'] = $curso[0];

        $listaAlumnos = $this->curso_model->listar_alumnos_por_curso($idCurso);
        if ($listaAlumnos) {
            foreach ($listaAlumnos as $alumno) {
                $idAlumno = $alumno->USUA_id;
                $comentarios = $this->usuario_model->contar_comentarios_alumno($idAlumno, $idProfesor, $idCurso);
                $alumno->comentarios = $comentarios[0]->total;
            }
        }
        
        $data['listaAlumnos'] = $listaAlumnos;
        $data['idProfesor'] = $idProfesor;

        $this->layout->view('educacion/curso_notas_editar', $data);
    }

    public function ver_detalle($idUsuario, $idGrado, $idCurso, $idBimestre) {
        $listaDetalleNotas = $this->curso_model->listar_detalle_notas($idUsuario, $idGrado, $idCurso, $idBimestre);
        $DETALLE = pasar_lista_a_matriz($listaDetalleNotas, 'CALD_parcial', 'CRIT_id', 'CALD_nota');
        $data['DETALLE'] = $DETALLE;
        $listaCriterios = $this->curso_model->listar_criterios();
        $data['CRITERIOS'] = pasar_lista_a_arreglo($listaCriterios, 'CRIT_id', 'CRIT_nombre');
        $this->load->view('educacion/notas_detalle_popup', $data);
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

}

?>
