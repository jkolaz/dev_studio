<?php

class Nivel_Model extends CI_Model {

    private static $tabla = 'nivel';

    public function __construct() {
        parent :: __construct();
        $this->load->database();
        $this->load->model('layout/menu_model');
    }

    public function listar_niveles() {
        $this->db->where('NIVE_flagActivo', 'A');
        $query = $this->db->get(self::$tabla);
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
