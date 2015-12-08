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

    



}
