<?php

class Menu_Model extends CI_Model {

    private static $tabla = 'menu';

    public function __construct() {
        parent :: __construct();
        $this->load->database();
    }

    public function listar_menues() {
        // buscamos los menues padres
        $this->db->where('MENU_codigoPadre', 0);
        $query = $this->db->get(self::$tabla);
        if ($query->num_rows > 0) {
            $lista = $query->result();
            foreach ($lista as $row) {
                $this->db->where('MENU_idPadre', $row->MENU_codigo);
                $this->db->where('MENU_estado', 'A');
                $this->db->order_by('MENU_descripcion');
                $query = $this->db->get(self::$tabla);
                $row->sub_menus = $query->result();
            }
            return $lista;
        }
        return null;
    }

    public function obtener_menu() {
        $where = array('MENU_estado' => '1', 'MENU_idPadre' => 0);
        $query = $this->db->where($where)->get('menu');
        if ($query->num_rows > 0) {
            $menu = $query->result();
            $lista = array();
            foreach ($menu as $valor) {
                $codigoPadre = $valor->MENU_id;
                $subMenu = $this->obtener_menu_hijo($codigoPadre);
                $valor->subMenu = $subMenu;
                $lista[] = $valor;
            }
            return $menu;
        }
        return null;
    }

    public function obtener_menu_hijo($codigoPadre) {
        $this->db->where('MENU_idPadre', $codigoPadre);
        $query = $this->db->get('menu');
        if ($query->num_rows > 0)
            return $query->result();
        return null;
    }

}

?>