<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of pariente_model
 *
 * @author Julio Alcides Salsavilca Huamanyauri
 * @email j.salsavilca@gmail.com
 */
class Pariente_model extends CI_Model{
    //put your code here
    private static $_table = "pariente";
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    public function insert($obj){
        $insert = array();
        $insert['USUA_idHijo']      = $obj->alumno;
        $insert['USUA_idPadre']     = $obj->padre;
        $insert['PARI_tipo']        = $obj->relacion;
        $insert['PARI_flagActivo']  = "ACT";
        $query = $this->db->insert(self::$_table, $insert);
        if($query){
            $id = $this->db->insert_id();
        }else{
            $id = 0;
        }
        return $id;
    }
}
