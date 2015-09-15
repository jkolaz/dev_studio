<?php

require_once 'application/libraries/excel/PHPExcel/IOFactory.php';

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

if (!function_exists('imprimir')) {

    function imprimir($objeto) {
        echo '<pre>';
        print_r($objeto);
        echo '</pre>';
    }

}

if (!function_exists('importar_excel')) {

    function importar_excel($nombreArchivo, &$hoja, &$numFilas, &$filaInicio) {
        $excel = PHPExcel_IOFactory::load($nombreArchivo);
        // revisamos si el archivo Excel tiene o no fila de cabeceras
        (TIENE_CABECERA) ? $filaInicio = 2 : $filaInicio = 1;
        // definimos la hoja activa
        $hoja = $excel->getSheet(HOJA_ACTIVA);
        $numFilas = $hoja->getHighestRow();
    }

}

if (!function_exists('importar_excel_2007')) {

    function importar_excel_2007($nombreArchivo) {
        $excel2007 = PHPExcel_IOFactory::createReader('Excel2007');
        $excel2007->setReadDataOnly(true);
        $excel = $excel2007->load($nombreArchivo);

        // revisamos si el archivo Excel tiene o no fila de cabeceras
        (TIENE_CABECERA) ? $filaInicio = 2 : $filaInicio = 1;

        // definimos la hoja activa
        $objExcel = $excel->setActiveSheetIndex(1);

        return $objExcel;
    }

}

if (!function_exists('dame_fecha')) {

    function dame_fecha($fecha) {
        if ($fecha)
            return date('Y-m-d', strtotime($fecha));
        return '';
    }

}

if (!function_exists('dame_fecha_estandar')) {

    function dame_fecha_estandar($fecha) {
        if ($fecha)
            return date('d/m/Y', strtotime($fecha));
        return '';
    }

}

if (!function_exists('dame_fecha_hora')) {

    function dame_fecha_hora($fecha) {
        if ($fecha)
            return substr($fecha, 0, strlen($fecha) - 3);
        return '';
    }

}

if (!function_exists('sumar_dias')) {

    function sumar_dias($fecha, $numeroDias) {
        if ($fecha)
            return date('Y-m-d', strtotime('+' . $numeroDias . ' day', strtotime($fecha)));
        return '';
    }

}

if (!function_exists('restar_dias')) {

    function restar_dias($fecha, $numeroDias) {
        if ($fecha)
            return date('Y-m-d', strtotime('-' . $numeroDias . ' day', strtotime($fecha)));
        return '';
    }

}

if (!function_exists('dias_entre_fechas')) {

    function dias_entre_fechas($fechaDesde, $fechaHasta) {
        $fechaDesde = strtotime($fechaDesde);
        $fechaHasta = strtotime($fechaHasta);
        $diferencia = ($fechaHasta - $fechaDesde);
        if ($diferencia < 0)
            return 0;
        return round($diferencia / (60 * 60 * 24));
    }

}

if (!function_exists('utf8')) {

    function utf8($cadena) {
        return utf8_decode(trim($cadena));
    }

}

if (!function_exists('limpiar_espacios_vacios')) {

    function limpiar_espacios_vacios($cadena) {
        return trim($cadena);
    }

}

if (!function_exists('calcular_fecha')) {

    function calcular_fecha($numeroDias) {
        $fechaBase = '1970-01-01';
        $diasOffset = 25569;
        if ($numeroDias)
            return date('Y-m-d', strtotime('+' . $numeroDias - $diasOffset . ' day', strtotime($fechaBase)));
        return '';
    }

}

if (!function_exists('cinco_espacios')) {

    function cinco_espacios() {
        echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
    }

}

if (!function_exists('tres_espacios')) {

    function tres_espacios() {
        echo '&nbsp;&nbsp;&nbsp;';
    }

}

if (!function_exists('dos_espacios')) {

    function dos_espacios() {
        echo '&nbsp;&nbsp;';
    }

}

if (!function_exists('dia_de_semana')) {

    function dia_de_semana($fecha) {
        if ($fecha)
            return date('N', strtotime($fecha));
        return '';
    }

}

if (!function_exists('validar_valor_negativo')) {

    function validar_valor_negativo($valor, $parametroPermiteNegativos) {
        return ($valor < 0 && $parametroPermiteNegativos == 'N') ? 0 : $valor;
    }

}

if (!function_exists('obtener_promedio_arreglo')) {

    function promedio_arreglo($ARREGLO, $parametroNumeroDecimales) {
        return $ARREGLO ? number_format(array_sum($ARREGLO) / sizeof($ARREGLO), $parametroNumeroDecimales) : 0;
    }

}

if (!function_exists('lista_a_arreglo')) {

    function lista_a_arreglo($lista, $campoIndice, $campoValor) {
        $ARREGLO = null;
        if ($lista) {
            foreach ($lista as $var) {
                $indice = $var->$campoIndice;
                $valor = $var->$campoValor;
                $ARREGLO[$indice] = $valor;
            }
        }
        return $ARREGLO;
    }

}

if (!function_exists('numero_a_porcentaje')) {

    function numero_a_porcentaje($cantidad) {
        return 100 * ($cantidad - 1);
    }

}

if (!function_exists('porcentaje_a_numero')) {

    function porcentaje_a_numero($porcentaje) {
        return $porcentaje / 100 + 1;
    }

}

if (!function_exists('obtener_ejecucion')) {

    function obtener_ejecucion($proceso, $indicadorHoyManhana) {
        $fechaProceso = dame_fecha($proceso[0]->EJEC_inicio);
        if ($indicadorHoyManhana == 'H')
            $fechaProceso = sumar_dias($fechaProceso, 1);
        return $fechaProceso;
    }

}

if (!function_exists('obtener_ejecucion_simple')) {

    function obtener_ejecucion_simple($proceso) {
        return dame_fecha($proceso[0]->EJEC_inicio);
    }

}

if (!function_exists('obtener_parametros')) {

    function obtener_parametros($listaParametros) {
        return lista_a_arreglo($listaParametros, 'PARA_codigo', 'PARA_valor');
    }

}

if (!function_exists('describir_valor')) {

    function describir_valor($valor) {
        switch ($valor) {
            case 'R' : $descripcion = 'Real';
                break;
            case 'P' : $descripcion = 'Planificado';
                break;
            case 'H' : $descripcion = 'Ejecucion matutina';
                break;
            case 'M' : $descripcion = 'Ejecucion nocturna';
                break;
            case 'N' : $descripcion = 'No repetir';
                break;
            case 'S' : $descripcion = 'Repetir todos los dias';
                break;
            default : $descripcion = $valor;
        }
        return $descripcion;
    }

}

if (!function_exists('describir_sexo')) {

    function describir_sexo($valor) {
        switch ($valor) {
            case 'F' : $descripcion = 'Femenino';
                break;
            case 'M' : $descripcion = 'Masculino';
                break;
            default : $descripcion = $valor;
        }
        return $descripcion;
    }

}

if (!function_exists('describir_estado')) {

    function describir_estado($valor) {
        switch ($valor) {
            case 'AC' : $descripcion = '<span style="color: green; font-weight: bold;">ACTIVO</span>';
                break;
            case 'DE' : $descripcion = 'CON DEUDA';
                break;
            case 'BL' : $descripcion = '<span style="color: red; font-weight: bold;">BLOQUEADO</span>';
                break;
            case 'IN' : $descripcion = 'INACTIVO';
                break;
            case 'OB' : $descripcion = 'OBSERVADO';
                break;
            case 'MA' : $descripcion = 'MATRICULADO';
                break;
            case 'EG' : $descripcion = 'EGRESADO';
                break;
            case 'CA' : $descripcion = 'CANCELADO';
                break;
            case 'PE' : $descripcion = 'PENDIENTE';
                break;
            case 'RE' : $descripcion = 'RETRAZADO';
                break;
            case 'TA' : $descripcion = 'TALLER';
                break;
            case 'VI' : $descripcion = 'VIGENTE';
                break;
            default : $descripcion = $valor;
        }
        return $descripcion;
    }

}

if(!function_exists('estado_anio')){
    function estado_anio($anio){
        $estado_html= "";
        switch ($anio){
            case '1':
                $estado_html = '<span style="color: green; font-weight:bold;">ACTUAL</span>';
                break;
            case '0':
                $estado_html = '<span style="color: red; font-weight:bold;">DESACTIVADO</span>';
                break;
        }
        return $estado_html;
    }    
}

if(!function_exists('estado_panel')){
    function estado_panel($id, $estado, $disabled = ""){
        $estado_html= "";
        switch ($estado){
            case '1':
                $estado_html = '<a href="javascript:;" class="estado" clave="'.$id.'" id="estado_'.$id.'" style="color: green; font-weight:bold;">ACTIVADO</a>';
                break;
            case '0':
                $estado_html = '<a href="javascript:;" class="estado" clave="'.$id.'" id="estado_'.$id.'" style="color: red; font-weight:bold;">DESACTIVADO</a>';
                break;
        }
        if($disabled == 1){
            $estado_html = '<span style="color: gray; font-weight:bold;">NO TIENE PERMISO</span>';
        }
        return $estado_html;
    }
}

if(!function_exists('checkbox_rol')){
    function checkbox_rol($name, $class, $id, $value, $checked = "", $disabled = ""){
        $checked_html = "";
        if($checked == 1){
            $checked_html = 'checked="checked"';
        }
        $disabled_html = "";
        if($disabled == 1){
            $disabled_html = 'disabled';
        }
        $seleccionar_html = '<input type="checkbox" '.$disabled_html.' '.$checked_html.' name="'.  str_replace(' ', '', $name).'[]" class="'.$class.'" id="'.str_replace(' ', '', $name).'_'.$id.'" value="'.$value.'" panel="'.$id.'"/>';
        return $seleccionar_html;
    }
}

if(!function_exists('url_estado')){
	function url_estado($estado,$rol){
		switch($rol){
			case 1:/*alumno*/
				$function = "onclick('ver_detalle_alumno')";
			break;
			case 2:/*profesor*/
				$function = "onclick('ver_detalle_profesor')";
			break;
			case 3:/*padre de familia*/
				$function = "onclick('ver_detalle_padre')";
			break;
			case 4:/*apoderado*/
				$function = "onclick('ver_detalle_apoderado')";
			break;
			case 5:/*personal administrativo*/
				$function = "onclick('ver_detalle_personal')";
			break;
			default:
				$function = "";
		}
		switch($estado){
			case 'AC' : $descripcion = '<a class="pop_up" href="'.$function.'">ACTIVO</a>';
                break;
            case 'DE' : $descripcion = '<a class="pop_up" href="'.$function.'">CON DEUDA</a>';
                break;
            case 'BL' : $descripcion = '<a class="pop_up" href="'.$function.'">BLOQUEADO</a>';
                break;
            case 'IN' : $descripcion = '<a class="pop_up" href="'.$function.'">INACTIVO</a>';
                break;
            case 'OB' : $descripcion = '<a class="pop_up" href="'.$function.'">OBSERVADO</a>';
                break;
            case 'MA' : $descripcion = '<a class="pop_up" href="'.$function.'">MATRICULADO</a>';
                break;
            case 'EG' : $descripcion = '<a class="pop_up" href="'.$function.'">EGRESADO</a>';
                break;
            case 'CA' : $descripcion = '<a class="pop_up" href="'.$function.'">CANCELADO</a>';
                break;
            case 'PE' : $descripcion = '<a class="pop_up" href="'.$function.'">PENDIENTE</a>';
                break;
            case 'RE' : $descripcion = '<a class="pop_up" href="'.$function.'">RETRAZADO</a>';
                break;
            case 'TA' : $descripcion = '<a class="pop_up" href="'.$function.'">TALLER</a>';
                break;
            case 'VI' : $descripcion = '<a class="pop_up" href="'.$function.'">VIGENTE</a>';
                break;
            default : $descripcion = $valor;
		}
		return $descripcion;
	}
}

if (!function_exists('desdoblar_observaciones')) {

    function desdoblar_observaciones($observaciones) {
        $OBSERVACIONES = explode('||', $observaciones);
        $numeroObservaciones = floor(sizeof($OBSERVACIONES) / 2);
        if ($numeroObservaciones) {
            $posicionTexto = 0;
            $posicionFecha = 1;
            for ($i = 0; $i < $numeroObservaciones; $i++) {
                $lista[] = array('texto' => $OBSERVACIONES[$posicionTexto], 'fecha' => $OBSERVACIONES[$posicionFecha]);
                $posicionTexto += 2;
                $posicionFecha += 2;
            }
        }
        return $lista;
    }

}

if (!function_exists('formar_nombre_reducido')) {

    function formar_nombre_reducido($objPersona) {
        $nombres = $objPersona->USUA_nombres;
        $NOMBRES = explode(' ', $nombres);
        return utf8_encode($objPersona->USUA_apellidoPaterno . ' '
                        . $objPersona->USUA_apellidoMaterno . ', ' . $NOMBRES[0]);
    }

}

if (!function_exists('formar_nombre_completo')) {

    function formar_nombre_completo($objPersona) {
        return utf8_encode($objPersona->USUA_apellidoPaterno . ' '
                        . $objPersona->USUA_apellidoMaterno . ', '
                        . $objPersona->USUA_nombres);
    }

}

if (!function_exists('describir_mes')) {

    function describir_mes($mes) {
        switch ($mes) {
            case 1 : $descripcion = 'ENERO';
                break;
            case 2 : $descripcion = 'FEBRERO';
                break;
            case 3 : $descripcion = 'MARZO';
                break;
            case 4 : $descripcion = 'ABRIL';
                break;
            case 5 : $descripcion = 'MAYO';
                break;
            case 6 : $descripcion = 'JUNIO';
                break;
            case 7 : $descripcion = 'JULIO';
                break;
            case 8 : $descripcion = 'AGOSTO';
                break;
            case 9 : $descripcion = 'SETIEMBRE';
                break;
            case 10 : $descripcion = 'OCTUBRE';
                break;
            case 11 : $descripcion = 'NOVIEMBRE';
                break;
            case 12 : $descripcion = 'DICIEMBRE';
                break;
        }
        return $descripcion;
    }

}

if (!function_exists('pasar_lista_usuarios_a_cadena')) {

    function pasar_lista_usuarios_a_cadena($lista) {
        $cad = '';
        if ($lista)
            foreach ($lista as $objeto)
                $cad .= formar_nombre_reducido($objeto) . '<br>';
        return $cad;
    }

}

if (!function_exists('pasar_lista_a_arreglo')) {

    function pasar_lista_a_arreglo($lista, $campoIndice, $campoValor) {
        $ARREGLO = array();
        if ($lista) {
            foreach ($lista as $objeto) {
                $codigo = trim($objeto->$campoIndice);
                $valor = trim($objeto->$campoValor);
                $ARREGLO[$codigo] = $valor;
            }
        }
        return $ARREGLO;
    }

}

if (!function_exists('pasar_lista_a_matriz')) {

    function pasar_lista_a_matriz($lista, $campoIndiceLinea, $campoIndiceColumna, $campoValor) {
        $MATRIZ = array();
        if ($lista) {
            foreach ($lista as $fila) {
                $indiceLinea = trim($fila->$campoIndiceLinea);
                $indiceColumna = trim($fila->$campoIndiceColumna);
                $valor = $fila->$campoValor;
                $MATRIZ[$indiceLinea][$indiceColumna] = $valor;
            }
        }
        return $MATRIZ;
    }

}

if (!function_exists('validar')) {

    function validar($ARREGLO, $indice) {
        if (array_key_exists($indice, $ARREGLO))
            return $ARREGLO[$indice];
        return '-';
    }

}

if (!function_exists('validar_nota_bimestre')) {

    function validar_nota_bimestre($NOTAS, $bimestre) {
        return array_key_exists($bimestre, $NOTAS) ? $NOTAS[$bimestre]['promedio'] : '-';
    }

}

if (!function_exists('validar_parciales_bimestre')) {

    function validar_parciales_bimestre($NOTAS, $bimestre) {
        return array_key_exists($bimestre, $NOTAS) ? $NOTAS[$bimestre]['parciales'] : '-';
    }

}
if(!function_exists('grupo_nota')){
    function grupo_nota($nota){
        $html = '<span style="color: red">'.$nota.'</span>';
        if($nota > 10 && $nota < 15){
            $html = '<span style="color: orange">'.$nota.'</span>';
        }elseif($nota >= 15){
            $html = '<span style="color: blue">'.$nota.'</span>';
        }
        return $html;
    }
}

?>
