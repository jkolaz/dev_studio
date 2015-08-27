<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of bimestre
 *
 * @author VMC-D02
 */
class Bimestre_model extends CI_Model{
    //put your code here
    private static $_table = "bimestre";
    public $_BIME_id;
    public $_BIME_nombre;
    public $_BIME_abreviatura;
    public $_BIME_orden;
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    public function getBimestre(){
        $query = $this->db->get(self::$_table);
        if($query->num_rows >0){
            return $query->result();
        }
        return 1;
    }
    
    public function getBimestreById($id){
        $this->db->where('BIME_id', $id);
        $query = $this->db->get(self::$_table);
        if($query->num_rows >0){
            return $query->result();
        }
        return null;
    }
}
