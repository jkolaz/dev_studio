<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of asignacion_model
 *
 * @author VMC-D02
 */
class Asignacion_model extends CI_Model{
    //put your code here
    private static $tabla = "asignado";
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    public function getAsignado($id){
        $this->db->where('ASIG_id', $id);
        $this->db->where('ASIG_flagActivo', 'A');
        $query = $this->db->get(self::$tabla);
        if($query->num_rows > 0){
            return $query->result();
        }
        return false;
    }
    
    public function updateCriterio($id, $criterio){
        $update['ASIG_criterio'] = $criterio;
        $this->db->where('ASIG_id', $id);
        $this->db->update(self::$tabla, $update);
    }
    
    public function eliminarAsignacion($curso, $profesor) {
        $this->db->where('CURS_id', $curso);
        $this->db->where('USUA_id', $profesor);
        $this->db->delete(self::$tabla);
    }
    
    public function insertarAsignacionMasivo($data) {
        $this->db->insert_batch(self::$tabla, $data);
    }
    public function getAsignadoByCurso($id){
        $this->db->where('CURS_id', $id);
        $this->db->where('ASIG_flagActivo', 'A');
        $query = $this->db->get(self::$tabla, 1);
        if($query->num_rows > 0){
            return $query->result();
        }
        return false;
    }
}
