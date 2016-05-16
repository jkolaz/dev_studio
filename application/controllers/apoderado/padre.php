<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of padre
 *
 * @author julio
 */
class padre extends CI_Controller{
    //put your code here
    
    public function __construct() {
        parent::__construct();
        $this->load->library('layout', 'layout');
    }
    
    public function hijo(){
        $this->layout->view(NULL);
    }
}
