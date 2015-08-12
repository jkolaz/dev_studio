<?php

class Curso_model extends CI_Model {

    private static $tabla = 'curso';

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
    
    public function listar_detalle_notas($idUsuario, $idGrado, $idCurso, $idBimestre) {
        $sql = "select *
                from calificacion_detalle
                where USUA_id = $idUsuario
                      and GRAD_id = $idGrado
                      and CURS_id = $idCurso
                      and BIME_id = $idBimestre
                order by CALD_parcial, CRIT_id";
        $query = $this->db->query($sql);
        if ($query->num_rows > 0)
            return $query->result();
        return null;
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
                      and GU.GXUS_estado = 'VI'
                      and GU.USUA_id = CGU.USUA_id and GU.GRAD_id = CGU.GRAD_id
                      and CGU.CURS_id = C.CURS_id
                order by CURS_estado, CURS_nombre";
        $query = $this->db->query($sql);
        if ($query->num_rows > 0)
            return $query->result();
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

}

?>
