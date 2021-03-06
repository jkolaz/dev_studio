<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of matricula
 *
 * @author VMC-D02
 */
class Matricula extends CI_Controller{
    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->library('layout', 'layout');
        $this->load->helper(array('url', 'form', 'utilitarios'));
        $this->load->model('educacion/nivel_model', 'Nivel');
        $this->load->model('educacion/asignacion_model', 'ASIGNACION');
        $this->load->model('matricula/cursogrado_model', 'GradoUsuario');
        $this->load->model('configuracion/tipo_matricula_model', 'TIPO_MATRICULA');
        $this->siLogin();
    }
    public function newMatricula(){
        $data['tipo_matricula'] = $this->TIPO_MATRICULA->getTipoMatricula();
        $data['nivel'] = $this->Nivel->listar_niveles();
        $data['action'] = "matricula/matricula/insertMatricula";
        $data['titulo'] = 'REGISTRO DE  MATRICULA';
        $this->layout->view('matricula/newMatricula',$data);
    }
    public function insertMatricula(){
        $this->load->model('configuracion/anio_model', 'ANIO');
        $ANIO = $this->ANIO;
        $anio_actual = $ANIO->getAnioWidthCols('ANI_id');
        $post = $this->input->post();
        /* grado_x_usuario*/
        $OBGRADOUSUARIO = $this->GradoUsuario;
        $OBGRADOUSUARIO->_USUA_id = $post['alu_id'];
        $OBGRADOUSUARIO->_GRAD_id = $post['grado'];
        $OBGRADOUSUARIO->_GXUS_anhoReferencia = date('Y');
        $OBGRADOUSUARIO->_ANIO_id = $anio_actual[0]->ANI_id;
        $OBGRADOUSUARIO->_tm_id = $post['tipo_matricula'];
        if($OBGRADOUSUARIO->verificar() > 0){
            $idGU = $OBGRADOUSUARIO->insertar();
            if($idGU > 0){
                /* curso_x_grado_x_usuario*/
                $this->load->model('educacion/curso_model', 'CURSO');
                $CURSO = $this->CURSO;
                $listCurso = $CURSO->getCursoGrado($post['grado']);
                $this->load->model('matricula/cursogradousuario_model', 'CURSOGRADOUSUARIO');
                $CURSOGRADOUSUARIO = $this->CURSOGRADOUSUARIO;
                $this->load->model('nota/calificacion_model', 'CALIFICACION');
                $this->load->model('matricula/bimestre_model', 'BIMESTRE');
                $BIMESTRE = $this->BIMESTRE;
                $CALIFICACION = $this->CALIFICACION;
                foreach ($listCurso as $val){
                    $objAsignacion = $this->ASIGNACION->getAsignadoByCurso($val->CURS_id);
                    $CURSOGRADOUSUARIO->_ASIG_id = 0;
                    if($objAsignacion){
                        $CURSOGRADOUSUARIO->_ASIG_id = $objAsignacion[0]->ASIG_id;
                    }
                    $CURSOGRADOUSUARIO->_USUA_id = $post['alu_id'];
                    $CURSOGRADOUSUARIO->_GRAD_id = $post['grado'];
                    $CURSOGRADOUSUARIO->_CURS_id = $val->CURS_id;
                    $CURSOGRADOUSUARIO->_GXU_id = $idGU;
                    $CURSOGRADOUSUARIO->insertar();
                    /*calificacion*/
                    foreach ($BIMESTRE->getBimestre() as $value){
                        $CALIFICACION->_USUA_id = $post['alu_id'];
                        $CALIFICACION->_GRAD_id = $post['grado'];
                        $CALIFICACION->_CURS_id = $val->CURS_id;
                        $CALIFICACION->_BIME_id = $value->BIME_id;
                        $CALIFICACION->_CALI_parcial1 = 0;
                        $CALIFICACION->_CALI_parcial2 = 0;
                        $CALIFICACION->_GXU_id = $idGU;
                        $CALIFICACION->insertar();
                    }
                }
                redirect('seguridad/usuario/estudiante/M');
            }else{
                redirect('seguridad/usuario/estudiante/M');
            }
        }else{
            //echo "no se puede registrar<br>---------------<br>";
            redirect('seguridad/usuario/estudiante/M');
        }
    }

    public function siLogin(){
        $idUsuario = $this->session->userdata('idUsuario');
        if(!isset($idUsuario) || $idUsuario == ""){
            $data['URL_back'] = $this->session->CI->uri->uri_string;
            $this->session->set_userdata($data);
            redirect('index/inicio');
        }
    }
}
