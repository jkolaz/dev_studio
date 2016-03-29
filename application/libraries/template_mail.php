<?php
class Template_Mail
{
	var $_dir_template;
	var $a_vars;
	var $_html;

	function templateMail($file_name) 
	{
		$this->_dir_template = PATH_LIBRARY."templates/".$file_name;
		
	}
	
	function loadHtml()
	{

		$lines = file($this->_dir_template);
		for($i=0;$i<count($lines);$i++){
			$this->_html .= $lines[$i];
		}
		
		
		$this->a_vars["date_year"] = date("Y");
		/*reemplazando variabes*/
		if(is_array($this->a_vars))
		{
			foreach($this->a_vars as $idval => $valval)
			{
				$this->_html = str_replace("{".$idval."}",$valval,$this->_html);
			}
		}
		
	}
	
	function getHtml($avars)
	{
		$this->a_vars = $avars;
		$this->loadHtml();
		return $this->_html;
	}
}
?>