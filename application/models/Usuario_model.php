<?php
class Usuario_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
    public function getTodosUsuarios()
    {
        $query=$this->db
        ->select("USU_ID,USU_RUT,USU_DV,USU_NOMBRES,USU_APELLIDO_PATERNO,USU_APELLIDO_MATERNO")
        ->from("USUARIO")
        ->order_by("USU_RUT","asc")
        ->get();
        return $query->result();
    }

    public function getUsuarioPorId($id)
    {
        $where=array("USU_ID"=>$id);
        $query=$this->db
        ->select("USU_ID,USU_RUT,USU_DV,USU_NOMBRES,USU_APELLIDO_PATERNO,USU_APELLIDO_MATERNO")
        ->from("USUARIO")
        ->where($where)
        ->get();
        //echo $this->db->last_query();
        return $query->row();
    }
} 
