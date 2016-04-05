<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

if(!function_exists('create_log')){
    function createLog($fichero, $mensaje, $tarea, $admin, $type="ERROR", $user= ""){
        switch ($type){
            case "REGISTRO":
                break;
            default :
                return FALSE;
        }
        
        $archivo = PATH_ADMIN."application/logs/".$fichero."/".date("Y_m_d").".txt";
        if ( ! $fp = @fopen($archivo, FOPEN_WRITE_CREATE)){
            return FALSE;
        }
        $message = '';
        $message .= $type.' | '. $admin . ' | ' .date('Y-m-d H:i:s'). ' | '.$mensaje. ' | '. $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] . ' | '. $_SERVER['HTTP_USER_AGENT'];
        $message .= ' | '.$tarea.' | '. $user ."||\n";
        flock($fp, LOCK_EX);
        fwrite($fp, $message);
        flock($fp, LOCK_UN);
        fclose($fp);

        @chmod($archivo, FILE_WRITE_MODE);
        return TRUE;
    }
}

