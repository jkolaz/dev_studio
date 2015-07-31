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
        $query = $this->db->insert(self::$_table, $insertar);
        if($query){
            return $this->db->insert_id();
        }
        return 0;
    }
}
