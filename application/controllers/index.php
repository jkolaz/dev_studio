<?php

require_once 'application/libraries/pChart2/class/pData.class.php';
require_once 'application/libraries/pChart2/class/pDraw.class.php';
require_once 'application/libraries/pChart2/class/pImage.class.php';
require_once 'application/libraries/pChart2/class/pPie.class.php';

class Index extends CI_Controller {

    public function __construct() {
        parent :: __construct();
        $this->load->helper(array('url', 'form', 'utilitarios'));
        $this->load->library('form_validation');
        $this->load->library('layout', 'layout');
        $this->load->model('seguridad/usuario_model');
        $this->load->model('seguridad/permiso_model');
        $this->load->model('seguridad/rol_model');
    }

    // primera accion de la aplicacion "por defecto"
    public function inicio() {
        if (!$this->session->userdata('login')) {
            // si no existe sesion pedimos que se autentique
            $txtLogin = form_input(array('name' => 'txtUsuario',
                'id' => 'txtUsuario',
                'value' => '',
                'maxlength' => '20',
                'class' => 'cajaMedia cajaCenter'));
            $txtClave = form_password(array('name' => 'txtClave',
                'id' => 'txtClave',
                'value' => '',
                'type' => 'password',
                'maxlength' => '15',
                'class' => 'cajaMedia cajaCenter'));
            $lblEmpresa = form_label('Montessori Innova', 'empresa');
            // formamos el arreglo a enviar a la vista
            $data['campos'] = array($lblEmpresa);
            $data['valores'] = array($txtLogin, $txtClave);
            $data['onload'] = "onload=\"$('#txtUsuario').focus();\"";
            // llamamos a la vista
            $url_back = $this->session->userdata('URL_back');
            if(!isset($url_back) || $url_back== ""){
                $this->load->view('inicio', $data);
            }else{
                $this->session->unset_userdata('URL_back');
                redirect($url_back);
            }
        } else {
            // si ya existe la sesion, redirigimos a la pagina principal
            redirect('index/principal');
        }
    }

    // responde a la autenticacion del usuario
    public function ingresar_sistema() {
        $this->form_validation->set_rules('txtUsuario', 'Nombre Usuario', 'required|max_length[20]');
        $this->form_validation->set_rules('txtClave', 'Clave de Usuario', 'required|max_length[15]|md5');
        if ($this->form_validation->run() === FALSE) {
            $this->inicio();
        } else {
            $txtUsuario = $this->input->post('txtUsuario', TRUE);
            $txtClave = $this->input->post('txtClave', TRUE);
            // verificamos si existe el usuario y clave ingresados
            $objAutenticacion = $this->usuario_model->autenticar_usuario($txtUsuario, $txtClave);
            if ($objAutenticacion) {
                // si es una autenticacion satisfactoria, guardamos una sesion con los dato del usuario
                $login = $objAutenticacion[0]->USUA_login;
                $objUsuario = $this->usuario_model->obtener_usuario_por_login($login);
                $nombreUsuario = $objUsuario[0]->USUA_nombres . ' ' . $objUsuario[0]->USUA_apellidoPaterno . ' ' . $objUsuario[0]->USUA_apellidoMaterno;
                $data = array(
                    'idUsuario' => $objUsuario[0]->USUA_id,
                    'login' => $login,
                    'nombreUsuario' => utf8_encode($nombreUsuario),
                    'idRol' => $objUsuario[0]->USUA_id,
                    'nombreRol' => utf8_encode($objUsuario[0]->ROL_nombre)
                );
                // escribimos la sesion
                $this->session->set_userdata($data);
                // redirigimos a la pantalla de inicio
                redirect('index/principal');
            } else {
                // si el usuario y clave ingresados no son correctos
//                $mensajeError = "<br><div align='center' class='error'>Usuario y/o clave incorrectas.</div>";
//                echo $mensajeError;
                redirect('index/inicio');
            }
        }
    }

    public function principal() {
        $this->load->library('layout', 'layout');

        if (!$this->session->userdata('login')) {
            redirect('index/inicio');
        }

        $data['itemsProcesados'] = 1;

        $this->layout->view('principal', $data);
    }

    public function salir_sistema() {
        $this->session->unset_userdata('idUsuario');
        $this->session->unset_userdata('login');
        $this->session->unset_userdata('nombreUsuario');
        $this->session->unset_userdata('idRol');
        $this->session->unset_userdata('nombreRol');
        $this->session->unset_userdata('URL_back');
        $this->inicio();
    }

}

?>
