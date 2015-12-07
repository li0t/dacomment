<?php
class Documento_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }


    public function insertarDocumento($datos=array())
    {
        $query=$this->db->insert("DOCUMENTOS",$datos);
        return true;
    }



}
