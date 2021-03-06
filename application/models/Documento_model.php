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

    public function obtenerDocumento($datos=array())
    {
        $where=$datos;
        $query=$this->db
        ->select("DOC_ID,PRO_ID,DOC_NOMBRE,DOC_FECHA,DOC_ESTADO,ID_USUARIO,DOC_DESCRIPCION")
        ->from("DOCUMENTOS")
        ->where($where)
        ->get();
        return $query->row();
    }

    public function obtenerListaDocumentos($id_port,$id_usu)
    {
        $where=array("PRO_ID"=>$id_port,"ID_USUARIO"=>$id_usu,"DOC_ESTADO"=>1);
        $query=$this->db
        ->select("DOC_ID,DOC_NOMBRE")
        ->from("DOCUMENTOS")
        ->where($where)
        ->get();
        return $query->result();
    }

    public function obtenerVersion($datos=array())
    {
        $where=$datos;
        $query=$this->db
        ->select("VER_ID,DOC_ID,VER_NUMERO,VER_FECHA,VER_COMENTARIO,ID_USUARIO")
        ->from("VERSION")
        ->where($where)
        ->get();
        return $query->row();
    }

}
