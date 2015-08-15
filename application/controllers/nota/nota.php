<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of nota
 *
 * @author julio
 */
class Nota extends CI_Controller{
    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->helper(array('url', 'form', 'utilitarios'));
        $this->load->library('form_validation', 'pagination', 'html');
        $this->load->library('layout', 'layout');
    }
}
