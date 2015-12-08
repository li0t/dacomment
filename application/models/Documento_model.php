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

    public function obtenerDocumentosPortafolio($id)
    {
        $where=array("PRO_ID"=>$id);
        $query=$this->db
        ->select("DOC_ID,PRO_ID,DOC_NOMBRE,DOC_FECHA,DOC_ESTADO,ID_USUARIO,DOC_DESCRIPCION")
        ->from("DOCUMENTOS")
        ->where($where)
        ->get();
        return $query->result();
    }

    public function obtenerIdDocumento($datos=array())
    {
        $where=$datos;
        $query=$this->db
        ->select("DOC_ID")
        ->from("DOCUMENTOS")
        ->where($where)
        ->get();
        return $query->row();
    }



}
