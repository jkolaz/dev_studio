<?php

class Permiso_Model extends CI_Model {

    private static $tabla = 'permiso';

    public function __construct() {
        parent :: __construct();
        $this->load->database();
    }

    public function busca_permiso($rol, $menu) {
        $where = array('ROL_codigo' => $rol, 'MENU_codigo' => $menu);
        $query = $this->db->where($where)->get(self::$tabla);
        if ($query->num_rows > 0)
            return $query->result();
        return null;
    }

    public function insertar_permiso($objeto) {
        $this->db->insert(self::$tabla, $objeto);
    }

    public function eliminar_permiso($codigo) {
        $this->db->where('ROL_codigo', $codigo);
        $this->db->delete(self::$tabla);
    }

    public function obtener_permiso($codigo) {
        $this->db->where('GTEM_codigo', $codigo);
        $query = $this->db->get(self::$tabla);
        if ($query->num_rows > 0)
            return $query->result();
        return null;
    }

    public function obtener_permisos_por_rol($idRol) {
        $this->db->from('menu');
        $this->db->join('permiso', 'permiso.MENU_id = menu.MENU_id');
        $this->db->where('permiso.ROL_id', $idRol);
        $this->db->where('menu.MENU_idPadre', 0);
        $this->db->order_by('menu.MENU_orden');
        $query = $this->db->get();
        if ($query->num_rows > 0) {
            $lista = $query->result();
            foreach ($lista as $row) {
                $this->db->from('menu');
                $this->db->join('permiso', 'permiso.MENU_id = menu.MENU_id');
                $this->db->where('permiso.ROL_id', $idRol);
                $this->db->where('menu.MENU_idPadre', $row->MENU_id);
                $this->db->order_by('menu.MENU_nombre');
                $query = $this->db->get();
                $row->sub_menus = $query->result();
            }
            return $lista;
        }
        return null;
    }

}

?>
