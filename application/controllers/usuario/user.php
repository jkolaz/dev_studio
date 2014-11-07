<?php

class User extends CI_Controller{

    public function __construct(){

        parent::__construct();

        $this->load->helper(array('url', 'form', 'utilitarios'));

        $this->load->library('layout', 'layout');

        $this->load->model('usuario/user_model');

    }

    public function index(){

        echo "hola";

    }

    public function listar(){

        $data['lista'] = $this->user_model->getUser(5);

        $data['titulo'] = "Lista de usuaios";

        $this->layout->view("usuario/user_listar", $data);

    }

    public function add($rol){

        $request = $this->input->post();

        if(is_array($request)){

            if(isset($request['nombre']) && $request['nombre']!=""){

                if(isset($request['paterno']) && $request['paterno']!=""){

                    if(isset($request['materno']) && $request['materno']!=""){

                        if(isset($request['dni']) && $request['dni']!=""){

                            if(isset($request['nick']) && $request['nick']!=""){

                                if(isset($request['pass']) && $request['pass']!=""){

                                    if(isset($request['email'])){

                                        $insert = new stdClass();

                                        $insert->nombre = $request['nombre'];

                                        $insert->paterno = $request['paterno'];

                                        $insert->materno = $request['materno'];

                                        $insert->dni = $request['dni'];

                                        $insert->nick = $request['nick'];

                                        $insert->sexo = $request['sexo'];

                                        $insert->clave = $request['pass'];

                                        $insert->email = $request['email'];

                                        $insert->rol = $rol;

                                        if($this->user_model->insertar($insert)>0){

                                            redirect('usuario/user/listar');

                                        }else{

                                            /*problema al insertar*/

                                            redirect('usuario/user/add/'.$rol);

                                        }

                                    }else{

                                        /*falta email*/

                                        redirect('usuario/user/add/'.$rol);

                                    }

                                }else{

                                    /*falta clave*/

                                    redirect('usuario/user/add/'.$rol);

                                }

                            }else{

                                /*falta nick*/

                                redirect('usuario/user/add/'.$rol);

                            }

                        }else{

                            /*falta D.N.I.*/

                            redirect('usuario/user/add/'.$rol);

                        }

                    }else{

                        /*falta apellido materno*/

                        redirect('usuario/user/add/'.$rol);

                    }

                }else{

                    /*falta apellido paterno*/

                    redirect('usuario/user/add/'.$rol);

                }

            }else{

                /*falta nombre*/

                redirect('usuario/user/add/'.$rol);

            }

        }else{

            $data['titulo'] = "Nuevo Usuario";

            $this->layout->view("usuario/user_add",$data);

        }

    }

}

?>