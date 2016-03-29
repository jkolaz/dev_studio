<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *
 * @package		CodeIgniter
 * @author		ExpressionEngine Dev Team
 * @copyright	Copyright (c) 2008 - 2011, EllisLab, Inc.
 * @license		http://codeigniter.com/user_guide/license.html
 * @link		http://codeigniter.com
 * @since		Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * CodeIgniter Application Controller Class
 *
 * This class object is the super class that every library in
 * CodeIgniter will be assigned to.
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Libraries
 * @author		ExpressionEngine Dev Team
 * @link		http://codeigniter.com/user_guide/general/controllers.html
 */
class CI_Controller {

	private static $instance;

	/**
	 * Constructor
	 */
	public function __construct()
	{
		self::$instance =& $this;
		
		// Assign all the class objects that were instantiated by the
		// bootstrap file (CodeIgniter.php) to local class variables
		// so that CI can run as one big super object.
		foreach (is_loaded() as $var => $class)
		{
			$this->$var =& load_class($class);
		}

		$this->load =& load_class('Loader', 'core');

		$this->load->initialize();
		
		log_message('debug', "Controller Class Initialized");
	}

	public static function &get_instance()
	{
		return self::$instance;
	}
        
        public function senMailNew($subjet, $destino, $cuerpo, $reply = "", $from_name = "", $nombre_usuario="", $patch_attach = "", $template_main = "", $template = ""){
            $this->load->library('My_PHPMailer');
            $this->load->library('Template_Mail');
            
            if ($template_main == "") {
                $main_template = "main";
            } else {
                $main_template = $template_main;
            }
            
            if ($template == "") {
                $template = "generic";
            }
            
            $html = new Template_Mail();
            $mail = new My_PHPMailer();
            
            $html->templateMail($template.".html");
            $mailBody = $html->getHtml($cuerpo);
            
            $mail_vars['title'] = $mail->FromName;
            $mail_vars['html_mail_content'] = $mailBody;
            
            $mailing = new Template_Mail();
            $mailing->templateMail($main_template.".html");
            $body_html = $mailing->getHtml($mail_vars);
            
            $mail->IsSMTP();
            if($from_name != ""){
                $mail->FromName = $from_name;
            }
            if($reply == ""){
                $reply = 'info@jkolaz.com';
            }
            $mail->AddReplyTo($reply);
            $mail->Subject    = $subjet;  //Asunto del mensaje
            $body = $mail->MsgHTML($body_html);
            $mail->Body = $body;
            $mail->AltBody = strip_tags($body);
            $mail->AddAddress($destino, $nombre_usuario);
            if (!empty($patch_attach)) {
                $mail->AddAttachment($patch_attach);      // attachment
            }
            $rs_mail = $mail->Send();
            if (!$rs_mail) {
                imprimir($mail->ErrorInfo); 
                exit;
            }
        }
}
// END Controller class

/* End of file Controller.php */
/* Location: ./system/core/Controller.php */