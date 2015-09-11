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
    
    public function getCriterio(){
        $query = $this->db->get(self::$tabla);
        if($query->num_rows >0){
            return $query->result();
        }
        return NULL;
    }
    
    public function getCriterioById($id){
        $query = $this->db->where('CRIT_id',$id)->get(self::$tabla);
        if($query->num_rows >0){
            return $query->result();
        }
        return NULL;
    }
    public function insertar($campos){
        $this->db->insert(self::$tabla,$campos);
    }
    public function update($id, $campos){
        $this->db->where("CRIT_id", $id)->update(self::$tabla,$campos);
    }
}
