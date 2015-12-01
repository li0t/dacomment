<?php
class Portafolio_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    public function obtenerPortafolios()
    {
        $where=array("PRO_ESTADO"=>true);
        $query=$this->db
        ->select("PRO_ID,USU_ID,PRO_NOMBRE,PRO_FECHA")
        ->from("PORTAFOLIO")
        ->where($where)
        ->order_by("PRO_ID","asc")
        ->get();
        return $query->result();
    }

    public function obtenerPortafolioPorId($id)
    {
        $where=array("PRO_ID"=>$id);
        $query=$this->db
        ->select("PRO_ID,USU_ID,PRO_NOMBRE,PRO_FECHA")
        ->from("PORTAFOLIO")
        ->where($where)
        ->get();
        return $query->row();
    }

    public function insertarPortafolio($datos=array())
    {
        $query=$this->db->insert("PORTAFOLIO",$datos);
        return true;
    }

    public function modificarPortafolio($datos=array(),$id)
    {
        $this->db->where('PRO_ID',$id);
        $this->db->update('PORTAFOLIO',$datos);
        return true;
    }

} 
