<?php
class Version_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    public function insertarVersion($datos=array())
    {
        $query=$this->db->insert("VERSION",$datos);
        return true;
    }

    public function obtenerVersiones($id)
    {
        $where=array("DOC_ID"=>$id);
        $query=$this->db
        ->select("VER_ID,DOC_ID,VER_NUMERO,VER_FECHA,VER_COMENTARIO,ID_USUARIO")
        ->from("VERSION")
        ->where($where)
        ->get();
        return $query->result();
    }

    public function obtenerUltimaVersion($id_doc)
    {
        $where=array("DOC_ID"=>$id_doc);        
        $query=$this->db
        ->select_max('VER_NUMERO')
        ->from("VERSION")
        ->where($where)
        ->get();
        return $query->row();
        // Produce: SELECT MAX(VER_NUMERO) as VER_NUMERO FROM VERSION
    }
}
