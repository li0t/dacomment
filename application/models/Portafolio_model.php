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

    public function obtenerMisPortafolios($datos=array())
    {
      $where=$datos;
      $query=$this->db
      ->select("PRO_ID,USU_ID,PRO_NOMBRE,PRO_FECHA")
      ->from("PORTAFOLIO")
      ->where($where)
      ->order_by("PRO_ID","asc")
      ->get();
      return $query->result();
    }

    public function obtenerPortafoliosCompartidos($id)
    {
      $where=array("USU_ID"=>$id);
      $query=$this->db
      ->select("PRO_ID, PER_ID")
      ->from("PERMISOS_PROYECTO")
      ->where($where)
      ->order_by("PRO_ID","asc")
      ->get();

      $compartidos = $query->result();

      if (count($compartidos) < 1) return $compartidos;

      $or = array();

      foreach ($compartidos as $comp) array_push($or, $comp->PRO_ID);

      $query = $this->db
      ->select("PRO_ID,USU_ID,PRO_NOMBRE,PRO_FECHA")
      ->from("PORTAFOLIO")
      ->where('PRO_ESTADO', true)
      ->where_in('PRO_ID', $or)
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

    public function esCreadorPortafolio($datos=array())
    {
      $where=$datos;
      $query=$this->db
      ->from("PORTAFOLIO")
      ->where($where);
      return $query->count_all_results();
    }

}
