<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of anioescolar_model
 *
 * @author VMC-D02
 */
class Anio_model extends CI_Model{
    //put your code here
    private static $_table = "anio";
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    public function generarAnio(){
        $arreglo = array();
        $arreglo['ACTIVO'] = 0;
        $arreglo['NUEVO'] = 0;
        $this->db->where('ANI_estado', '1');
        $this->db->select('ANI_id, ANI_desc');
        $query = $this->db->get(self::$_table, 1);
        if ($query->num_rows > 0){
            $devuelto = $query->result();
            $arreglo['ACTIVO'] = $devuelto[0]->ANI_id;
            $anio_new = intval($devuelto[0]->ANI_desc)+1;
            $insert['ANI_desc'] = $anio_new;
            $arreglo['NUEVO'] = $this->nuevo($insert);
        }
        return $arreglo;
    }
    public function getAnio(){
        $this->db->order_by('ANI_desc', 'desc');
        $query = $this->db->get(self::$_table);
        if ($query->num_rows > 0)
            return $query->result();
        return null;
    }
    public function getAnioWidthCols($cols){
        if(is_array($cols)){
            $select = explode(' ,', $cols);
        }else{
            $select = $cols;
        }
        $this->db->order_by('ANI_desc', 'desc');
        $query = $this->db->limit(1)
                    ->where('ANI_estado','1')
                    ->select($select)
                    ->get(self::$_table);
        if ($query->num_rows > 0)
            return $query->result();
        return null;
    }
    public function nuevo($insert){
        $update['ANI_estado'] = '0';
        $this->db->where('ANI_estado', '1')->update(self::$_table, $update);
        $this->db->insert(self::$_table, $insert);
        return $this->db->insert_id();
    }
}
