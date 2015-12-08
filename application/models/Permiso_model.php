<?php
class Permiso_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    public function obtenerPermisos()
    {
        $where=array("PER__ESTADO"=>true);
        $query=$this->db
        ->select("PER_ID,PER_DESCRIPCION")
        ->from("PERMISOS")
        ->where($where)
        ->get();
        return $query->result();
    }

}
