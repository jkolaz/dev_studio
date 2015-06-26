<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of cursogradousuario_model
 *
 * @author julio
 */
class Cursogradousuario_model extends CI_Model{
    //put your code here
    private static $_table = 'curso_x_grado_x_usuario';
    public $_USUA_id;
    public $_GRAD_id;
    public $_CURS_id;
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    public function insertar(){
        $insert = array();
        $insert['USUA_id'] = $this->_USUA_id;
        $insert['GRAD_id'] = $this->_GRAD_id;
        $insert['CURS_id'] = $this->_CURS_id;
        if($this->db->insert(self::$_table, $insert)){
            return 1;
        }
        return 0;
    }
}
