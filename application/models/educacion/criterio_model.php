<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of criterio_model
 *
 * @author julio
 */
class Criterio_model extends CI_Model{
    //put your code here
    private static $tabla = "criterio";
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    public function countCriterio($estado = ""){
        $query = $this->db->get(self::$tabla);
        return $query->num_rows;
    }
}
