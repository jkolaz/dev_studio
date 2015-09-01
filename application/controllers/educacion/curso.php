<?php

class Curso extends CI_Controller {

    public function __construct() {
        parent :: __construct();
        $this->load->helper(array('url', 'form', 'utilitarios'));
        $this->load->library('form_validation', 'pagination', 'html');
        $this->load->model('educacion/curso_model');
        $this->load->model('educacion/grado_model');
        $this->load->model('educacion/criterio_model', 'criterio');
        $this->load->model('nota/calificacion_model', 'calificacion');
        $this->load->model('seguridad/usuario_model');
        $this->load->model('layout/menu_model');
        $this->load->library('layout', 'layout');
    }

    public function index() {
        $this->listar();
    }

    public function listar() {
        $rol = $this->session->userdata('idRol'); 
        $profesor = $this->session->userdata('idUsuario'); 
        switch ($rol){
            case 5:
            case 2:
                $this->verCursoByProfesor($profesor);
                break;
            default:
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
        
    }

    public function ver($idNivel) {
        $lista = $this->grado_model->listar_grados_por_nivel($idNivel);
        $data['titulo'] = 'NIVEL - ' . $lista[0]->NIVE_nombre;
        $data['lista'] = $lista;
        $this->load->view('educacion/nivel_deudas_popup', $data);
    }
    public function verProfesores($grado) {
        $obProfesores = $this->curso_model->getProfesorByGrado($grado);
        $data['curso'] = $grado;
        $data['titulo'] = 'NIVEL - ' ;
        $data['lista'] = $obProfesores;
        $this->load->view('educacion/ver_profesores_popup', $data);
    }
    
    public function nuevaAsignacion($curso){
        $obProfesores = $this->curso_model->getProfesoresByCurso($curso);
        
        $data['curso'] = $curso;
        $data['titulo'] = 'ESCOGER CURSO' ;
        $data['lista'] = $obProfesores;
        $this->load->view('educacion/choose_asignado_popup', $data);
    }
    
    public function agregarProfesor(){
        $curso = $this->input->post('curso', TRUE);
        $profesors = $this->input->post('profesores', TRUE);
        $insert = array();
        foreach (explode(",", $profesors) as $value){
            if($value != "" && $value > 0){
                $insert[] = array('CURS_id' => $curso, 'USUA_id' => $value);
            }
        }
        if(count($insert) > 0){
            $this->curso_model->insertarAsignadoMasivo($insert);
            $result = 1;
        }else{
            $result = 0;
        }
        echo json_encode(array('result'=>$result));
    }

    public function eliminarAsignacion(){
        $this->load->model('educacion/asignacion_model', 'asignacion');
        $curso = $this->input->post('curso', TRUE);
        $profesor = $this->input->post('profesor', TRUE);
        $this->asignacion->eliminarAsignacion($curso, $profesor);
        $result = 1;
        echo json_encode(array('result'=>$result));
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
        $this->load->model('matricula/bimestre_model', 'bimestre');
        $bimestre = $this->bimestre->getBimestreById($idBimestre);
        $data['bimestre'] = $bimestre;
        $listaDetalleNotas = $this->curso_model->listar_detalle_notas($idUsuario, $idGrado, $idCurso, $idBimestre);        
        $DETALLE = pasar_lista_a_matriz($listaDetalleNotas, 'CALD_parcial', 'CRIT_id', 'CALD_nota');
        $data['DETALLE'] = $DETALLE;
        $listaCriterios = $this->curso_model->listar_criterios();
        $data['CRITERIOS'] = pasar_lista_a_arreglo($listaCriterios, 'CRIT_id', 'CRIT_nombre');
        $data['lista'] = $listaDetalleNotas;
        $usuario = $this->usuario_model->obtener_usuario_por_id($idUsuario);
        $data['usuario'] = $usuario;
        $data['idUsuario'] = $idUsuario;
        $data['idGrado'] = $idGrado;
        $data['idCurso'] = $idCurso;
        $data['idBimestre'] = $idBimestre;
//        echo "<pre>";
//        print_r($DETALLE);
//        echo "</pre>";
//        echo "<pre>";
//        print_r($listaDetalleNotas);
//        echo "</pre>";
        $this->load->view('educacion/notas_detalle_popup', $data);
    }

    public function updateNota(){
        $idUsuario = $this->input->post('idUsuario',TRUE);
        $idGrado = $this->input->post('idGrado',TRUE);
        $idCurso = $this->input->post('idCurso',TRUE);
        $idBimestre = $this->input->post('idBimestre',TRUE);
        $criterio = $this->input->post('criterio',TRUE);
        $calificacion = $this->calificacion->getCalifiacion($idUsuario, $idGrado, $idCurso, $idBimestre);
        $idCALI = $calificacion[0]->CALI_id;
        $cant_criterio = $this->criterio->countCriterio();
        $nota = 0;
        foreach ($criterio as $id=>$value){
            $this->curso_model->updateNota($id, $value);
            $nota += $value;
        }
        $promedio = $nota/$cant_criterio;
        $this->calificacion->update($idCALI,$promedio);
        redirect('educacion/curso/ver_detalle/'.$idUsuario.'/'.$idGrado.'/'.$idCurso.'/'.$idBimestre);
    }
    
    public function mostrar_nuevo() {
        $curso = new stdClass();
        $curso->CURS_id = 0;
        $curso->CURS_nombre = "";
        $curso->CURS_abreviatura = "";
        $curso->CURS_horas = "";
        $obGrado = $this->grado_model->listar_grados();
        $data['idCurso'] = 0;
        $data['grado'] = $obGrado;
        $data['curso'] = $curso;
        $data['titulo'] = 'REGISTRAR NUEVO CURSO';
        $data['action'] = 'insertarCurso';
        $this->layout->view('educacion/curso_nuevo', $data);
    }
    public function insertarCurso(){
        $curso = $this->input->post('curso',true);
        $nombre = $this->input->post('nombre',true);
        $abreviatura = $this->input->post('abreviatura',true);
        $hora = $this->input->post('hora',true);
        $grado = $this->input->post('grado',true);
        $countCurso = $this->curso_model->countCursoByColsAndGrado('CURS_nombre', $nombre, $grado);
        if($countCurso == 0){
            if($abreviatura == ""){
                $abreviatura = $nombre;
            }
            $insert = array();
            $insert['CURS_nombre'] = $nombre;
            $insert['CURS_abreviatura'] = $abreviatura;
            $insert['CURS_horas'] = $hora;
            $insert['GRAD_id'] = $grado;
            $id = $this->curso_model->insertar($insert);
            if($id > 0){
                redirect('educacion/curso');
            }else{
                redirect('educacion/mostrar_nuevo');
            }
        }else{
            redirect('educacion/mostrar_nuevo');
        }
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
        $obCurso = $this->curso_model->obtener_curso($codigoRol);
        if(is_array($obCurso)){
            $curso = new stdClass();
            foreach ($obCurso as $value){
                $curso = $value;
            }
            $obGrado = $this->grado_model->listar_grados();
            $data['idCurso'] = $codigoRol;
            $data['grado'] = $obGrado;
            $data['curso'] = $curso;
            $data['titulo'] = 'EDITAR CURSO';
            $data['action'] = 'modificar';
            $this->layout->view('educacion/curso_nuevo', $data);
        }else{
            redirect('educacion/curso');
        }
    }

    public function modificar() {
        $curso = $this->input->post('curso',true);
        $nombre = $this->input->post('nombre',true);
        $abreviatura = $this->input->post('abreviatura',true);
        $hora = $this->input->post('hora',true);
        $grado = $this->input->post('grado',true);
        if($abreviatura == ""){
            $abreviatura = $nombre;
        }
        $update = array();
        $update['CURS_nombre'] = $nombre;
        $update['CURS_abreviatura'] = $abreviatura;
        $update['CURS_horas'] = $hora;
        $update['GRAD_id'] = $grado;
        $this->curso_model->modificarCurso($update, $curso);
        redirect('educacion/curso');
    }

    public function eliminar($idRol) {
        $this->rol_model->eliminar_rol($idRol);
        redirect('seguridad/rol/listar');
    }
    
    public function listarCurso(){
        $rol = $this->session->userdata('idRol'); 
        $profesor = $this->session->userdata('idUsuario'); 
        switch ($rol){
            case 5:
            case 2:
                $this->verCursoByProfesor($profesor);
                break;
            default:
                redirect('index/principal');
        }
    }
    public function verCursoByProfesor($profesor){
        $objCurso = $this->curso_model->cursoByProfesor($profesor);
        $data['lista'] = $objCurso;
        $data['titulo'] = 'LISTA DE CURSOS';
        $this->layout->view('educacion/curso_profesor',$data);
    }

}

?>
