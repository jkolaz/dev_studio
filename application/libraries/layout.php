<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Layout {

    var $obj;
    var $layout;

    function Layout($layout = 'layout/layout') {
        $this->obj = & get_instance();
        $this->layout = $layout;
    }

    function setLayout($layout) {
        $this->layout = $layout;
    }

    function view($view = null, $data = null, $return = false) {
        $loadedData = array();
        if($view == NULL){
            $view = $this->obj->_carpeta.'/'.$this->obj->_class.'_'.$this->obj->_method;
        }
        $loadedData['content_for_layout'] = $this->obj->load->view($view, $data, true);
        if ($return) {
            $output = $this->obj->load->view($this->layout, $loadedData, true);
            return $output;
        } else {
            $this->obj->load->view($this->layout, $loadedData, false);
        }
    }

}
?>