<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of menu
 *
 * @author VMC-D02
 */
class Menu extends CI_Controller{
    //put your code here
    private static $__session;
    public function __construct() {
        parent::__construct();
        $this->load->library('layout', 'layout');
        $this->load->helper(array('url', 'form'));
        $this->load->model('configuracion/menu_model', 'MENU');
        self::$__session = $this->session->userdata;
    }
    
    public function index(){
        $objMenu = $this->MENU->getMenu(0, FALSE, 'MENU_nombre');
        foreach ($objMenu as $i=>$value){
            $objSubMenu = $this->MENU->getMenu($value->MENU_id, FALSE, 'MENU_nombre');
            $objMenu[$i]->SUB_MENU = $objSubMenu;
        }
        $data['lista'] = $objMenu;
        $this->layout->view(NULL, $data);
    }
}
