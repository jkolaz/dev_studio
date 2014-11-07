<?php
class User_model extends CI_Model{
	private static $tabla = 'usuario';

    public function __construct() {
        parent :: __construct();
        $this->load->database();
    }
    public function getUser($rol=0){
        if($rol>0){
            $where = array("usuario.ROL_id"=>$rol);
            $this->db->where($where);
        }
        $this->db->join('rol', 'rol.ROL_id = ' . self::$tabla . '.ROL_id');
        $query = $this->db->order_by("USUA_apellidoPaterno asc")->get(self::$tabla);
        if($query->num_rows>0){
                return $query->result();
        }else{
                return null;
        }
    }
    public function insertar(stdClass $insertar){
        $insert = array("USUA_nombres"=>$insertar->nombre,
                        "USUA_apellidoPaterno"=>$insertar->paterno,
                        "USUA_apellidoMaterno"=>$insertar->materno,
                        "USUA_login"=>$insertar->nick,
                        "USUA_clave"=>md5($insertar->clave),
                        "USUA_dni"=>$insertar->dni,
                        "USUA_email"=>$insertar->email,
                        "USUA_sexo"=>$insertar->sexo,
                        "ROL_id"=>$insertar->rol);
        $query = $this->db->insert(self::$tabla, $insert);
        if($query){
            $id = $this->db->insert_id();
        }else{
            $id = 0;
        }
        return $id;
    }
}
?>