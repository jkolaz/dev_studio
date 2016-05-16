<?php

class Grado extends CI_Controller {

    public function __construct() {
        parent :: __construct();
        $this->load->helper(array('url', 'form', 'utilitarios'));
        $this->load->library('form_validation', 'pagination', 'html');
        $this->load->model('educacion/grado_model');
        $this->load->model('educacion/curso_model');
        $this->load->model('layout/menu_model');
        $this->load->library('layout', 'layout');
    }

    public function index() {
        $this->listar();
    }

    public function listar() {
        $data['titulo'] = 'GRADOS';
        $lista = $this->grado_model->listar_grados();
        $data['lista'] = $lista;
        $this->layout->view('educacion/grado_index', $data);
    }

    public function mostrar_nuevo() {
        $data['titulo'] = 'REGISTRAR ROL';
        $data['modo'] = 'N';
        $data['nombreRol'] = '';
        $data['codigo'] = '';
        $data['menu'] = $this->menu_model->obtener_menu();
        $this->load->view('3_lecturas/rol_nuevo', $data);
    }

    public function insertar() {
        $nombre = $this->input->post('nombreRol');
        $menuPadre = $this->input->post('nombre');
        $menuHijo = $this->input->post('checkO');
        
        $objetoRol = new stdClass();
        $objetoRol->ROL_descripcion = strtoupper($nombre);
        $rol = $this->rol_model->insertar_rol($objetoRol);

        if (is_array($menuPadre)) {
            foreach ($menuPadre as $valorPadre) {
                if ($valorPadre != '') {
                    $objetoPermisoPadre = new stdClass();
                    $objetoPermisoPadre->ROL_codigo = $rol;
                    $objetoPermisoPadre->MENU_codigo = $valorPadre;
                    $this->permiso_model->insertar_permiso($objetoPermisoPadre);
                }
            }
        }
        
        if (is_array($menuHijo)) {
            foreach ($menuHijo as $valorHijo) {
                if ($valorHijo != '') {
                    $objetoPermisoHijo = new stdClass();
                    $objetoPermisoHijo->ROL_codigo = $rol;
                    $objetoPermisoHijo->MENU_codigo = $valorHijo;
                    $this->permiso_model->insertar_permiso($objetoPermisoHijo);
                }
            }
        }
    }

    public function mostrar_editar($codigoRol) {
        $datosRol = $this->rol_model->obtener_rol($codigoRol);
        $data['titulo'] = 'EDITAR ROL';
        $data['modo'] = 'E';
        $data['nombreRol'] = $datosRol[0]->ROL_descripcion;
        $data['codigo'] = $datosRol[0]->ROL_codigo;
        $data['menu'] = $this->menu_model->obtener_menu();
        $this->load->view('3_lecturas/rol_nuevo', $data);
    }

    public function ver($codigoRol) {
        $datosRol = $this->rol_model->obtener_rol($codigoRol);
        $data['titulo'] = 'VER ROL';
        $data['modo'] = 'E';
        $data['nombreRol'] = $datosRol[0]->ROL_descripcion;
        $data['codigo'] = $datosRol[0]->ROL_codigo;
        $data['menu'] = $this->menu_model->obtener_menu();
        $this->load->view('3_lecturas/rol_ver', $data);
    }

    public function modificar() {
        $nombre = $this->input->post('nombreRol');
        $rol = $this->input->post('codigo');
        
        $objeto = new stdClass();
        $objeto->ROL_descripcion = strtoupper($nombre);
        $this->rol_model->modificar_rol($objeto, $rol);
        $menuPadre = $this->input->post('nombre');
        $menuHijo = $this->input->post('checkO');
        $this->permiso_model->eliminar_permiso($rol);
        
        if (is_array($menuPadre)) {
            foreach ($menuPadre as $valorPadre) {
                if ($valorPadre != '') {
                    $objetoPermisoPadre = new stdClass();
                    $objetoPermisoPadre->ROL_codigo = $rol;
                    $objetoPermisoPadre->MENU_codigo = $valorPadre;
                    $this->permiso_model->insertar_permiso($objetoPermisoPadre);
                }
            }
        }
        
        if (is_array($menuHijo)) {
            foreach ($menuHijo as $valorHijo) {
                if ($valorHijo != '') {
                    $objetoPermisoHijo = new stdClass();
                    $objetoPermisoHijo->ROL_codigo = $rol;
                    $objetoPermisoHijo->MENU_codigo = $valorHijo;
                    $this->permiso_model->insertar_permiso($objetoPermisoHijo);
                }
            }
        }
    }

    public function eliminar($idRol) {
        $this->rol_model->eliminar_rol($idRol);
        redirect('seguridad/rol/listar');
    }
    
    public function getGradoAjax($nivel = 0){
        $objGrado = $this->grado_model->listar_grados_por_nivel($nivel);
        $option = '<option value="0">--Seleccione Grado--</option>';
        if(is_array($objGrado)){
            foreach ($objGrado as $value){
                $option .= '<option value="'.$value->GRAD_id.'">'.$value->GRAD_nombre.'</option>';
            }
        }
        echo $option;
    }
    public function getCursoGrado($grado = 0){
        $result = 0;
        if($grado > 0){
            $curso = $this->curso_model->getCursoGrado($grado);
            //imprimir($curso);
            $title = "";
            $cursos_td = array();
            if(is_array($curso)){
                $result = 1;
                $title = 'CURSOS A LLEVAR:';
                foreach ($curso as $i=>$value){
                    $cursos_td[$i]['CURS_id'] = $value->CURS_id;
                    $cursos_td[$i]['CURS_nombre'] = $value->CURS_nombre;
                    $cursos_td[$i]['CURS_profesores'] = array();
                    $cursos_td[$i]['CURS_profesores'] = array();
                }

            }else{
                $result = 2;
                $title = "Seleccione un grado";
            }
        }
        echo json_encode(array("result"=>$result, "title"=>$title, "cursos"=>$cursos_td));
    }
    
    public function decargar($id){
        $obGrado = $this->grado_model->getGradoById($id);

        if($obGrado){
            $archivo = 'Horario_'.$obGrado[0]->GRAD_nombre.'_'.$obGrado[0]->NIVE_nombre.'_'.date('Y').'.xlsx';
            $this->load->library('PHPExcel/Classes/PHPExcel.php');
            $this->phpexcel->getProperties()->setCreator("Arkos Noem Arenom")
                                    ->setLastModifiedBy("Arkos Noem Arenom")
                                    ->setTitle("Office 2007 XLSX Test Document")
                                    ->setSubject("Office 2007 XLSX Test Document")
                                    ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
                                    ->setKeywords("office 2007 openxml php")
                                    ->setCategory("Test result file");

            $dia = date('Y-m-d').' 08:00:00';
            $intervalo = 40*60;
            $curso = $this->curso_model->getCursoGrado($id);
            $cant_horas = 8;
            
            
            
            
            
            // agregamos información a las celdas
            $this->phpexcel->setActiveSheetIndex(0)
                            ->setCellValue('A1', 'Grado')
                            ->setCellValue('B1', $obGrado[0]->GRAD_nombre.' '.$obGrado[0]->NIVE_nombre);
            $this->phpexcel->setActiveSheetIndex(0)
                            ->setCellValue('A2', 'Inicio')
                            ->setCellValue('B2', 'Fin')
                            ->setCellValue('C2', 'Lunes')
                            ->setCellValue('D2', 'Martes')
                            ->setCellValue('E2', 'Miercoles')
                            ->setCellValue('F2', 'Jueves')
                            ->setCellValue('G2', 'Viernes');
            
            $I = 1;
            $inicio_num = strtotime($dia);

            while ($I <= $cant_horas){
                $texto = '';
                $fin_num = $inicio_num+$intervalo;
                if($I == 4){
                    $fin_num = $inicio_num+(20*60);
                    $texto = 'Recreo';
                }
                $this->phpexcel->setActiveSheetIndex(0)
                        ->setCellValue('A' . ($I+2), date('H:i',$inicio_num))
                        ->setCellValue('B' . ($I+2), date('H:i',$fin_num))
                        ->setCellValue('C' . ($I+2), $texto)
                        ->setCellValue('D' . ($I+2), $texto)
                        ->setCellValue('E' . ($I+2), $texto)
                        ->setCellValue('F' . ($I+2), $texto)
                        ->setCellValue('G' . ($I+2), $texto);
                $inicio_num = $fin_num;
                $I++;
            }
            
            $this->phpexcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
            $this->phpexcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
            $this->phpexcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
            $this->phpexcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
            $this->phpexcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
            $this->phpexcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
            $this->phpexcel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
            
            $objStyle = $this->phpexcel->getActiveSheet()->getStyle('A1:G1');
            $objFont = $objStyle->getFont();
            $objFont->getColor()->setARGB('FFFFFF');
            $objFill = $objStyle->getFill();
            $objFill->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
            $objFill->getStartColor()->setARGB('55DCD2');
            
            $objStyle1 = $this->phpexcel->getActiveSheet()->getStyle('A2:G2');
            $objFont1 = $objStyle1->getFont();
            $objFont1->getColor()->setARGB('FFFFFF');
            $objFill1 = $objStyle1->getFill();
            $objFill1->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
            $objFill1->getStartColor()->setARGB('FCAA54');
            
            // Renombramos la hoja de trabajo
            $this->phpexcel->getActiveSheet()->setTitle('Horario');
            
            $objWorkSheet = $this->phpexcel->createSheet(1); //Setting index when creating

            //Write cells
            $objWorkSheet->setCellValue('A1', 'Cursos')
                    ->setCellValue('A2', 'Código')
                    ->setCellValue('B2', 'Nombre del curso');
            $J = 1;
            if($curso){
                foreach ($curso as $value){
                    $objWorkSheet->setCellValue('A'. ($J+2), $value->CURS_abreviatura)
                                ->setCellValue('B'. ($J+2), $value->CURS_nombre);
                    $J++;
                }
            }
            $objWorkSheet->getColumnDimension('A')->setAutoSize(true);
            $objWorkSheet->getColumnDimension('B')->setAutoSize(true);
            $objStyle2 =$objWorkSheet->getStyle('A2:B2');
            $objFont2 = $objStyle2->getFont();
            $objFont2->getColor()->setARGB('FFFFFF');
            $objFill2 = $objStyle2->getFill();
            $objFill2->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
            $objFill2->getStartColor()->setARGB('FCAA54');
            
            // Rename sheet
            $objWorkSheet->setTitle("Cursos");
            
            // configuramos el documento para que la hoja
            // de trabajo número 0 sera la primera en mostrarse
            // al abrir el documento
            $this->phpexcel->setActiveSheetIndex(0);


            // redireccionamos la salida al navegador del cliente (Excel2007)
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="'.$archivo.'"');
            header('Cache-Control: max-age=0');

            $objWriter = PHPExcel_IOFactory::createWriter($this->phpexcel, 'Excel2007');
            $objWriter->save('php://output');
        }
    }
    
    public function horario($id){
        $num_hora_recreo = 4;
        $js = base_url().'js/'.$this->_carpeta.'/'.  $this->_class.'.js';
        if(isset($_POST['action']) && $_POST['action'] == 'registrar'){
            $name_file = $_FILES['txt_horario']['name'];
            if(copy($_FILES['txt_horario']['tmp_name'], PATH_FILES.$name_file)){
                $this->load->library('PHPExcel/Classes/PHPExcel.php');
                try{
                    $this->load->model('configuracion/horario_model', 'HOR');
                    $objPHPExcel = PHPExcel_IOFactory::load(PATH_FILES.$name_file);
                    $allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(NULL, NULL, TRUE, TRUE);
                    $this->HOR->eliminar($_POST['txt_grado']);
                    $i = 1;
                    foreach($allDataInSheet as $index=>$valor){
                        if($index >= 3){
                            if($i != $num_hora_recreo){
                                $inicio = $valor['A'].':00';
                                $fin = $valor['B'].':00';
                                $curso1 =  trim($valor['C']);
                                $curso2 =  trim($valor['D']);
                                $curso3 =  trim($valor['E']);
                                $curso4 =  trim($valor['F']);
                                $curso5 =  trim($valor['G']);
                                $idCurso1 = $this->curso_model->getIdByCode($curso1);
                                $idCurso2 = $this->curso_model->getIdByCode($curso2);
                                $idCurso3 = $this->curso_model->getIdByCode($curso3);
                                $idCurso4 = $this->curso_model->getIdByCode($curso4);
                                $idCurso5 = $this->curso_model->getIdByCode($curso5);
                                
                                /*Lunes*/
                                $insert1 = array();
                                $insert1['HOR_inicio'] = $inicio;
                                $insert1['HOR_fin'] = $fin;
                                $insert1['CURS_id'] = $idCurso1;
                                $insert1['GRAD_id'] = $_POST['txt_grado'];
                                $insert1['HOR_num_dia'] = 1;
                                $this->HOR->insertar($insert1);
                                
                                /*Martes*/
                                $insert2 = array();
                                $insert2['HOR_inicio'] = $inicio;
                                $insert2['HOR_fin'] = $fin;
                                $insert2['CURS_id'] = $idCurso2;
                                $insert2['GRAD_id'] = $_POST['txt_grado'];
                                $insert2['HOR_num_dia'] = 2;
                                $this->HOR->insertar($insert2);
                                
                                /*Miercoles*/
                                $insert3 = array();
                                $insert3['HOR_inicio'] = $inicio;
                                $insert3['HOR_fin'] = $fin;
                                $insert3['CURS_id'] = $idCurso3;
                                $insert3['GRAD_id'] = $_POST['txt_grado'];
                                $insert3['HOR_num_dia'] = 3;
                                $this->HOR->insertar($insert3);
                                
                                /*Jueves*/
                                $insert4 = array();
                                $insert4['HOR_inicio'] = $inicio;
                                $insert4['HOR_fin'] = $fin;
                                $insert4['CURS_id'] = $idCurso4;
                                $insert4['GRAD_id'] = $_POST['txt_grado'];
                                $insert4['HOR_num_dia'] = 4;
                                $this->HOR->insertar($insert4);
                                
                                /*Viernes*/
                                $insert5 = array();
                                $insert5['HOR_inicio'] = $inicio;
                                $insert5['HOR_fin'] = $fin;
                                $insert5['CURS_id'] = $idCurso5;
                                $insert5['GRAD_id'] = $_POST['txt_grado'];
                                $insert5['HOR_num_dia'] = 5;
                                $this->HOR->insertar($insert5);
                            }
                            $i++;
                        }
                    }
                    
                    $post['excel'] = $allDataInSheet;
                    $post['js'] = $js;
                    $this->layout->view('educacion/grado_horario_post', $post);
                } catch (Exception $ex) {
                    $this->resp->success = FALSE;
                    $this->resp->msg = 'Error al leer el archivo';
                    echo json_encode($this->resp);
                }
            }
        }else{
            $data['action'] = 'registrar';
            $data['idGrado'] = $id;
            $data['titulo'] = 'Registrar Horario';
            $data['js'] = $js;
            $this->layout->view(NULL, $data);
        }
    }
}
?>
