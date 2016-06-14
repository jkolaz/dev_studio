<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of recordacademico
 *
 * @author VMC-D02
 */
class Record extends CI_Controller{
    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('educacion/grado_model', 'GRADO');
        $this->load->model('matricula/gradousuario_model', 'GXU');
    }
    
    
    public function listar($anio){
        $objGrado = $this->GRADO->getGradoByNivel(2);
        if($objGrado){
            foreach ($objGrado as $index=>$value){
                $objGrado[$index]->ALUMNOS = $this->GXU->getRegistroByAnioComplete($anio, $value->GRAD_id, 'DS');
            }
            $data['GRADOS'] = $objGrado;
            $this->layout->view(NULL, $data);
        }else{
            redirect('configuracion/configuracion/getAnioEscolar');
        }
    }
}
