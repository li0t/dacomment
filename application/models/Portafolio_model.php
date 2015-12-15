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


    public function tienePermisosPortafolio($datos=array())
    {
      $where=$datos;
      $query=$this->db
      ->select("PER_ID")
      ->from("PERMISOS_PROYECTO")
      ->where($where)
      ->get();
      return $query->row();
    }

    public function obtenerPermisosPortafolio($id)
    {
      $where=array("PERMISOS_PROYECTO.PRO_ID"=>$id,"PORTAFOLIO.PRO_ESTADO"=>TRUE);
      $query=$this->db
      ->select("PERMISOS_PROYECTO.PRO_ID,PERMISOS_PROYECTO.USU_ID,PERMISOS_PROYECTO.PER_ID,USU_NOMBRES,USU_APELLIDO_PATERNO,PRO_NOMBRE,PER_DESCRIPCION")
      ->from("PERMISOS_PROYECTO")
      ->join("USUARIO","PERMISOS_PROYECTO.USU_ID=USUARIO.USU_ID")
      ->join("PORTAFOLIO","PERMISOS_PROYECTO.PRO_ID=PORTAFOLIO.PRO_ID")
      ->join("PERMISOS","PERMISOS_PROYECTO.PER_ID=PERMISOS.PER_ID")
      ->where($where)
      ->get();
      return $query->result();
    }

    public function insertarPortafolio($datos=array())
    {
      $query=$this->db->insert("PORTAFOLIO",$datos);
      return true;
    }

    public function entregarPermisosPortafolio($datos=array())
    {
      $query=$this->db->insert("PERMISOS_PROYECTO",$datos); /* Falta validación */
      return true;
    }

    public function editarPermisosPortafolio($datos=array())
    {
      $this->db->where('PRO_ID', $datos["PRO_ID"]);
      $this->db->where('USU_ID', $datos["USU_ID"]); // Multiples invocaciones de where genera una clausula AND
      $this->db->update('PERMISOS_PROYECTO',$datos);
      return true;
    }

    public function modificarPortafolio($datos=array(),$id)
    {
      $this->db->where('PRO_ID',$id);
      $this->db->update('PORTAFOLIO',$datos);
      return true;
    }

    public function eliminarPermisoUsuario($id, $usuario)
    {
      $this->db->where('PRO_ID', $id);
      $this->db->where('USU_ID', $usuario);
      $this->db->delete('PERMISOS_PROYECTO');
      return true;
    }

}
