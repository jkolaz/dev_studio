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
        $query = $this->db->where($where)
                ->join('grado', 'grado.GRAD_id='.self::$tabla.'.GRAD_id')
                ->join('nivel', 'nivel.NIVE_id=grado.NIVE_id')
                ->get(self::$tabla, 1);
        if($query->num_rows > 0){
            return $query->result();
        }
        return NULL;
    }
    
    public function getRegistroByAnio($anio){
        $where = array();
        $where['ANIO_id'] = $anio;
        $where['GXUS_estado'] = 'AC';
        $where['GXU_status'] = 1;
        $query = $this->db->where($where)->get(self::$tabla);
        if($query->num_rows > 0){
            return $query->result();
        }
        return NULL;
    }
    
    public function getRegistroByAnioComplete($anio, $grado=0, $estado = 'AC'){
        $where = array();
        $where['ANIO_id'] = $anio;
        $where['GXUS_estado'] = $estado;
        if($grado > 0){
            $where[self::$tabla.'.GRAD_id'] = $grado;
        }
        //$where['GXU_status'] = 1;
        $query = $this->db->where($where)
                ->join('usuario', 'usuario.USUA_id='.self::$tabla.'.USUA_id')
                ->get(self::$tabla);
        if($query->num_rows > 0){
            return $query->result();
        }
        return NULL;
    }
    
    public function cerrarNotas($id, $update){
        /*
         * AC: Activo
         * DS: Desactivo
         * AN: Anulado
         */
        $this->db->where('GXU_id', $id)->update(self::$tabla, $update);
    }
    
    public function getRow($id){
        $where = array();
        $where['USUA_id'] = $id;
        $where['GXUS_estado'] = "DS";
        $query = $this->db->where($where)
                ->join('grado', 'grado.GRAD_id='.self::$tabla.'.GRAD_id')
                ->join('nivel', 'nivel.NIVE_id=grado.NIVE_id')
                ->order_by('GXU_id', 'desc')
                ->get(self::$tabla, 1);
        if($query->num_rows > 0){
            return $query->result();
        }
        return NULL;
    }
}
