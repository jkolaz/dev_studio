<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of tipo_matricula_model
 *
 * @author julio
 */
class Tipo_matricula_model extends CI_Model{
    //put your code here
    private static $table = "tipo_matricula";
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    public function getTipoMatricula(){
        $where = array();
        $where['tm_estado'] = 1;
        $query = $this->db->where($where)->get(self::$table);
        if($query->num_rows > 0){
            return $query->result();
        }else{
            return FALSE;
        }
    }
}
