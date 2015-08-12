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
    
    public function eliminarAsignacion($curso, $profesor) {
        $this->db->where('CURS_id', $curso);
        $this->db->where('USUA_id', $profesor);
        $this->db->delete(self::$tabla);
    }
    
    public function insertarAsignacionMasivo($data) {
        $this->db->insert_batch(self::$tabla, $data);
    }
}
