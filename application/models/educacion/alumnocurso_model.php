<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of alumnocurso_model
 *
 * @author julio
 */
class Alumnocurso_model extends CI_Model{
    //put your code here
    private static $_table = "curso_x_grado_x_usuario";
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    public function getAlumnoByCurso($id){
        $where = array();
        $where['a.CURS_id'] = $id;
        $where['b.USUA_flagActivo'] = "A";
        $query = $this->db->where($where)->join('usuario b', 'b.USUA_id=a.USUA_id')
                ->order_by('b.USUA_apellidoPaterno')
                ->get(self::$_table." a");
        if ($query->num_rows > 0)
            return $query->result();
        return null;
    }
    
}
