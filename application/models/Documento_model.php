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

    public function entregarPermisoDocumento($datos=array())
    {
        $query=$this->db->insert("PERMISOS_DOCUMENTOS",$datos);
        return true;
    }

    public function obtenerPermisoDocumentos($id_doc)
    {
        $where=array("PERMISOS_DOCUMENTOS.DOC_ID"=>$id_doc,"DOCUMENTOS.DOC_ESTADO"=>1);
        $query=$this->db
        ->select("DOCUMENTOS.DOC_ID,DOCUMENTOS.DOC_NOMBRE,USUARIO.USU_ID,USUARIO.USU_NOMBRES,USUARIO.USU_APELLIDO_PATERNO,PERMISOS.PER_DESCRIPCION,PERMISOS.PER_ID")
        ->from("PERMISOS_DOCUMENTOS")
        ->join("DOCUMENTOS","PERMISOS_DOCUMENTOS.DOC_ID=DOCUMENTOS.DOC_ID")
        ->join("USUARIO","PERMISOS_DOCUMENTOS.USU_ID=USUARIO.USU_ID")
        ->join("PERMISOS","PERMISOS_DOCUMENTOS.PER_ID=PERMISOS.PER_ID")
        ->where($where)
        ->get();
        return $query->result();
    }

    public function eliminarPermisoDocumentos($id_doc,$id_usu,$id_per)
    {
        $this->db->where('DOC_ID', $id_doc);
        $this->db->where('USU_ID', $id_usu);
        $this->db->where('PER_ID', $id_per);
        $this->db->delete('PERMISOS_DOCUMENTOS');
        return true;
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
