<?php

class Usuario extends CI_Controller {

    public function __construct() {
        parent :: __construct();
        $this->load->helper(array('url', 'form', 'utilitarios'));
        $this->load->library('form_validation', 'pagination', 'html');
        $this->load->model('seguridad/usuario_model');
        $this->load->model('educacion/curso_model');
        $this->load->model('educacion/documento_model');
        $this->load->model('educacion/nivel_model');
        $this->load->library('layout', 'layout');
    }

    public function index() {
        $this->listar();
    }

    public function listar() {
        $data['titulo'] = 'USUARIOS';
        $lista = $this->usuario_model->listar_usuarios();
        $data['lista'] = $lista;
        $this->layout->view('seguridad/usuario_index', $data);
    }

    public function listar_profesores() {
        $data['titulo'] = 'PROFESORES';
        $lista = $this->usuario_model->listar_usuarios_por_tipo(2);
        if ($lista) {
            foreach ($lista as $profesor) {
                $idProfesor = $profesor->USUA_id;
                $listaCursos = $this->curso_model->listar_cursos_por_profesor($idProfesor);
                $profesor->cursos = $this->pasar_lista_cursos_a_cadena($listaCursos);
            }
        }
//        imprimir($lista);
        $data['lista'] = $lista;
        $this->layout->view('persona/profesor_index', $data);
    }
    
    private function pasar_lista_cursos_a_cadena($lista) {
        $cad = '';
        if ($lista)
            foreach ($lista as $objeto) {
                $nombreCurso = $objeto->CURS_abreviatura;
                $nombreGrado = $objeto->GRAD_abreviatura;
                $nombreNivel = $objeto->NIVE_abreviatura;
                $cad .= $nombreCurso . ' - '. $nombreGrado . ' - '. $nombreNivel . '<br>';
            }
        return $cad;
    }

    public function listar_alumnos() {
        $data['titulo'] = 'ALUMNOS';
        $lista = $this->usuario_model->listar_usuarios_alumnos();
        if ($lista) {
            foreach ($lista as $alumno) {
                $idAlumno = $alumno->USUA_id;
                // listamos los padres (apoderados) declarados para este usuario (alumno)
                $listaPadres = $this->usuario_model->listar_parientes_por_usuario_minimo($idAlumno, 'A');
                $alumno->padres = pasar_lista_usuarios_a_cadena($listaPadres);
            }
        }
        $data['lista'] = $lista;
        $this->layout->view('persona/alumno_index', $data);
    }
    public function estudiante($tipo = "ALL") {
        $data['titulo'] = 'ALUMNOS';
        switch ($tipo){
            case "ALL":
                $lista = $this->usuario_model->listar_usuarios_alumnos();
                break;
            case "M":
                $lista = $this->usuario_model->listar_usuarios_alumnos_matriculados();
                break;
            case "R":
                $lista = $this->usuario_model->getEstudiantes();
                break;
            default:
                 $lista = $this->usuario_model->listar_usuarios_alumnos();
        }
        
        if ($lista) {
            foreach ($lista as $alumno) {
                $idAlumno = $alumno->USUA_id;
                // listamos los padres (apoderados) declarados para este usuario (alumno)
                $listaPadres = $this->usuario_model->listar_parientes_por_usuario_minimo($idAlumno, 'A');
                $alumno->padres = pasar_lista_usuarios_a_cadena($listaPadres);
            }
        }
        $data['lista'] = $lista;
        
        switch ($tipo){
            case "ALL":
                $this->layout->view('persona/alumno_index', $data);
                break;
            case "M":
                $this->layout->view('persona/alumno_index', $data);
                break;
            case "R":
                $this->layout->view('persona/alumno_index_reg', $data);
                break;
            default:
                $this->layout->view('persona/alumno_index', $data);
        }
    }

    public function listar_padres_familia() {
        $data['titulo'] = 'PADRES DE FAMILIA';
        $lista = $this->usuario_model->listar_usuarios_por_tipo(3);
        if ($lista) {
            foreach ($lista as $padre) {
                $idPadre = $padre->USUA_id;
                // listamos los hijos (alumnos) declarados para este usuario (padre)
                $listaAlumnos = $this->usuario_model->listar_parientes_por_usuario_minimo($idPadre, 'P');
                $padre->hijos = pasar_lista_usuarios_a_cadena($listaAlumnos);
            }
        }
        $data['lista'] = $lista;
        $this->layout->view('persona/padre_familia_index', $data);
    }

    public function listar_personal_administrativo() {
        $data['titulo'] = 'PERSONAL ADMINISTRATIVO';
        $lista = $this->usuario_model->listar_usuarios_por_tipo(3);
        $data['lista'] = $lista;
        $this->layout->view('persona/personal_administrativo_index', $data);
    }

    public function ver_observaciones($idUsuario) {
        $data['titulo'] = 'OBSERVACIONES';
        $lista = $this->usuario_model->obtener_usuario_por_id($idUsuario);
        $usuario = $lista[0];
        $data['usuario'] = $usuario;
        $data['listaObservaciones'] = desdoblar_observaciones($usuario->USUA_observaciones);
        $this->load->view('seguridad/usuario_observaciones_popup', $data);
    }

    public function ver_comentarios($idAlumno, $idProfesor, $idCurso) {
        $listaComentarios = $this->usuario_model->listar_comentarios_alumno($idAlumno, $idProfesor, $idCurso);
        $data['listaComentarios'] = $listaComentarios;
        $this->load->view('seguridad/usuario_comentarios_popup', $data);
    }
    
    public function ver_padres($idAlumno) {
        $data['titulo'] = 'PADRES DE FAMILIA';
        $alumno = $this->usuario_model->obtener_usuario_por_id($idAlumno);
        $data['alumno'] = $alumno[0];
        $listaHermanos = $this->listar_hermanos($idAlumno);
        $data['listaHermanos'] = $listaHermanos;
        $listaPadres = $this->usuario_model->listar_parientes_por_usuario($idAlumno, 'A');

        $lista = new stdClass();
        $lista->padre = null;
        $lista->madre = null;
        if ($listaPadres) {
            foreach ($listaPadres as $var) {
                if ($var->USUA_sexo == 'M')
                    $lista->padre = $var;
                elseif ($var->USUA_sexo == 'F')
                    $lista->madre = $var;
            }
        }

        $data['listaPadres'] = $lista;
        $this->load->view('seguridad/usuario_ver_padres_popup', $data);
    }
    
    public function ver_pagos($idAlumno) {
        $data['titulo'] = 'PAGO DE CUOTAS';
        $alumno = $this->usuario_model->obtener_usuario_por_id($idAlumno);
        $data['alumno'] = $alumno[0];
        $listaCuotas = $this->usuario_model->listar_cuotas_por_alumno($idAlumno);
        $data['lista'] = $listaCuotas;
        $this->load->view('seguridad/usuario_ver_pagos_popup', $data);
    }
    
    public function ver_foto($loginAlumno) {
        $data['login'] = $loginAlumno;
        $this->load->view('seguridad/usuario_ver_foto', $data);
    }

    private function listar_hermanos($idAlumno) {
        $HERMANOS = array();
        $listaPadres = $this->usuario_model->listar_parientes_por_usuario($idAlumno, 'A');
        if ($listaPadres) {
            foreach ($listaPadres as $padre) {
                $idPadre = $padre->USUA_id;
                $listaAlumnos = $this->usuario_model->listar_parientes_por_usuario_minimo($idPadre, 'P');
                $this->sumar_listas($HERMANOS, $listaAlumnos, $idAlumno);
            }
        }
        return $HERMANOS;
    }

    // devuelve un arreglo de objetos
    private function sumar_listas(&$ARREGLO, $lista, $idAlumno) {
        if ($lista)
            foreach ($lista as $objeto)
                if (!array_key_exists($objeto->USUA_id, $ARREGLO) && $objeto->USUA_id != $idAlumno)
                    $ARREGLO[$objeto->USUA_id] = $objeto;
    }

    public function mostrar_nuevo() {
        $data['titulo'] = 'REGISTRAR USUARIO';
        $data['modo'] = 'N';
        $data['nombre'] = '';
        $data['apellidoPaterno'] = '';
        $data['apellidoMaterno'] = '';
        $data['codigo'] = '';
        $data['usuario'] = '';
        $data['codigoRol'] = '';
        $this->layout->view('seguridad/profesor_nuevo', $data);
    }

    public function insertar() {
        // datos para la persona
        $nombre = $this->input->post('nombre');
        $apellidoPaterno = $this->input->post('apellidoPaterno');
        $apellidoMaterno = $this->input->post('apellidoMaterno');
        // datos para el usuario
        $usuario = $this->input->post('usuario');
        $clave = $this->input->post('clave');
        $rol = $this->input->post('rol');
        // insertamos el objeto persona
        $objetoPersona = new stdClass();
        $objetoPersona->PERS_nombre = strtoupper($nombre);
        $objetoPersona->PERS_apellidoPaterno = strtoupper($apellidoPaterno);
        $objetoPersona->PERS_apellidoMaterno = strtoupper($apellidoMaterno);
        $persona = $this->persona_model->insertar_persona($objetoPersona);
        // insertamos el objeto usuario
        $objetoUsuario = new stdClass();
        $objetoUsuario->ROL_codigo = $rol;
        $objetoUsuario->PERS_codigo = $persona;
        $objetoUsuario->USUA_usuario = $usuario;
        $objetoUsuario->USUA_password = md5($clave);
        $this->usuario_model->insertar_usuario($objetoUsuario);
    }

    public function mostrar_editar($codigoUsuario) {
        $datosUsuario = $this->usuario_model->obtener_usuario($codigoUsuario);
        $data['titulo'] = 'EDITAR USUARIO';
        $data['modo'] = 'E';
        $data['nombre'] = $datosUsuario[0]->PERS_nombre;
        $data['apellidoPaterno'] = $datosUsuario[0]->PERS_apellidoPaterno;
        $data['apellidoMaterno'] = $datosUsuario[0]->PERS_apellidoMaterno;
        $data['codigo'] = $datosUsuario[0]->USUA_codigo;
        $data['usuario'] = $datosUsuario[0]->USUA_usuario;
        $data['codigoRol'] = $datosUsuario[0]->ROL_codigo;
        $data['roles'] = $this->rol_model->listar_roles();

        $this->load->view('3_lecturas/usuario_nuevo', $data);
    }
    public function ver_user($idUsuario){
        $datosAlumno = $this->usuario_model->obtener_usuario_por_id($idUsuario);
        if($datosAlumno){
            switch ($datosAlumno[0]->ROL_id){
                case 1:
                    $this->ver($idUsuario);
                    break;
                case 2:
                    break;
                default:
            }
        }
    }
    public function ver($idUsuario) {
        $datosAlumno = $this->usuario_model->obtener_usuario_por_id($idUsuario);
        $idGrado = $datosAlumno[0]->GRAD_id;
        $data['alumno'] = $datosAlumno[0];
        $listaCursos = $this->curso_model->listar_cursos_por_alumno($idUsuario);
        imprimir($datosAlumno[0]);
        if ($listaCursos) {
            foreach ($listaCursos as $curso) {
                $idCurso = $curso->CURS_id;
                $nombreCurso = $curso->CURS_abreviatura;
                // obtenemos los profesores que dictan este curso
                $listaProfesores = $this->curso_model->listar_profesores_por_curso($idCurso);
                if($listaProfesores){
                    $curso->profesor = pasar_lista_usuarios_a_cadena($listaProfesores);
                    $curso->idProfesor = $listaProfesores[0]->USUA_id;
                    // listamos las notas del curso
                    $listaNotas = $this->curso_model->obtener_notas_por_curso_alumno($idUsuario, $idGrado, $idCurso);
                    $curso->notas = $this->pasar_formato_notas($listaNotas, $nombreCurso);
                    // listamos los comentarios de este curso
                    
                    $cantidadComentarios = $this->usuario_model->contar_comentarios_alumno($idUsuario, $listaProfesores[0]->USUA_id, $idCurso);
                    $curso->comentarios = $cantidadComentarios[0]->total;
                }else{
                    $curso->comentarios = 0;
                    $curso->profesor = "";
                    $curso->notas = array();
                }
            }
        }
        
        $data['listaCursos'] = $listaCursos;
        $listaDocumentos = $this->documento_model->contar_documentos('A');
        $listaDocumentosEntregados = $this->documento_model->contar_documentos_entregados($idUsuario, $idGrado);
        $data['documentosPendientes'] = $listaDocumentos[0]->total - $listaDocumentosEntregados[0]->total;
        $this->layout->view('seguridad/usuario_ver', $data);
    }
    
    public function ver_profesor($idProfesor) {
        $datosProfesor = $this->usuario_model->obtener_usuario_por_id($idProfesor);
        $data['profesor'] = $datosProfesor[0];
        $listaCursos = $this->curso_model->listar_cursos_por_profesor($idProfesor);
        $data['titulo'] = 'CURSOS';
        $data['listaCursos'] = $listaCursos;
        
        $documentosPendientes = $this->documento_model->contar_documentos_pendientes($idProfesor);
        $data['documentosPendientes'] = $documentosPendientes[0]->total;
        
        $this->layout->view('seguridad/usuario_profesor_ver', $data);
    }

    private function pasar_formato_notas($listaNotas, $nombreCurso) {
        $NOTAS = array();
        if ($listaNotas) {
            foreach ($listaNotas as $nota) {
                $bimestre = $nota->BIME_id;
                $parcial1 = $nota->CALI_parcial1;
                $parcial2 = $nota->CALI_parcial2;
                $promedio = round(($parcial1 + $parcial2) / 2);
                $parciales = utf8_encode($nombreCurso) . ' : Primer Parcial = ' . $parcial1 . ', Segundo Parcial = ' . $parcial2;
                $NOTAS[$bimestre] = array('promedio' => $promedio, 'parciales' => $parciales);
            }
        }
        return $NOTAS;
    }

    public function modificar() {
        // datos de la persona
        $codigo = $this->input->post('codigo');
        $nombre = $this->input->post('nombre');
        $apellidoPaterno = $this->input->post('apellidoPaterno');
        $apellidoMaterno = $this->input->post('apellidoMaterno');
        // datos del usuario
        $usuario = $this->input->post('usuario');
        $clave = $this->input->post('clave');
        $rol = $this->input->post('rol');
        // aplicamos los cambios en la persona
        $datosUsuario = $this->usuario_model->obtener_usuario($codigo);
        $persona = $datosUsuario[0]->PERS_codigo;
        $objetoPersona = new stdClass();
        $objetoPersona->PERS_nombre = strtoupper($nombre);
        $objetoPersona->PERS_apellidoPaterno = strtoupper($apellidoPaterno);
        $objetoPersona->PERS_apellidoMaterno = strtoupper($apellidoMaterno);
        $this->persona_model->modificar($objetoPersona, $persona);
        // aplicamos los cambios en el usuario
        $objetoUsuario = new stdClass();
        $objetoUsuario->ROL_codigo = $rol;
        $objetoUsuario->PERS_codigo = $persona;
        $objetoUsuario->USUA_usuario = $usuario;
        if ($clave)
            $objetoUsuario->USUA_password = md5($clave);

        $this->usuario_model->modificar_usuario($objetoUsuario, $codigo);
    }

    public function eliminar($tipo, $codigoUsuario) {
        $this->usuario_model->eliminar_usuario($codigoUsuario);
        switch ($tipo){
            case "profesor":
                redirect('seguridad/usuario/listar_profesores');
                break;
            default:
                redirect('seguridad/usuario/listar_profesores');
        }
        
    }
    public function activar($tipo, $codigoUsuario) {
        $this->usuario_model->activar_usuario($codigoUsuario);
        switch ($tipo){
            case "profesor":
                redirect('seguridad/usuario/listar_profesores');
                break;
            default:
                redirect('seguridad/usuario/listar_profesores');
        }
    }
    public function alumnonuevo(){
        $data['nivel'] = $this->nivel_model->listar_niveles();
        $data['titulo'] = "NUEVO ALUMNO";
        $this->layout->view('persona/alumno_nuevo',$data);
    }
    
    public function insertProfesor(){
        $post = $this->input->post();
        $objProfesor = new stdClass();
        $objProfesor->tipo = "PROF";
        $objProfesor->nombre = $post['nombre'];
        $objProfesor->paterno = $post['paterno'];
        $objProfesor->materno = $post['materno'];
        $objProfesor->materno = $post['materno'];
        $objProfesor->dni = $post['dni'];
        $objProfesor->email = $post['email'];
        $objProfesor->sexo = $post['sexo'];
        $objProfesor->grado = 2;
        $profesor = $this->usuario_model->insert($objProfesor);
        if($profesor > 0){
            redirect('seguridad/usuario/listar_profesores');
        }else{
            redirect('seguridad/usuario/mostrar_nuevo');
        }
    }
    
    public function insertAlumno(){
        $post = $this->input->post();
        $ObjAlumno = new stdClass();
        $ObjAlumno->tipo = "ALU";
        $ObjAlumno->nombre = $post['nombre'];
        $ObjAlumno->paterno = $post['paterno'];
        $ObjAlumno->materno = $post['materno'];
        $ObjAlumno->materno = $post['materno'];
        $ObjAlumno->dni = $post['dni'];
        $ObjAlumno->email = $post['email'];
        $ObjAlumno->sexo = $post['sexo'];
        $ObjAlumno->grado = 1;
        $alumno = $this->usuario_model->insert($ObjAlumno);
        $tipo = "PAD";
        $sexo = "M";
        for($cont = 0; $cont < 2; $cont++){
            if($cont == 1){
                $tipo = "MAD";
                $sexo = "F";
            }
            $padre = $post['padre_id'][$cont];
            if($padre==""){
                $ObjPadre           = new stdClass();
                $ObjPadre->tipo     = $tipo;
                $ObjPadre->dni      = $post['padre_dni'][$cont];
                $ObjPadre->nombre   = $post['padre_nombre'][$cont];
                $ObjPadre->paterno  = $post['padre_paterno'][$cont];
                $ObjPadre->materno  = $post['padre_materno'][$cont];
                $ObjPadre->telefono = $post['padre_fono'][$cont];
                $ObjPadre->sexo     = $sexo;
                $ObjPadre->grado    = 3;
                $padre = $this->usuario_model->insert($ObjPadre);
            }
            $this->load->model('usuario/pariente_model', 'Pariente');
            $relacion           = new stdClass();
            $relacion->alumno   = $alumno;
            $relacion->padre    = $padre;
            $relacion->relacion = $tipo;
            $this->Pariente->insert($relacion);
        }        
        
        redirect('seguridad/usuario/estudiante/R');
    }
    
    public function relacion(){
        $tipo = $_POST['tipo'];
        $dni = $_POST['value'];
        $datos = array();
        $datos['return']    = 0;
        switch ($tipo){
            case "MAD":
                $datos['tipo'] = 1;
                break;
            case "PAD":
                $datos['tipo'] = 0;
                break;
            case "TUT":
                break;
        }
        if(strlen(trim($dni)) == 8){
            switch ($tipo){
                case "ALU":
                    $data = $this->usuario_model->buscar_dni_alumno_padres($dni);
                    break;
                case "MAD":
                    $data = $this->usuario_model->buscar_dni($dni, $tipo);
                    break;
                case "PAD":
                    $data = $this->usuario_model->buscar_dni($dni, $tipo);
                    break;
                case "TUT":
                    break;
            }
            if($data){
//                if($tipo == "ALU"){
//                    $datos['return'] = 1;
//                    foreach ($data as $val){
//                        if($val->USUA_sexo == "M"){
//                            $datos['padre'] = $val;
//                        }else{
//                            $datos['madre'] = $val;
//                        }
//                    }
//                }else{
                    foreach ($data as $value){
                        $datos['return'] = 1;
                        $datos['key'] = $value->USUA_id;
                        $datos['nombre'] = $value->USUA_nombres;
                        $datos['paterno'] = $value->USUA_apellidoPaterno;
                        $datos['materno'] = $value->USUA_apellidoMaterno;
                        $datos['telefono'] = $value->USUA_telefonos;
                    }
//                }
            }
        }
        echo json_encode($datos);
    }
    
    public function perfil(){
        $rol = $this->session->userdata('idRol'); 
        $user = $this->session->userdata('idUsuario');
        $objUser = $this->usuario_model->obtener_usuario_por_id($user);
        $view = 'persona/perfil_index';
        $edit = 0;
        if($objUser){
            $data['usuario'] = $objUser[0];
            $data['titulo'] = "PERFIL";
            switch ($rol){
                case 5:
                    $view = 'persona/perfil_index';
                    $edit = 1;
                    break;
                default :
                    
            }
            $this->layout->view($view , $data);
        }else{
            redirect('index/principal');
        }
    }
}

?>
