<?php

class Permiso_Model extends CI_Model {

    private static $tabla = 'permiso';

    public function __construct() {
        parent :: __construct();
        $this->load->database();
    }

    public function busca_permiso($rol, $menu) {
        $where = array('ROL_id' => $rol, 'MENU_id' => $menu);
        $query = $this->db->where($where)->get(self::$tabla);
        if ($query->num_rows > 0)
            return $query->result();
        return null;
    }

    public function insertar_permiso($objeto) {
        $this->db->insert(self::$tabla, $objeto);
    }

    public function eliminar_permiso($codigo) {
        $this->db->where('ROL_id', $codigo);
        $this->db->delete(self::$tabla);
    }
    public function eliminar_permiso_unico($codigo,$menu) {
        $this->db->where('ROL_id', $codigo);
        $this->db->where('MENU_id', $menu);
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
    public function getPermiso($directory, $class, $method, $param){
        $rol  = $this->session->userdata('idRol');
        $where = array();
        $where['MENU_carpeta'] = $directory;
        $where['MENU_controlador'] = $class;
        $where['MENU_funcion'] = $method;
        $where['MENU_parametro'] = $param;
        $where['MENU_estado'] = 1;
        $where['ROL_id'] = $rol;
        $where['PERM_flagActivo1'] = 'A';
        $query = $this->db->where($where)
                ->join('menu', 'menu.MENU_id=permiso.MENU_id')
                ->get(self::$tabla, 1);
        echo $query->num_rows;
        return true;
    }

}

?>
