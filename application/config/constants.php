<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
  |--------------------------------------------------------------------------
  | File and Directory Modes
  |--------------------------------------------------------------------------
  |
  | These prefs are used when checking and setting modes when working
  | with the file system.  The defaults are fine on servers with proper
  | security, but you may wish (or even need) to change the values in
  | certain environments (Apache running a separate process for each
  | user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
  | always be used to set the mode correctly.
  |
 */
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);

/*
  |--------------------------------------------------------------------------
  | File Stream Modes
  |--------------------------------------------------------------------------
  |
  | These modes are used when working with fopen()/popen()
  |
 */

define('FOPEN_READ', 'rb');
define('FOPEN_READ_WRITE', 'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE', 'ab');
define('FOPEN_READ_WRITE_CREATE', 'a+b');
define('FOPEN_WRITE_CREATE_STRICT', 'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

// constantes propias definidas
define('TITULO', 'EDUSOFT');
define('RUTA_DOCUMENTOS', './docs/');
define('PADRES', 'P');
define('HIJOS', 'H');

define('URL_IMAGES', 'http://localhost/edusoft/img/');
define('URL_JS', 'http://localhost/edusoft/js/');
define('URL_CSS', 'http://localhost/edusoft/css');
define('URL_BASE', 'http://localhost/edusoft/');

define("IS_PRODUCTION", FALSE);
define("SERVER_HTTPS_PRO", "http://");
define("SUBCARPETA_NAME", "/");
define("SERVER_PATH", $_SERVER['DOCUMENT_ROOT'] . SUBCARPETA_NAME);
if(IS_PRODUCTION){
    define("SERVER_NAME", SERVER_HTTPS_PRO . 'www.jkolaz.com/tesis/');
    define("PATH_ADMIN", SERVER_PATH.'tesis/' );
}else{
    define("SERVER_NAME", SERVER_HTTPS_PRO . 'www.colegio.devel/');
    define("PATH_ADMIN", SERVER_PATH );
}
define("PATH_LIBRARY", PATH_ADMIN . "application/libraries/");
define("PATH_GALLERY", PATH_ADMIN . "img/upload/");
define("PATH_PDF", PATH_ADMIN . "PDF/");
define("SERVER_PDF", SERVER_NAME . "PDF/");

/* End of file constants.php */
/* Location: ./application/config/constants.php */