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
    
    public function getHorarioByGrado($id){
        $where = array();
        $where['horario.HOR_estado'] = 1;
        $where['horario.GRAD_id'] = $id;
        
        $query = $this->db->where($where)
                ->join('curso', 'curso.CURS_id='.self::$_table.'.CURS_id')
                ->order_by('horario.HOR_inicio')
                ->get(self::$_table);
        
        if($query->num_rows > 0){
            return $query->result();
        }
        return NULL;
    }
    
    public function getHorarioByCurso($id){
        $where = array();
        $where['horario.HOR_estado'] = 1;
        $where['horario.CURS_id'] = $id;
        
        $query = $this->db->where($where)
                ->join('curso', 'curso.CURS_id='.self::$_table.'.CURS_id')
                ->order_by('horario.HOR_inicio')
                ->get(self::$_table);
        
        if($query->num_rows > 0){
            return $query->result();
        }
        return NULL;
    }
    
}
