<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

if(!function_exists('encriptar')){
    function encriptar($cadena, $clave) {
        return $cadena;
        $cifrado = MCRYPT_RIJNDAEL_256;
        $modo = MCRYPT_MODE_ECB;
        $cadena_encriptada = mcrypt_encrypt($cifrado, $clave, $cadena, $modo, mcrypt_create_iv(mcrypt_get_iv_size($cifrado, $modo), MCRYPT_RAND));
        $cadena_encriptada = base64_encode($cadena_encriptada);
        return $cadena_encriptada;
    }
}

if(function_exists('desencriptar')){
    function desencriptar($cadena, $clave, $type = 0) {
        if ($type == 0) {
            return $cadena;
        } else {
            $cadena = base64_decode($cadena);
            //echo $cadena; exit;
            $cifrado = MCRYPT_RIJNDAEL_256;
            $modo = MCRYPT_MODE_ECB;
            $temp = mcrypt_decrypt($cifrado, $clave, $cadena, $modo, mcrypt_create_iv(mcrypt_get_iv_size($cifrado, $modo), MCRYPT_RAND));
            //Para saltar caracteres raros
            $temppos = stripos($temp, chr(0));

            if ($temppos !== false) {
                $cadena_desencriptada = substr($temp, 0, $temppos);
            } else {
                $cadena_desencriptada = $temp;
            }
            return $cadena_desencriptada;
        }
    }
}