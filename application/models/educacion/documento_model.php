<?php

class Documento_Model extends CI_Model {

    private static $tabla = 'documento';

    public function __construct() {
        parent :: __construct();
        $this->load->database();
        $this->load->model('layout/menu_model');
    }

    public function listar_documentos($tipoUsuario) {
        $where = array('DOCU_tipo' => $tipoUsuario, 'DOCU_flagActivo' => 'A');
        $query = $this->db->where($where)->get(self::$tabla);
        if ($query->num_rows > 0)
            return $query->result();
        return null;
    }

    public function contar_documentos($tipoUsuario) {
        $sql = "select COUNT(*) as total
                from documento 
                where DOCU_flagActivo = 'A' and DOCU_tipo = '$tipoUsuario'";
        $query = $this->db->query($sql);
        if ($query->num_rows > 0)
            return $query->result();
        return null;
    }
    
    public function contar_documentos_pendientes($idProfesor) {
        $sql = "select COUNT(*) as total
                from documento_x_entregar
                where USUA_id = '$idProfesor' and DXEN_fechaEntrega is null";
        $query = $this->db->query($sql);
        if ($query->num_rows > 0)
            return $query->result();
        return null;
    }

    public function listar_documentos_profesor($idProfesor) {
        $sql = "select *
                from documento_x_entregar DE, documento D, curso C
                where DE.DOCU_id = D.DOCU_id
                      and DE.CURS_id = C.CURS_id
                      and DE.USUA_id = '$idProfesor'
                order by CURS_nombre, DOCU_nombre";
        $query = $this->db->query($sql);
        if ($query->num_rows > 0)
            return $query->result();
        return null;
    }
    
    public function listar_documentos_entregados($idUsuario, $idGrado) {
        $where = array('USUA_id' => $idUsuario, 'GRAD_id' => $idGrado);
        $query = $this->db->where($where)->get('documento_x_grado_x_usuario');
        if ($query->num_rows > 0)
            return $query->result();
        return null;
    }

    public function contar_documentos_entregados($idUsuario, $idGrado) {
        $sql = "select COUNT(*) as total
                from documento_x_grado_x_usuario 
                where USUA_id = $idUsuario and GRAD_id = $idGrado";
        $query = $this->db->query($sql);
        if ($query->num_rows > 0)
            return $query->result();
        return null;
    }

}

?>
