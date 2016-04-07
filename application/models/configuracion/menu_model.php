<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of menu_model
 *
 * @author VMC-D02
 */
class menu_model extends CI_Model{
    //put your code here
    private static $_table = 'menu';
    private static $_PK_col = 'MENU_id';
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    public function getMenu($padre = 0, $all = FALSE, $order= ''){
        $where = array();
        
        if($all){
            $where['MENU_is_public'] = $all;
        }
        
        if($order==''){
            $order = self::$_PK_col;
        }
        $where['MENU_idPadre'] = $padre;
        $query = $this->db->where($where)
                ->order_by($order)
                ->get(self::$_table);
        if($query->num_rows > 0){
            return $query->result();
        }
        return FALSE;
    }
}
