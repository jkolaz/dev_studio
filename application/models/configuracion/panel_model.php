<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of panel_model
 *
 * @author julio
 */
class Panel_model extends CI_Model{
    //put your code here
    private static $_table = "panel";
    public $_PAN_id = 0;
    public $_PAN_nombre = "";
    public $_PAN_url = "";
    public $_PAN_permanente = "0";
    public $_PAN_estado = "1";
    public $_PAN_fecha_reg = "";
    public $_PAN_fecha_mod = "";
    public $_PAN_image = "";

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->_PAN_fecha_reg = date('Y-m-d H:i:s');
        $this->_PAN_fecha_mod = date('Y-m-d H:i:s');
    }
    
    public function insert(){
        $insert = array();
        $insert['PAN_nombre']       = $this->_PAN_nombre;
        $insert['PAN_url']          = $this->_PAN_url;
        $insert['PAN_permanente']   = $this->_PAN_permanente;
        $insert['PAN_estado']       = $this->_PAN_estado;
        $insert['PAN_fecha_mod']    = $this->_PAN_fecha_mod;
        $insert['PAN_image']        = $this->_PAN_image;
        if($this->db->insert(self::$_table, $insert)){
            $this->_PAN_id = $this->db->insert_id();
        }
        return $this->_PAN_id;
    }
    
    public function getRowByCols($col = FALSE){
        if(is_array($col) && count($col) > 0){
            $where = array();
            while ($value = current($col)) {
                $where[key($col)] = $value;
                next($col);
            }
            $query = $this->db->where($where)
                        ->get(self::$_table);
            if($query->num_rows >0){
                return $query->result();
            }else{
                return 0;
            }
        }elseif(!$col){
            $query = $this->db->get(self::$_table);
            if($query->num_rows >0){
                return $query->result();
            }else{
                return 0;
            }
        }else{
            return 0;
        }
    }
}
