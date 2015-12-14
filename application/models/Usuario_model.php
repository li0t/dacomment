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

    /* Busca usuario por rut y password */
    public function autenticarUsuario($datos=array())
    {
      $where=$datos;
      $query=$this->db
      ->select("USU_ID")
      ->from("USUARIO")
      ->where($where)
      ->get();
      //echo $this->db->last_query();
      return $query->row();
    }

    public function getTodosUsuariosConPortafolio($id_usuario)
    {
        $where=array("USU_ID"=>$id);
        $query=$this->db
        ->select("USUARIO.USU_ID,USU_NOMBRES,USU_APELLIDO_PATERNO,USU_APELLIDO_MATERNO")
        ->from("USUARIO")
        ->join("PERMISOS_PROYECTO","USUARIO.USU_ID","PERMISOS_PROYECTO.USU_ID")
        ->join("PORTAFOLIO","PORTAFOLIO.PRO_ID","PERMISOS_PROYECTO.PRO_ID")
        ->order_by("USU_NOMBRES","asc")
        ->get();
        return $query->result();
    }

    public function getUsuarioPermisoDoc($id_usu,$id_doc,$id_port)
    {
        $where=array("PERMISOS_PROYECTO.PRO_ID"=>$id_port,"USUARIO.USU_ID!="=>$id_usu,"DOCUMENTOS.DOC_ID"=>$id_doc,"PERMISOS_DOCUMENTOS.PER_ID"=>NULL);
        $query=$this->db
        ->select("USUARIO.USU_ID,USUARIO.USU_NOMBRES,USUARIO.USU_APELLIDO_PATERNO")
        ->from("USUARIO")
        ->join("PERMISOS_PROYECTO","USUARIO.USU_ID=PERMISOS_PROYECTO.USU_ID","left")
        ->join("DOCUMENTOS","PERMISOS_PROYECTO.PRO_ID=DOCUMENTOS.PRO_ID","left")
        ->join("PERMISOS_DOCUMENTOS","PERMISOS_DOCUMENTOS.DOC_ID=DOCUMENTOS.DOC_ID AND USUARIO.USU_ID=PERMISOS_DOCUMENTOS.USU_ID","left")
        ->where($where)
        ->get();
        return $query->result();
    }

}
