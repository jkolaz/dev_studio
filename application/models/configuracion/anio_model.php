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
}
