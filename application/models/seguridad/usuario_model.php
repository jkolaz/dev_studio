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

    public function listar_usuarios_alumnos($tipo = "") {
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
    public function getEstudiantes(){
        $where = array();
        $where['ROL_id'] = "1";
        $query = $this->db->where($where)
                    ->get(self::$tabla);
        if ($query->num_rows > 0)
            return $query->result();
        return null;
    }
    
    public function listar_usuarios_alumnos_matriculados() {
        /*
         * GXUS_estado :
         * VI: Matricula actualizada
         * NC: No actualizo matricula
         */
        $sql = "select *
                from usuario U, grado_x_usuario GR, rol R, grado G, nivel N
                where U.ROL_id = R.ROL_id
                      and GR.USUA_id=.U.USUA_id
                      and GR.GRAD_id = G.GRAD_id
                      and G.NIVE_id = N.NIVE_id
                      and USUA_flagActivo = 'A'
                      and U.ROL_id = 1
                      and G.GRAD_id != 100
                      and GR.GXUS_estado = 'VI'
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
        $insertar = array(
                        "USUA_nombres"=>$insert->nombre,
                        "USUA_apellidoPaterno"=>$insert->paterno,
                        "USUA_apellidoMaterno"=>$insert->materno,
                        "USUA_login"=>$insert->dni,
                        "USUA_clave"=>  md5($insert->dni),
                        "USUA_dni"=>$insert->dni,
                        "USUA_flagActivo"=>"A",
                        "USUA_estado"=>"AC");
        $newCodigo = '';
        if(isset($insert->tipo) && $insert->tipo!=""){
            $codigo = $this->getCodigo($insert->tipo);
            switch ($insert->tipo){
                case "ALU":
                    $codigo = (int)substr($codigo, 4);
                    if(date('Y') == substr($codigo, 0, 4)){
                        for($cont = 1; $cont <= 4; $cont){
                            if(strlen($newCodigo.($codigo+1))>4){
                                break;
                            }
                            $newCodigo .= "0";
                        }
                        $newCodigo = date('Y').$newCodigo.($codigo+1);
                    }else{
                        $newCodigo = date('Y').'0001';
                    }
                    break;
                case "PAD":
                case "MAD":
                    $codigo = (int)substr($codigo, 2);
                    for($cont = 1; $cont <= 3; $cont){
                        if(strlen($newCodigo.($codigo+1))>4){
                            break;
                        }
                        $newCodigo .= "0";
                    }
                    $newCodigo = 'PD'.$newCodigo.($codigo+1);
                    break;
            }
            
        }
        $insertar['USUA_codigo'] = $newCodigo;
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
    public function buscar_dni($dni,$tipo=""){
        $where = array();
        $where['USUA_dni'] = $dni;
        $where['USUA_flagActivo'] = "A";
        $where['USUA_estado']   = "AC";
        switch ($tipo){
            case "PAD":
                $where['USUA_sexo'] = "M";
                $where['PARI_tipo'] = $tipo;
                break;
            case "MAD":
                $where['USUA_sexo'] = "F";
                $where['PARI_tipo'] = $tipo;
                break;
        }
        $query = $this->db->where($where)
                    ->limit(1)
                    ->join('pariente', self::$tabla.'.USUA_id=pariente.USUA_idPadre')
                    ->get(self::$tabla);
        if ($query->num_rows > 0){
            return $query->result();
        }else{
            return null;
        }
    }
    function buscar_dni_alumno_padres($dni){
        $return = array();
        
        $select = array();
        $select[] = 'USUA_id';
        $select[] = 'USUA_codigo';
        $select[] = 'USUA_nombres';
        $select[] = 'USUA_apellidoPaterno';
        $select[] = 'USUA_apellidoMaterno';
        $select[] = 'USUA_sexo';
        $select[] = 'USUA_telefonos';
        
        $where = array();
        $where['USUA_flagActivo'] = "A";
        $where['USUA_estado']   = "AC";
        
        $sql = $this->db->where($where)
                    ->where('USUA_dni',$dni)
                    ->where('ROL_id','1')
                    ->select(implode(', ', $select))
                    ->limit(1)
                    ->get(self::$tabla);
        if($sql->num_rows > 0){
            $return = $sql->result();
            
            $idPadres = array();
            $sql_padres = $this->db->where('USUA_idHijo',$return[0]->USUA_id)
                                ->get('pariente');
            if($sql_padres->num_rows > 0){
                foreach ($sql_padres->result() as $key => $val) {
                    $idPadres[] = $val->USUA_idPadre;
                }
                
                $query = $this->db->where($where)
                    ->where_in('USUA_id',$idPadres)
                    ->select(implode(', ', $select))
                    ->get(self::$tabla);
                if ($query->num_rows > 0){
                    foreach ($query->result() as $value){
                        $stdPadre = new stdClass();
                        $stdPadre->USUA_id = $value->USUA_id;
                        $stdPadre->USUA_codigo = $value->USUA_codigo;
                        $stdPadre->USUA_nombres = $value->USUA_nombres;
                        $stdPadre->USUA_apellidoPaterno = $value->USUA_apellidoPaterno;
                        $stdPadre->USUA_apellidoMaterno = $value->USUA_apellidoMaterno;
                        $stdPadre->USUA_sexo = $value->USUA_sexo;
                        $stdPadre->USUA_telefonos = $value->USUA_telefonos;
                        $return[] =  $stdPadre;
                    }
                }
            }
        }
        return $return;
    }
    public function getCodigo($tipo){
        $codigo = "";
        $rol = 0;
        switch ($tipo){
            case "PAD":
            case "MAD":
                $rol = 3;
                break;
            case "PRO":
                break;
            case "ALU":
                $rol = 1;
                break;
            case "ADM":
                break;
        }
        $query = $this->db->where('ROL_id', $rol)
                        ->select_max('USUA_id')
                        ->get(self::$tabla);
        if ($query->num_rows > 0){
            foreach ($query->result() as $value){
                $codigo = $this->getCodigoById($value->USUA_id);
            }
        }
        return $codigo;
    }
    public function getCodigoById($id){
        $codigo = "";
        $query = $this->db->where('USUA_id', $id)
                        ->select('USUA_codigo')
                        ->get(self::$tabla);
        if ($query->num_rows > 0){
            foreach ($query->result() as $value){
                $codigo = $value->USUA_codigo;
            }
        }
        return $codigo;
    }
}

?>
