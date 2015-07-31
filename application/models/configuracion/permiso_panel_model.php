<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of permiso_panel_model
 *
 * @author VMC-D02
 */
class permiso_panel_model extends CI_Model{
    //put your code here
    private static $_table = "permiso_panel";
    public $_PP_id = 0;
    public $_ROL_id;
    public $_PAN_id;
    public $_PP_estado;
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    public function insertar(){
        $insert = array();
        $insert['ROL_id'] = $this->_ROL_id;
        $insert['PAN_id'] = $this->_PAN_id;
        if($this->db->insert(self::$_table, $insert)){
            $this->_PP_id = $this->db->insert_id();
        }
        return $this->_PP_id;
    }
    public function delete(){
        $where = array();
        $where['ROL_id'] = $this->_ROL_id;
        $where['PAN_id'] = $this->_PAN_id;
        if($this->db->delete(self::$_table, $where)){
            return 1;
        }
        return 0;
    }
    public function getRowByCols(){
        $where = array();
        if($this->_PP_id != 0){
            $where['PP_id'] = $this->_PP_id;
        }
        if($this->_ROL_id != 0 || $this->_ROL_id != ""){
            $where['ROL_id'] = $this->_ROL_id;
        }
        if($this->_PAN_id != 0 || $this->_PAN_id != ""){
            $where['PAN_id'] = $this->_PAN_id;
        }
        if($this->_PP_estado != ""){
            $where['PP_estado'] = $this->_PP_estado;
        }
        $query = $this->db->where($where)
                    ->get(self::$_table);
        if($query->num_rows >0){
            return $query->result();
        }else{
            return 0;
        }
    }
}
