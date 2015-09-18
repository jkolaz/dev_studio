<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of gradousuario_model
 *
 * @author VMC-D02
 */
class Gradousuario_model extends CI_Controller{
    //put your code here
    private static $tabla = "grado_x_usuario";
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    public function getGradoByUsuario($id){
        $where = array();
        $where['USUA_id'] = $id;
        $where['GXUS_estado'] = "AC";
        $query = $this->db->where($where)->get(self::$tabla, 1);
        if($query->num_rows > 0){
            return $query->result();
        }
        return NULL;
    }
}
