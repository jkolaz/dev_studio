<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of horario
 *
 * @author julio
 */
class Horario_model extends CI_Controller{
    //put your code here
    
    private static $_table = 'horario';
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    public function insertar($insert){
        $this->db->insert(self::$_table, $insert);
    }
    
    public function eliminar($idGrado){
        $where = array();
        $where['GRAD_id'] = $idGrado;
        
        $this->db->where($where)->delete(self::$_table);
    }
    
}
