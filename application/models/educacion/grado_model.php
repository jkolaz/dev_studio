<?php

class Grado_model extends CI_Model {

    private static $tabla = 'grado';

    public function __construct() {
        parent :: __construct();
        $this->load->database();
        $this->load->model('layout/menu_model');
    }

    public function listar_grados() {
        $this->db->where('GRAD_flagActivo', 'A');
        $this->db->where('NIVE_flagActivo', 'A');
        $this->db->join('nivel', 'nivel.NIVE_id = ' . self::$tabla . '.NIVE_id');
        $this->db->order_by('nivel.NIVE_id, GRAD_numero');
        $query = $this->db->get(self::$tabla);
        if ($query->num_rows > 0)
            return $query->result();
        return null;
    }
    
    public function getNivelByGrado($id){
        $this->db->where('GRAD_id', $id);
        $this->db->where('GRAD_flagActivo', 'A');
        $this->db->where('NIVE_flagActivo', 'A');
        $this->db->join('nivel', 'nivel.NIVE_id = ' . self::$tabla . '.NIVE_id');
        $this->db->order_by('nivel.NIVE_id, GRAD_numero');
        $query = $this->db->get(self::$tabla);
        if ($query->num_rows > 0)
            return $query->result();
        return null;
    }
    
    public function listar_grados_por_nivel($idNivel) {
        $sql = "select *
                from grado G, nivel N
                where G.NIVE_id = N.NIVE_id
                      and G.NIVE_id = $idNivel
                order by GRAD_numero";
        $query = $this->db->query($sql);
        
//        $where = array('GRAD_flagActivo' => 'A', 'nivel.NIVE_id' => $idNivel);
//        $this->db->join('nivel', 'nivel.NIVE_id = ' . self::$tabla . '.NIVE_id');
//        $this->db->order_by('GRAD_numero');
//        $query = $this->db->where($where)->get(self::$tabla);
        if ($query->num_rows > 0)
            return $query->result();
        return null;
    }
    
    

    public function insertar_rol($objeto) {
        $this->db->insert(self::$tabla, $objeto);
        return $this->db->insert_id();
    }

    public function modificar_rol($objeto, $codigo) {
        $this->db->where('ROL_codigo', $codigo);
        $this->db->update(self::$tabla, $objeto);
    }

    public function eliminar_rol($codigo) {
        $this->permiso_model->eliminar_permiso($codigo);
        $this->db->where('ROL_codigo', $codigo);
        $this->db->delete(self::$tabla);
    }

    public function obtener_rol($codigo) {
        $this->db->where('ROL_id', $codigo);
        $query = $this->db->get(self::$tabla);
        if ($query->num_rows > 0)
            return $query->result();
        return null;
    }

}

?>
