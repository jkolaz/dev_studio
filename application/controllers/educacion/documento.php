<?php

class Documento extends CI_Controller {

    public function __construct() {
        parent :: __construct();
        $this->load->helper(array('url', 'form', 'utilitarios'));
        $this->load->library('form_validation', 'pagination', 'html');
        $this->load->model('educacion/documento_model');
        $this->load->model('layout/menu_model');
        $this->load->library('layout', 'layout');
    }

    public function index() {
        $this->listar();
    }

    public function listar() {
        $data['titulo'] = 'CURSOS';
        $this->layout->view('educacion/documento_index', $data);
    }
    
    public function ver($idUsuario, $idGrado) {
        $listaDocumentos = $this->documento_model->listar_documentos('A');
        $listaDocumentosEntregados = $this->documento_model->listar_documentos_entregados($idUsuario, $idGrado);
        $data['titulo'] = 'DOCUMENTOS';
        $data['listaDocumentos'] = $listaDocumentos;
        $data['ENTREGADOS'] = pasar_lista_a_arreglo($listaDocumentosEntregados, 'DOCU_id', 'DXGU_fechaEntrega');
        $this->load->view('educacion/documentos_ver_popup', $data);
    }
    
    public function profesor_documento($idProfesor) {
        $data['titulo'] = 'DOCUMENTOS';
        $listaDocumentos = $this->documento_model->listar_documentos_profesor($idProfesor);
        $data['listaDocumentos'] = $listaDocumentos;
        $this->load->view('educacion/documentos_ver_profesor_popup', $data);
    }
    
}

?>
