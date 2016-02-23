<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of calificacion
 *
 * @author julio
 */
class Calificacion_model extends CI_Model{
    //put your code here
    private static $tabla = "calificacion";
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    public function update($id, $nota){
        $where = array();
        $where['CALI_id'] = $id;
        $update = array();
        $update['CALI_parcial1'] = $nota;
        $this->db->where($where)->update(self::$tabla, $update);
    }
    
    public function getCalifiacion($idUsuario, $idGrado, $idCurso, $idBimestre){
        $where = array();
        $where['USUA_id'] = $idUsuario;
        $where['GRAD_id'] = $idGrado;
        $where['CURS_id'] = $idCurso;
        $where['BIME_id'] = $idBimestre;
        $where['CALI_estado'] = 1;
        
        $query = $this->db->where($where)->get(self::$tabla);
        if($query->num_rows > 0){
            return $query->result();
        }else{
            return NULL;
        }
    }
    
    public function getCalificacionByID($id){
        $where = array();
        $where['CALI_id'] = $id;
        $where['CALI_estado'] = 1;
        $query = $this->db->where($where)->get(self::$tabla);
        if($query->num_rows > 0){
            return $query->result();
        }else{
            return NULL;
        }
    }
}
