<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of calificaion_model
 *
 * @author VMC-D02
 */
class Calificacion_model extends CI_Model{
    //put your code here
    private static $_table = "calificacion";
    public $_CALI_id;
    public $_USUA_id;
    public $_GRAD_id;
    public $_CURS_id;
    public $_BIME_id;
    public $_CALI_parcial1;
    public $_CALI_parcial2;
    public $_GXU_id;

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    public function insertar(){
        $insertar = array();
        $insertar['USUA_id'] = $this->_USUA_id;
        $insertar['GRAD_id'] = $this->_GRAD_id;
        $insertar['CURS_id'] = $this->_CURS_id;
        $insertar['BIME_id'] = $this->_BIME_id;
        $insertar['CALI_parcial1'] = $this->_CALI_parcial1;
        $insertar['CALI_parcial2'] = $this->_CALI_parcial2;
        $insertar['GXU_id'] = $this->_GXU_id;
        $query = $this->db->insert(self::$_table, $insertar);
        if($query){
            return $this->db->insert_id();
        }
        return 0;
    }
    
    public function getCursoByMatricula($id){
        $where = array();
        $where['GXU_id'] = $id;
        $where['CGU_stado'] = 1;
        
        $data = array();
        
        $query = $this->db->where($where)
                ->join('curso', 'curso.CURS_id=curso_x_grado_x_usuario.CURS_id')
                ->get('curso_x_grado_x_usuario');
        
        if($query->num_rows > 0){
            $data = $query->result();
            foreach ($data as $i=>$value){
                $data[$i]->NOTAS = $this->getNotaDetalleByCursoAndMatricula($id, $value->CURS_id);
            }
        }
        return $data;
    }
    
    public function getNotaDetalleByCursoAndMatricula($matricula, $curso){
        $where = array();
        $where['GXU_id'] = $matricula;
        $where['CURS_id'] = $curso;
        $where['CALI_estado'] = 1;
        $query = $this->db->where($where)
                ->get(self::$_table);
        
        $data = array();
        
        if($query->num_rows > 0){
            $data = $query->result();
        }
        
        return $data;
    }
    
    
}
