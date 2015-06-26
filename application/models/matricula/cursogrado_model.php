<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of cursogrado_model
 *
 * @author julio
 */
class Cursogrado_model extends CI_Model{
    //put your code here
    private static $_table = 'grado_x_usuario';
    public $_USUA_id;
    public $_GRAD_id;
    public $_GXUS_estado = "AC";
    public $_GXUS_anhoReferencia;
    public $_GXUS_aula = "UNICO";
    public $_ANIO_id;
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    public function insertar(){
        $insert = array();
        $insert['USUA_id'] = $this->_USUA_id;
        $insert['GRAD_id'] = $this->_GRAD_id;
        $insert['GXUS_estado'] = $this->_GXUS_estado;
        $insert['GXUS_aula'] = $this->_GXUS_aula;
        $insert['ANIO_id'] = $this->_ANIO_id;
        $insert['GXUS_anhoReferencia'] = $this->_GXUS_anhoReferencia;
        if($this->db->insert(self::$_table, $insert)){
            return 1;
        }
        return 0;
    }
    public function verificar(){
        $where = array();
        $where['USUA_id'] = $this->_USUA_id;
        $where['GRAD_id'] = $this->_GRAD_id;
        $where['ANIO_id'] = $this->_ANIO_id;
        $where['GXUS_estado'] =  $this->_GXUS_estado;
        $query = $this->db->where($where)->get(self::$_table);
        if($query->num_rows >0){
            return 0;
        }
        return 1;
    }
}
