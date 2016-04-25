<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of menu_model
 *
 * @author VMC-D02
 */
class menu_model extends CI_Model{
    //put your code here
    private static $_table = 'menu';
    private static $_PK_col = 'MENU_id';
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    public function getMenu($padre = 0, $all = FALSE, $order= '', $id = 0){
        $where = array();
        if($id > 0){
            $where['MENU_id'] = $id;
        }
        if($all){
            $where['MENU_is_public'] = $all;
        }
        
        if($order==''){
            $order = self::$_PK_col;
        }
        if($id == 0){
            $where['MENU_idPadre'] = $padre;
        }
        $query = $this->db->where($where)
                ->order_by($order)
                ->get(self::$_table);
        if($query->num_rows > 0){
            return $query->result();
        }
        return FALSE;
    }
    
    public function update($post){
        $update = array();
        $update['MENU_nombre'] = $post['txt_MENU_nombre'];
        $update['MENU_carpeta'] = $post['txt_MENU_carpeta'];
        $update['MENU_controlador'] = $post['txt_MENU_controlador'];
        $update['MENU_funcion'] = $post['txt_MENU_funcion'];
        $update['MENU_parametro'] = $post['txt_MENU_parametro'];
        $update['MENU_is_public'] = $post['txt_MENU_is_public'];
        $update['MENU_is_view'] = $post['txt_MENU_is_view'];
        $update['MENU_ruta'] = $post['txt_MENU_carpeta'].'/'.$post['txt_MENU_controlador'].'/'.$post['txt_MENU_funcion'];
        if($post['txt_MENU_parametro'] == '*'){
            $update['MENU_ruta'] .= '/'.$post['txt_MENU_parametro'];
        }else{
            $update['MENU_ruta'] .= $post['txt_MENU_parametro'];
        }
        
        $this->db->where(self::$_PK_col, $post['txt_MENU_id'])->update(self::$_table, $update);
    }
    public function insert($post){
        $update = array();
        $update['MENU_nombre'] = $post['txt_MENU_nombre'];
        $update['MENU_idPadre'] = $post['txt_MENU_idPadre'];
        if($post['txt_MENU_carpeta'] != ''){
            $update['MENU_carpeta'] = $post['txt_MENU_carpeta'];
        }
        if($post['txt_MENU_controlador'] != ''){
            $update['MENU_controlador'] = $post['txt_MENU_controlador'];
        }
        if($post['txt_MENU_funcion'] != ''){
            $update['MENU_funcion'] = $post['txt_MENU_funcion'];
        }
        $update['MENU_is_public'] = $post['txt_MENU_is_public'];
        $update['MENU_is_view'] = $post['txt_MENU_is_view'];
        
        if($post['txt_MENU_parametro'] == '*'){
            $update['MENU_ruta'] = $post['txt_MENU_parametro'];
        }else{
            $parametro = '';
            if($post['txt_MENU_parametro'] != ''){
                $parametro = implode('/', $post['txt_MENU_parametro']);
            }
            $aRuta = array();
            $aRuta[] = $update['MENU_carpeta'];
            $aRuta[] = $update['MENU_controlador'];
            $aRuta[] = $update['MENU_funcion'];
            if($parametro != ''){
                $aRuta[] = $parametro;
                $update['MENU_parametro'] = '/'.$parametro;
            }
            $update['MENU_ruta'] = implode('/', $aRuta);
        }
        
        $update['MENU_ruta'] = '';
        
        $this->db->insert(self::$_table, $update);
    }
}
