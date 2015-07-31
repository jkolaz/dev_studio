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
        $this->load->helper(array('url', 'form', 'menu'));
        self::$__session = $this->session->userdata;
    }
}
