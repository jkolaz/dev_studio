<?php

class Usuario_Model extends CI_Model {

    private static $tabla = 'usuario';

    public function __construct() {
        parent :: __construct();
        $this->load->database();
    }

    // verifica si el nombre de usuario y clave ingresadas son correctas
    public function autenticar_usuario($login, $clave) {
        $where = array('USUA_login' => $login, 'USUA_clave' => $clave, 'USUA_flagActivo' => 'A', 'USUA_estado' => 'AC');
        $query = $this->db->where($where)->get(self::$tabla);
        if ($query->num_rows > 0)
            return $query->result();
        return null;
    }

    public function obtener_usuario_por_login($login) {
        $where = array('USUA_login' => $login, 'USUA_flagActivo' => 'A', 'USUA_estado' => 'AC');
        $this->db->join('rol', 'rol.ROL_id = ' . self::$tabla . '.ROL_id');
        $query = $this->db->where($where)->get(self::$tabla);
        if ($query->num_rows > 0)
            return $query->result();
        return null;
    }

    public function listar_usuarios() {
        $where = array('USUA_flagActivo' => 'A');
        $this->db->join('rol', 'rol.ROL_id = ' . self::$tabla . '.ROL_id');
        $this->db->order_by('USUA_apellidoPaterno');
        $query = $this->db->where($where)->get(self::$tabla);
        if ($query->num_rows > 0)
            return $query->result();
        return null;
    }

    public function listar_usuarios_por_tipo($tipo) {
        $where = array('USUA_flagActivo' => 'A', 'usuario.ROL_id' => $tipo);
        $this->db->join('rol', 'rol.ROL_id = ' . self::$tabla . '.ROL_id');
        $this->db->order_by('USUA_apellidoPaterno');
        $query = $this->db->where($where)->get(self::$tabla);
        if ($query->num_rows > 0)
            return $query->result();
        return null;
    }

    public function listar_usuarios_alumnos() {
//        $where = array('USUA_flagActivo' => 'A', 'usuario.ROL_id' => 1, 'grado.GRAD_id !=' => 100);
//        $this->db->join('rol', 'rol.ROL_id = ' . self::$tabla . '.ROL_id');
//        $this->db->join('grado', 'grado.GRAD_id = ' . self::$tabla . '.GRAD_id');
//        $this->db->join('nivel', 'nivel.NIVE_id = grado.NIVE_id');
//        $this->db->order_by('usuario.GRAD_id, USUA_apellidoPaterno');
//        $query = $this->db->where($where)->get(self::$tabla);
        $sql = "select *
                from usuario U, rol R, grado G, nivel N
                where U.ROL_id = R.ROL_id
                      and U.GRAD_id = G.GRAD_id
                      and G.NIVE_id = N.NIVE_id
                      and USUA_flagActivo = 'A'
                      and U.ROL_id = 1
                      and G.GRAD_id != 100
                order by U.GRAD_id, USUA_apellidoPaterno";
        $query = $this->db->query($sql);
        if ($query->num_rows > 0)
            return $query->result();
        return null;
    }

    public function listar_parientes_por_usuario_minimo($idUsuario, $tipo) {
        if ($tipo == 'P') {
            $campoComparar = 'USUA_idPadre';
            $campoLeer = 'USUA_idHijo';
        } else {
            $campoComparar = 'USUA_idHijo';
            $campoLeer = 'USUA_idPadre';
        }
        $sql = "select USUA_id, USUA_codigo, USUA_login, USUA_estado,
                       USUA_nombres, USUA_apellidoPaterno, USUA_apellidoMaterno,
                       G.GRAD_id, GRAD_abreviatura, G.NIVE_id, N.NIVE_abreviatura
                from pariente P, usuario U, grado G, nivel N
                where G.GRAD_id = U.GRAD_id
                      and G.NIVE_id = N.NIVE_id
                      and U.USUA_id = P.$campoLeer
                      and $campoComparar = $idUsuario";
        $query = $this->db->query($sql);
        if ($query->num_rows > 0)
            return $query->result();
        return null;
    }

    public function listar_parientes_por_usuario($idUsuario, $tipo) {
        if ($tipo == 'P') {
            $campoComparar = 'USUA_idPadre';
            $campoLeer = 'USUA_idHijo';
        } else {
            $campoComparar = 'USUA_idHijo';
            $campoLeer = 'USUA_idPadre';
        }
        $sql = "select *
                from pariente P, usuario U
                where U.USUA_id = P.$campoLeer
                      and $campoComparar = $idUsuario
                order by USUA_sexo desc";
        $query = $this->db->query($sql);
        if ($query->num_rows > 0)
            return $query->result();
        return null;
    }

    public function listar_hermanos_alumno($idAlumno) {
        $sql = "select *
                from usuario
                where U.USUA_id = P.$campoLeer
                      and $campoComparar = $idUsuario";
        $query = $this->db->query($sql);
        if ($query->num_rows > 0)
            return $query->result();
        return null;
    }

    public function listar_padres_por_usuario($idUsuario) {
        $sql = "select *
                from pariente P, usuario U
                where U.USUA_id = P.USUA_idPadre
                      and USUA_idHijo = $idUsuario";
        $query = $this->db->query($sql);
        if ($query->num_rows > 0)
            return $query->result();
        return null;
    }
    
    public function listar_cuotas_por_alumno($idUsuario) {
        $sql = "select *
                from pago P, cuota C
                where P.CUOT_id = C.CUOT_id
                      and USUA_id = $idUsuario";
        $query = $this->db->query($sql);
        if ($query->num_rows > 0)
            return $query->result();
        return null;
    }
    
    public function listar_comentarios_alumno($idAlumno, $idProfesor, $idCurso) {
        $sql = "select *
                from comentario
                where USUA_idDestino = $idAlumno
                      and USUA_idRegistro = $idProfesor
                      and CURS_id = $idCurso";
        $query = $this->db->query($sql);
        if ($query->num_rows > 0)
            return $query->result();
        return null;
    }
    
    public function contar_comentarios_alumno($idAlumno, $idProfesor, $idCurso) {
        $sql = "select COUNT(*) as total
                from comentario
                where USUA_idDestino = $idAlumno
                      and USUA_idRegistro = $idProfesor
                      and CURS_id = $idCurso";
        $query = $this->db->query($sql);
        if ($query->num_rows > 0)
            return $query->result();
        return null;
    }
    
    public function insertar_usuario($objeto) {
        $this->db->insert(self::$tabla, $objeto);
    }

    public function modificar_usuario($objeto, $idUsuario) {
        $this->db->where('USUA_id', $idUsuario);
        $this->db->update(self::$tabla, $objeto);
    }

    public function eliminar_usuario($idUsuario) {
        $this->db->where('USUA_id', $idUsuario);
        $this->db->delete(self::$tabla);
    }

    public function obtener_usuario_por_id($idUsuario) {
        $this->db->where('USUA_id', $idUsuario);
        $this->db->join('rol', 'rol.ROL_id = ' . self::$tabla . '.ROL_id');
        $this->db->join('grado', 'grado.GRAD_id = ' . self::$tabla . '.GRAD_id');
        $this->db->join('nivel', 'nivel.NIVE_id = grado.NIVE_id');
        $query = $this->db->get(self::$tabla);
        if ($query->num_rows > 0)
            return $query->result();
        return null;
    }
    public function insert($insert){
        $insertar = array("USUA_codigo" => $insert->dni,
                        "USUA_nombres"=>$insert->nombre,
                        "USUA_apellidoPaterno"=>$insert->paterno,
                        "USUA_apellidoMaterno"=>$insert->materno,
                        "USUA_login"=>$insert->dni,
                        "USUA_clave"=>  md5($insert->dni),
                        "USUA_dni"=>$insert->dni,
                        "USUA_flagActivo"=>"A",
                        "USUA_estado"=>"AC");
        if(isset($insert->email) && $insert->email!=""){
            $insertar['USUA_email'] = $insert->email;
        }
        if(isset($insert->sexo) && $insert->sexo!=""){
            $insertar['USUA_sexo'] = $insert->sexo;
        }
        if(isset($insert->grado) && $insert->grado!=""){
            $insertar['ROL_id'] = $insert->grado;
        }else{
            $insertar['ROL_id'] = 0;
        }
        $query = $this->db->insert(self::$tabla, $insertar);
        if($query){
            $id = $this->db->insert_id();
        }else{
            $id = 0;
        }
        return $id;
    }
    public function searchUsuarioDni($dni){
        $where = array('USUA_flagActivo' => 'A',
                        'USUA_dni'=>$dni);
        $query = $this->db->get(self::$tabla);
        if ($query->num_rows > 0)
            return $query->result();
        return null;
    }
}

?>
