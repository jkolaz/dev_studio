<?php

class Curso_model extends CI_Model {

    private static $tabla = 'curso';
    private static $tablaAsignado = 'asignado';

    public function __construct() {
        parent :: __construct();
        $this->load->database();
        $this->load->model('layout/menu_model');
    }

    public function listar_cursos() {
        $this->db->where('CURS_flagActivo', 'A');
        $this->db->where('NIVE_flagActivo', 'A');
        $this->db->join('grado', 'grado.GRAD_id = ' . self::$tabla . '.GRAD_id');
        $this->db->join('nivel', 'nivel.NIVE_id = grado.NIVE_id');
        $this->db->order_by('grado.GRAD_id, GRAD_numero, CURS_estado, CURS_nombre');
        $query = $this->db->get(self::$tabla);
        if ($query->num_rows > 0)
            return $query->result();
        return null;
    }

    public function obtener_curso($idCurso) {
        $this->db->where('CURS_id', $idCurso);
        $query = $this->db->get(self::$tabla);
        if ($query->num_rows > 0)
            return $query->result();
        return null;
    }
    public function countCursoByColsAndGrado($col, $value, $grado){
        $this->db->where("GRAD_id", $grado);
        $this->db->where($col, $value);
        $query = $this->db->get(self::$tabla);
        return $query->num_rows;
    }

    public function listar_profesores_por_curso($idCurso) {
        $sql = "select *
                from asignado A, usuario U
                where A.USUA_id = U.USUA_id
                      and A.CURS_id = $idCurso
                order by USUA_apellidoPaterno, USUA_apellidoPaterno, USUA_nombres";
        $query = $this->db->query($sql);
        if ($query->num_rows > 0)
            return $query->result();
        return null;
    }

    public function obtener_notas_por_curso_alumno($idAlumno, $idGrado, $idCurso) {
        $sql = "select *
                from calificacion
                where USUA_id = $idAlumno and GRAD_id = $idGrado and CURS_id = $idCurso";
        $query = $this->db->query($sql);
        if ($query->num_rows > 0)
            return $query->result();
        return null;
    }
    
    public function listar_bimestres() {
        $sql = "select *
                from bimestre";
        $query = $this->db->query($sql);
        if ($query->num_rows > 0)
            return $query->result();
        return null;
    }
    
    public function updateNota($idDetalle,  $nota){
        $where = array();
        $where['CALD_id'] = $idDetalle;
        $update = array();
        $update['CALD_nota'] = $nota;
        $this->db->where($where)->update('calificacion_detalle', $update);
    }
    
    public function listar_detalle_notas($idUsuario, $idGrado, $idCurso, $idBimestre, $asignado=0) {
        $sqlCurso = "select * from curso where CURS_id='{$idCurso}'";
        $queryCurso = $this->db->query($sqlCurso);
        $row = $queryCurso->result();
        //imprimir($row);
        $where = "";
        
        $sql = "select *
                from calificacion_detalle a, criterio b
                where a.USUA_id = $idUsuario
                      and a.GRAD_id = $idGrado
                      and a.CURS_id = $idCurso
                      and a.BIME_id = $idBimestre
                          and  a.CRIT_id = b.CRIT_id
                order by a.CALD_parcial, a.CRIT_id";
        $query = $this->db->query($sql);
        if ($query->num_rows > 0){
            return $query->result();
        }else{
            $idCalificacion = $this->insertar_nota_inicial($idUsuario, $idGrado, $idCurso, $idBimestre, $asignado);
            if($idCalificacion > 0){
                $sql_criterio = "SELECT * FROM criterio";
                $query_criterio = $this->db->query($sql_criterio);
                if ($query_criterio->num_rows > 0){
                    foreach ($query_criterio->result() as $value){
                        $idCriterio = $value->CRIT_id;
                        $this->insertar_nota_detalle_inicial($idUsuario, $idGrado, $idCurso, $idBimestre, $idCalificacion, $idCriterio);
                    }
                }
            }
            $query = $this->db->query($sql);
            if ($query->num_rows > 0){
                return $query->result();
            }
            return null;
        }
    }
    
    public function listar_detalle_notas_new($idCalificacion){
        $where = array();
        $where['CALI_id'] = $idCalificacion;
        $where['CALD_estado'] = 1;
        $query = $this->db->where($where)->join('criterio', 'criterio.CRIT_id = calificacion_detalle.CRIT_id')->get('calificacion_detalle');
        if ($query->num_rows > 0){
            return $query->result();
        }else{
            $this->insertar_nota_detalle_inicial_new($idCalificacion);
            $query = $this->db->where($where)->join('criterio', 'criterio.CRIT_id = calificacion_detalle.CRIT_id')->get('calificacion_detalle');
            if ($query->num_rows > 0){
                return $query->result();
            }
            return null;
        }
    }
    
    public function insertar_nota_inicial($idUsuario, $idGrado, $idCurso, $idBimestre, $asignado=0){
        $insert['USUA_id'] = $idUsuario;
        $insert['GRAD_id'] = $idGrado;
        $insert['CURS_id'] = $idCurso;
        $insert['BIME_id'] = $idBimestre;
        $insert['CALI_fechaRegistro'] = date('Y-m-d H:i:s');
        if($asignado > 0){
            $insert['ASIG_id'] = $asignado;
        }
        $this->db->insert('calificacion', $insert);
        return $this->db->insert_id();
    }
    public function insertar_nota_detalle_inicial($idUsuario, $idGrado, $idCurso, $idBimestre, $idCalificacion, $idCriterio){
        $insert['USUA_id'] = $idUsuario;
        $insert['GRAD_id'] = $idGrado;
        $insert['CURS_id'] = $idCurso;
        $insert['BIME_id'] = $idBimestre;
        $insert['CALI_id'] = $idCalificacion;
        $insert['CRIT_id'] = $idCriterio;
        $insert['CALD_fechaRegistro'] = date('Y-m-d H:i:s');
        $this->db->insert('calificacion_detalle', $insert);
        return $this->db->insert_id();
    }

    public function insertar_nota_detalle_inicial_new($idCalificacion){
        $CI =& get_instance();
        $CI->load->model('nota/calificacion_model', 'calificacion');
        $objCalificacion = $CI->calificacion->getCalificacionByID($idCalificacion);
        if($objCalificacion){
            $cal = $objCalificacion[0];
            $sql_criterio = "SELECT * FROM criterio";
            $query_criterio = $this->db->query($sql_criterio);
            if ($query_criterio->num_rows > 0){
                foreach ($query_criterio->result() as $i=>$value){
                    $insert['USUA_id'] = $cal->USUA_id;
                    $insert['GRAD_id'] = $cal->GRAD_id;
                    $insert['CURS_id'] = $cal->CURS_id;
                    $insert['BIME_id'] = $cal->	BIME_id;
                    $insert['CALI_id'] = $idCalificacion;
                    $insert['CRIT_id'] = $value->CRIT_id;
                    $insert['CALD_fechaRegistro'] = date('Y-m-d H:i:s');
                    $this->db->insert('calificacion_detalle', $insert);
                    //return $this->db->insert_id();
                }
            }
        }
        
        
    }

    public function listar_criterios() {
        $query = $this->db->get('criterio');
        if ($query->num_rows > 0)
            return $query->result();
        return null;
    }
    
    public function getProfesorByGrado($curso){
        $this->db->where('asignado.ASIG_flagActivo', 'A');
        $this->db->where('curso.CURS_id', $curso);
        $this->db->where('curso.CURS_flagActivo', 'A');
        $this->db->where('usuario.USUA_flagActivo', 'A');
        $this->db->where('usuario.ROL_id', 2);
        $query = $this->db->join('asignado','asignado.CURS_id='.self::$tabla.'.CURS_id')
                    ->join('usuario', 'usuario.USUA_id=asignado.USUA_id')
                    ->get(self::$tabla);
        if($query->num_rows > 0){
            return $query->result();
        }
        return null;
    }
    
    public function listar_cursos_por_profesor($idProfesor) {
        $sql = "select *
                from asignado A, curso C, grado G, nivel N
                where A.CURS_id = C.CURS_id
                      and C.GRAD_id = G.GRAD_id
                      and G.NIVE_id = N.NIVE_id
                      and A.USUA_id = $idProfesor";
        $query = $this->db->query($sql);
        if ($query->num_rows > 0)
            return $query->result();
        return null;
    }

    public function listar_cursos_por_alumno($idAlumno) {
        $sql = "select *
                from grado_x_usuario GU, curso_x_grado_x_usuario CGU, curso C
                where GU.USUA_id = $idAlumno
                      and GU.GXUS_estado = 'AC'
                      and GU.GXU_id = CGU.GXU_id
                      and CGU.CURS_id = C.CURS_id
                order by CURS_estado, CURS_nombre";
        $query = $this->db->query($sql);
        if ($query->num_rows > 0){
            return $query->result();
        }
        return null;
    }
    
    public function listar_alumnos_por_curso($idCurso) {
        $sql = "select *
                from curso_x_grado_x_usuario CGU, usuario U
                where CGU.USUA_id = U.USUA_id
                      and CGU.CURS_id = $idCurso
                order by USUA_apellidoPaterno, USUA_apellidoMaterno, USUA_nombres, USUA_login";
        $query = $this->db->query($sql);
        if ($query->num_rows > 0)
            return $query->result();
        return null;
    }

    public function insertar($objeto) {
        $this->db->insert(self::$tabla, $objeto);
        return $this->db->insert_id();
    }

    public function modificarCurso($objeto, $codigo) {
        $this->db->where('CURS_id', $codigo)->update(self::$tabla, $objeto);
    }

    public function eliminar_rol($codigo) {
        $this->permiso_model->eliminar_permiso($codigo);
        $this->db->where('ROL_codigo', $codigo);
        $this->db->delete(self::$tabla);
    }
    public function getCursoGrado($grado){
        $where = array("curso.GRAD_id"=>$grado,"grado.GRAD_flagActivo"=>"A");
        $this->db->where($where);
        $this->db->join('grado', 'grado.GRAD_id = ' . self::$tabla . '.GRAD_id');
        $this->db->order_by('CURS_nombre');
        $query = $this->db->get(self::$tabla);
        if ($query->num_rows > 0)
            return $query->result();
        return null;
    }
    public function getProfesoresByCurso($curso){
        $sql = "select 
                    *
                from 
                    usuario 
                where  
                    usuario.USUA_id not in (
                        select asignado.USUA_id from asignado where asignado.CURS_id = {$curso}
                    ) 
                    and  usuario.ROL_id in (2)";
        $query = $this->db->query($sql);
        if ($query->num_rows > 0)
            return $query->result();
        return null;
    }
    
    public function insertarAsignadoMasivo($data){
        $this->db->insert_batch(self::$tablaAsignado, $data); 
    }
    
    public function cursoByProfesor($profesor){
        $this->db->where('usuario.USUA_id', $profesor);
        $this->db->where('usuario.USUA_flagActivo', 'A');
        $this->db->where('asignado.ASIG_flagActivo', 'A');
        $this->db->where('grado.GRAD_flagActivo', 'A');
        $this->db->where('nivel.NIVE_flagActivo', 'A');
        $this->db->where('curso.CURS_flagActivo', 'A');
        $this->db->join('asignado','asignado.CURS_id=curso.CURS_id');
        $this->db->join('usuario','usuario.USUA_id=asignado.USUA_id');
        $this->db->join('grado','grado.GRAD_id=curso.GRAD_id');
        $this->db->join('nivel','nivel.NIVE_id=grado.NIVE_id');
        $this->db->order_by('nivel.NIVE_id');
        $this->db->order_by('grado.GRAD_id');
        $this->db->order_by('curso.CURS_nombre');
        $query = $this->db->get(self::$tabla);
        if($query->num_rows > 0){
            return $query->result();
        }
        return null;
    }
    
    public function getIdByCode($code){
        $where = array();
        $where['CURS_abreviatura'] = $code;
        $query = $this->db->where($where)->select('CURS_id')->get(self::$tabla);
        if($query->num_rows > 0){
            $result = $query->result();
            return $result[0]->CURS_id;
        }
        return null;
    }
    
}

?>
